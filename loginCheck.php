<?php
  if(isset($_POST)){
    $verified = false;
    if(!empty($_POST['username']) && !empty($_POST['password'])) {
      $verified = verifyUser($_POST['username'],$_POST['password']);
    } else{
      $verified = false;
    }
    if($verified){
      session_start();
      $_SESSION['userId']=$_POST['username'];
      makeUserOnline($_SESSION['userId']);
      header('Location: profile.php');
      exit();
    }else{
      header('Location: index.php?retry=a');
      exit();
    }
  }

  function verifyUser($inp_ID, $inp_pass){
    require "connect.inc.php";
    $query = "SELECT * FROM `User` WHERE `user_id` = '$inp_ID' AND `password` = '$inp_pass'";
    if($query_out = mysql_query($query)){
      while($row = mysql_fetch_assoc($query_out)){

        if($row['user_id'] == $inp_ID && $inp_pass == $row['password']){
          return true;
        }
      }
    }
    return false;
  }

  function makeUserOnline($userID){
    $query = "UPDATE `User` SET `online` = 1 WHERE `user_id` = '$userID'";
    if(mysql_query($query)){
    }
    else{
      echo "error! invalid user id!";
      exit;
    }
  }


?>