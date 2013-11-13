<?php
	session_start();
	if(!isset($_SESSION['userId'])){
		header('Location: index.php');
	}
	require "connect.inc.php";
   //Insert a new row in the chat table
   $eventId = $_POST['eventId'];
   

   $query = "DELETE FROM `Event` WHERE `event_id` = $eventId";
   // echo $query;
   if(mysql_query($query)){
      header('Location: event.php');
   }
   else{
      echo "Error in deleting the event!";
      exit;
   }

?>
