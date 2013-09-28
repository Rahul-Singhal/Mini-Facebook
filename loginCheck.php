<?php
  if(isset($_POST)){
    $verified = false;
    if(!empty($_POST['username']) && !empty($_POST['password'])) {
      $verified = verifyUser($_POST['username'],$_POST['password']);
    } else{
      $verified = false;
    }
    if($verified){
      header('Location: profile.php');
      exit();
    }else{
      header('Location: index.php?retry=a');
      exit();
    }
  }

  function verifyUser($inp_ID, $inp_pass){
    require "connect.inc.php";
    $query = "SELECT * FROM `loginData` WHERE `user_id` = '$inp_ID' AND `password` = '$inp_pass'";
    if($query_out = mysql_query($query)){
      while($row = mysql_fetch_assoc($query_out)){

        if($row['user_id'] == $inp_ID && $inp_pass == $row['password']){
          return true;
        }
      }
    }
    return false;
  }

?>