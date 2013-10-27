<?php
	session_start();
	if(!isset($_SESSION['userId'])){
		header('Location: index.php');
	}
   date_default_timezone_set('Asia/Kolkata');
	require "connect.inc.php";
<<<<<<< HEAD
   ///Insert a new row in the chat table
=======
   //Insert a new row in the chat table
>>>>>>> d688a21570532c8ba622a4a56f8f430db2bcaf60
   $sender = $_SESSION['userId'];
   $receiver = $_GET["name"];
   $message = $_GET["message"];
   $mysql_date_now = date("F j,Y,g:i a");
   mysql_query("insert into `Message` (sender_id,receiver_id,date_time,data) values ('$sender', '$receiver', '$mysql_date_now', '$message') ");

?>
