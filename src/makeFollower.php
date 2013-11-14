<?php
	session_start();
	if(!isset($_SESSION['userId'])){
		header('Location: index.php');
	}
	require "connect.inc.php";
	
	if (isset($_POST['makeFollower'])) $Follower_add = $_POST['makeFollower'];
	if (isset($_POST['adddel'])) $adddel = $_POST['adddel'];
	if (isset($_POST['redirect'])) $redirect = $_POST['redirect'];
	
	if ($adddel == 'add'){
	$queryIn = "INSERT INTO `Follow` (`followed_user_id`,`followedby_user_id`) VALUES ('$Follower_add','" . $_SESSION['userId'] . "');";
	echo $queryIn;
	$query_out = mysql_query($queryIn);
	//exit();
	}
	else if ($adddel == 'del'){
	$query1 = "DELETE FROM `Follow` WHERE `followed_user_id`='$Follower_add' AND `followedby_user_id`= '" . $_SESSION['userId'] . "';";
	//$query2 = "DELETE FROM `Followers_with` WHERE `user_id2`='$Follower_add' AND `user_id1`= '" . $_SESSION['userId'] . "';";
	//echo $query1;
	$query_out = mysql_query($query1);
	//exit();
	//echo $query2;
	//$query_out = mysql_query($query2);
	}
	
	if ($redirect == "profile.php") header("Location: $redirect?user_id=$Follower_add");
	else if ($redirect == "followerList.php") header("Location: $redirect");
	//else if ($redirect == "FollowerList.php") header("Location: $redirect");
	
	
?>