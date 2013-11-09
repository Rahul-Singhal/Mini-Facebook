<?php
session_start();
	if(!isset($_SESSION['userId'])){
		header('Location: index.php');
	}
	require "connect.inc.php";
	require "getNotificationsAndRequests.php";
	
	$sender = $_SESSION['userId'];
	$other_id = $_GET["other"];

	$results = mysql_query("select * from `Message` where `sender_id` = \"".$_SESSION['userId']."\" AND `receiver_id` = \"".$other_id."\" OR  `sender_id` = \"".$other_id."\" AND `receiver_id` = \"".$_SESSION['userId']."\" order by date_time ASC");
							
	while($row = mysql_fetch_array($results)) {
		if($row['sender_id'] === $other_id){
		echo "<li><div class=\"receiversMessage\"><span class=\"Mtime\">";
		echo date('F j,Y,g:i a',strtotime($row['date_time']));
		echo "</span><br/>";
		echo $row['data'];
		echo "</div></li>";
		}
		else{
		echo "<li><div class=\"sendersMessage\"><span class=\"Mtime\">";
		echo date('F j,Y,g:i a',strtotime($row['date_time']));
		echo"</span><br/>";
		echo $row['data'];
		echo "</div></li>";
		}
	}
?>