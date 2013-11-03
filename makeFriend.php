<?php
	session_start();
	if(!isset($_SESSION['userId'])){
		header('Location: index.php');
	}
	require "connect.inc.php";
	
	if (isset($_POST['makeFriend'])) $friend_add = $_POST['makeFriend'];
	if (isset($_POST['adddel'])) $adddel = $_POST['adddel'];
	if (isset($_POST['redirect'])) $redirect = $_POST['redirect'];
	
	if ($adddel == 'add'){
	$queryIn = "INSERT INTO `Request` (`receiver_id`,`sender_id`,seen) VALUES ('$friend_add','" . $_SESSION['userId'] . "',0);";
	//echo $queryIn;
	$query_out = mysql_query($queryIn);
	//exit();
	}
	else if ($adddel == 'del'){
	$query1 = "DELETE FROM `Friends_with` WHERE `user_id1`='$friend_add' AND `user_id2`= '" . $_SESSION['userId'] . "';";
	$query2 = "DELETE FROM `Friends_with` WHERE `user_id2`='$friend_add' AND `user_id1`= '" . $_SESSION['userId'] . "';";
	//echo $query1;
	$query_out = mysql_query($query1);
	//echo $query2;
	$query_out = mysql_query($query2);
	}
	
	else if ($adddel == 'accept'){
		$queryDel = "DELETE FROM `Request` WHERE `receiver_id` = '" . $_SESSION['userId'] . "' AND `sender_id`='$friend_add';";
		//echo $queryDel;
		$query_out = mysql_query($queryDel);
		$queryCh = "INSERT INTO `Friends_with` (`user_id1`,`user_id2`) VALUES ('$friend_add','" . $_SESSION['userId'] . "');";
		//echo $queryCh;
		//exit();
		$query_out = mysql_query($queryCh);
	}
	
	else if ($adddel == 'cancelReq'){
		$queryDel = "DELETE FROM `Request` WHERE `sender_id` = '" . $_SESSION['userId'] . "' AND `receiver_id`='$friend_add';";
		//echo $queryDel;
		$query_out = mysql_query($queryDel);
	}
	
	if ($redirect == "profile.php") header("Location: $redirect?user_id=$friend_add");
	else if ($redirect == "friendList.php") header("Location: $redirect");
	//else if ($redirect == "friendList.php") header("Location: $redirect");
	
	
?>