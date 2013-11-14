<?php
	session_start();
	if(!isset($_SESSION['userId'])){
		header('Location: index.php');
	}
	require "connect.inc.php";
	$query = "SELECT * FROM `Profile` WHERE `user_id` = \"".$_SESSION['userId']."\"";
    if($query_out = mysql_query($query)){
      $_SESSION['user_profile'] = mysql_fetch_assoc($query_out);
    }
	
	$event_name = mysql_real_escape_string($_POST['event-name']);
	$event_time = mysql_real_escape_string($_POST['event-date']);
	$event_time = $event_time . " " . mysql_real_escape_string($_POST['event-time-hours']) . ":" . mysql_real_escape_string($_POST['event-time-mins']);
	echo $event_time;
	$description = mysql_real_escape_string($_POST['event-description']);
	$house_no = mysql_real_escape_string($_POST['event-house-no']);
	$street = mysql_real_escape_string($_POST['event-street']);
	$pin_code = mysql_real_escape_string($_POST['event-pin']);
	$city = mysql_real_escape_string($_POST['event-city']);
	$state = mysql_real_escape_string($_POST['event-state']);
	$country = mysql_real_escape_string($_POST['event-country']);

	$query = "INSERT INTO Event (sender_id, event_name, event_date_time, description, house_no, street, pin, city, state, country) 
	VALUES ('" . $_SESSION['userId'] . "','$event_name','$event_time','$description','$house_no','$street','$pin_code','$city','$state', '$country')";
	echo $query;
	if ($query_out = mysql_query($query)){
		echo "Event created";
		$query = "SELECT MAX(`event_id`) AS `event_id` FROM `Event` WHERE `description`='$description'";
		
		if($query_out=mysql_query($query)){
			if($row = mysql_fetch_assoc($query_out)){
      			$eventID = $row['event_id'];
				//find the friends of poster
				$query = "(SELECT `user_id2` AS user FROM `Friends_with` WHERE `user_id1`= '".$_SESSION['userId']."') UNION (SELECT `user_id1` AS user FROM `Friends_with` WHERE `user_id2`= '".$_SESSION['userId']."')";
				if($query_out = mysql_query($query)){
					while($row = mysql_fetch_assoc($query_out)){
						$query1 = "INSERT INTO `Event_Notification` VALUES ($eventID,'".$row['user']."',0 )";
						if(!mysql_query($query1)){
							echo "error!!";
							exit;
						}
					}
					header('Location: event.php');
					exit;
				}
			}
		}
		else{
			echo "error!!";
			exit;
		}
	}
	else{
		echo "error!!";
		exit;
	}
	header("Location: event.php");
	
?>