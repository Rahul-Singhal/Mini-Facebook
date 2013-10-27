<?php

getRequests($_SESSION['userId']);
getNotifications($_SESSION['userId']);

function getRequests($inp_ID){
    require "connect.inc.php";
    $query = "SELECT * FROM `Request` WHERE `receiver_id` = '$inp_ID' order by `date_time` desc limit 0,6";
    //echo $query;
    $_SESSION['requests'] = array();
    if($query_out = mysql_query($query)){
      while($row = mysql_fetch_assoc($query_out)){
          array_push($_SESSION['requests'], array($row['sender_id'], $row['date_time'], $row['seen']));
          //echo $_SESSION['requests'][1][0]."\n";
      }
      
    }
  }

  function getNotifications($inp_ID){
  	// echo $inp_ID;
  	// exit;
    require "connect.inc.php";
    $query = "SELECT DISTINCT `user_id`,`Post`.`date_time`,`seen` FROM `Post_notification`, `Posts`,`Post` WHERE `Post`.`post_id` = `Posts`.`posts_post_id` AND `receiver_id` = '$inp_ID' AND `Posts`.`posts_post_id` = `Post_notification`.`post_id` ORDER BY `date_time` DESC limit 0,6";
    // echo $query;
    // exit;
    $_SESSION['notifications'] = array();
    if($query_out = mysql_query($query)){
      while($row = mysql_fetch_assoc($query_out)){
          array_push($_SESSION['notifications'], array('post', $row['user_id'], $row['date_time'], $row['seen']));
          //echo $_SESSION['requests'][1][0]."\n";
      }
    }

    $query = "SELECT DISTINCT `Comment`.`sender_id`,`Comment`.`date_time`,`seen` FROM `Comment_notification` , `Comment` WHERE `Comment_notification`.`post_id` = `Comment`.`post_id` AND `Comment_notification`.`comment_id` = `Comment`.`comment_id` AND `Comment`.`sender_id` IN (SELECT `user_id2` AS user FROM `Friends_with` WHERE `user_id1`='$inp_ID' UNION SELECT `user_id1` AS user FROM `Friends_with` WHERE `user_id2`='$inp_ID') ORDER BY `date_time` DESC limit 0,6";
    // echo $query;
    // exit;
    if($query_out = mysql_query($query)){
      while($row = mysql_fetch_assoc($query_out)){
          array_push($_SESSION['notifications'], array('comment',$row['sender_id'], $row['date_time'], $row['seen']));
      }
    }

    $query = "SELECT DISTINCT `Event`.`sender_id`,`Event`.`date_time`,`seen` FROM `Event_Notification` , `Event` WHERE `Event_Notification`.`event_id` = `Event`.`event_id` AND `Event_Notification`.`event_id` = `Event`.`event_id` AND `sender_id` IN (SELECT `user_id2` AS user FROM `Friends_with` WHERE `user_id1`='$inp_ID' UNION SELECT `user_id1` AS user FROM `Friends_with` WHERE `user_id2`='$inp_ID') ORDER BY `date_time` DESC limit 0,6";
    // echo $query;
    // exit;
    if($query_out = mysql_query($query)){
      while($row = mysql_fetch_assoc($query_out)){
          array_push($_SESSION['notifications'], array('event',$row['sender_id'], $row['date_time'], $row['seen']));
      }
    }

    usort($_SESSION['notifications'], 'date_compare');
  }

  function date_compare($a, $b)
  {
      $t1 = strtotime($a[2]);
      $t2 = strtotime($b[2]);
      return $t2 - $t1;
  }

?>