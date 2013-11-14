<?php
	session_start();
	if(!isset($_SESSION['userId'])){
		header('Location: index.php');
	}
   date_default_timezone_set('Asia/Kolkata');
	require "connect.inc.php";
   //Insert a new row in the chat table
   $sender = $_SESSION['userId'];
   $receiver = $_GET["name"];
   $message = $_GET["message"];
   $mysql_date_now = date("Y-m-d H:i:s");
   mysql_query("insert into `Message` (sender_id,receiver_id,date_time,data) values ('$sender', '$receiver', '$mysql_date_now', '$message') ");

?>
