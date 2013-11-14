<?php
session_start();
	if(!isset($_SESSION['userId'])){
		header('Location: index.php');
	}
	require "connect.inc.php";
	require "getNotificationsAndRequests.php";
	
	echo "<ul class=\"nav nav-list\" id=\"left-menu\"  >";
	echo "<li class=\"nav-header\">Online Friends</li>";
	
	$friends = "select user_id1 as id from Friends_with where user_id2 = \"".$_SESSION['userId']."\" UNION select user_id2 as id from Friends_with where user_id1 = \"".$_SESSION['userId']."\";";
	$count = 0;
	if($query_out1 = mysql_query($friends)){
		while($_SESSION['friends'] = mysql_fetch_assoc($query_out1)){
			$online = "select first_name,last_name from Profile,User where Profile.user_id = User.user_id and User.user_id = \"".$_SESSION['friends']['id']."\" and User.online = 1;";
			if($query_out3 = mysql_query($online)){
				if($_SESSION['online'] = mysql_fetch_assoc($query_out3)){
				echo "<li><a id=\"of$count\" href=\"#\">".$_SESSION['online']['first_name']." ".$_SESSION['online']['last_name']."</a></li>";
				$count += 1;
				}
			}
		}
	}
	
	echo "</ul>";
?>