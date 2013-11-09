<?php
	
	session_start();
	if(!isset($_SESSION['userId'])){
		header('Location: index.php');
	}

	if(isset($_POST)){
		if(isset($_POST['new_post'])){
			if(!empty($_POST['new_post'])){
				$postData = mysql_real_escape_string($_POST['new_post']);
				require "connect.inc.php";
				//insert into 'Post'
				$query = "INSERT INTO `Post` (`likes`, `data`) VALUES (0,'$postData')";
			    if(mysql_query($query)){
			      //get the post id
			    	$query = "SELECT MAX(`post_id`) AS `post_id` FROM `Post` WHERE `likes`=0 AND `data`='$postData'";
			    	if($query_out = mysql_query($query)){
      					if($row = mysql_fetch_assoc($query_out)){
      						$postID = $row['post_id'];
      						//insert into Posts
      						$query = "INSERT INTO `Posts` VALUES ('".$_SESSION['userId']."',$postID)";
      						if(mysql_query($query)){
      							//find the friends of poster
      							$query = "(SELECT `user_id2` AS user FROM `Friends_with` WHERE `user_id1`= '".$_SESSION['userId']."') UNION (SELECT `user_id1` AS user FROM `Friends_with` WHERE `user_id2`= '".$_SESSION['userId']."')";
      							//echo $query;
      							if($query_out = mysql_query($query)){
      								while($row = mysql_fetch_assoc($query_out)){
      									$query1 = "INSERT INTO `Post_notification` VALUES ($postID,'".$row['user']."',0 )";
      									if(!mysql_query($query1)){
      										echo "error!!";
      										exit;
      									}
      								}
      								header('Location: feed.php');
      								exit;
      							}
      							//$query = "INSERT INTO `Post_notification` VALUES ($postID, )";
      							//if(mysql_query($query)){}
      						}
      						else{
      							echo "Error inserting post into database!!";
			    				exit;
      						}
      					}
      				}
			      //insert into Posts

			    	
			    }
			    else{
			    	echo "Error inserting post into database!!";
			    	exit;
			    }
			}
		}
	}
?>