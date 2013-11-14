<?php
	session_start();
	if(!isset($_SESSION['userId'])){
		header('Location: index.php');
	}
	require "connect.inc.php";
	
	if (isset($_POST['makeRelated'])) $Related_add = $_POST['makeRelated'];
	if (isset($_POST['adddel'])) $adddel = $_POST['adddel'];
	if (isset($_POST['redirect'])) $redirect = $_POST['redirect'];
	
	if ($adddel == 'add'){
	$queryIn = "INSERT INTO `Relationship_with` (`user_id1`,`user_id2`) VALUES ('$Related_add','" . $_SESSION['userId'] . "');";
	// echo $queryIn;
	// exit;
	$query_out = mysql_query($queryIn);
	
	$query2 = "UPDATE Profile SET relationship_status=1 WHERE user_id='" . $_SESSION['userId'] . "';";
	$query_out = mysql_query($query2);
	$query2 = "UPDATE Profile SET relationship_status=1 WHERE user_id='" . $Related_add . "';";
	$query_out = mysql_query($query2);
	//exit();
	}
	else if ($adddel == 'del'){
	$query1 = "DELETE FROM `Relationship_with` WHERE `user_id1`='$Related_add' AND `user_id2`= '" . $_SESSION['userId'] . "';";
	$query2 = "DELETE FROM `Relationship_with` WHERE `user_id2`='$Related_add' AND `user_id1`= '" . $_SESSION['userId'] . "';";
	//echo $query1;
	$query_out = mysql_query($query1);
	//exit();
	echo $query2;
	$query_out = mysql_query($query2);
	
	$query2 = "UPDATE Profile SET relationship_status=0 WHERE user_id='" . $_SESSION['userId'] . "';";
	$query_out = mysql_query($query2);
	$query2 = "UPDATE Profile SET relationship_status=0 WHERE user_id='" . $Related_add . "';";
	$query_out = mysql_query($query2);
	}
	
	if ($redirect == "profile.php") header("Location: $redirect?user_id=$Related_add");
	
	
?>