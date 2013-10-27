<?php
	session_start();
	$userID = $_SESSION['userId'];
	require "connect.inc.php";
	$query = "UPDATE `User` SET `online` = 0 WHERE `user_id` = '$userID'";
    if(mysql_query($query)){
    	session_destroy();
    	header('Location: index.php');
    	exit;
    }
    else{
      echo "error! invalid user id!";
      exit;
    }

?>