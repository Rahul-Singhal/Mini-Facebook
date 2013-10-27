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
	//echo $_POST['dob'];
	if (isset($_POST['age'])) $age = mysql_real_escape_string($_POST['age']);
	if (isset($_POST['dob'])) $dob = mysql_real_escape_string($_POST['dob']);
	if (isset($_POST['relationStat'])) $relationStat = mysql_real_escape_string($_POST['relationStat']);
	if (isset($_POST['sex'])) $sex = mysql_real_escape_string($_POST['sex']);
	//echo $sex;
	
	if (isset($_POST['houseno'])) $houseno = mysql_real_escape_string($_POST['houseno']);
	if (isset($_POST['street'])) $street = mysql_real_escape_string($_POST['street']);
	if (isset($_POST['pin_code'])) $pin_code = mysql_real_escape_string($_POST['pin_code']);
	if (isset($_POST['city'])) $city = mysql_real_escape_string($_POST['city']);
	if (isset($_POST['state'])) $state = mysql_real_escape_string($_POST['state']);
	if (isset($_POST['phone_no'])) $phone_no = mysql_real_escape_string($_POST['phone_no']);
	if (isset($_POST['email_id'])) $email_id = mysql_real_escape_string($_POST['email_id']);
	if (isset($_POST['quote'])) $quote = mysql_real_escape_string($_POST['quote']);
	
	
	if (isset($_POST['grad_school'])) $grad_school = mysql_real_escape_string($_POST['grad_school']);
	if (isset($_POST['high_school'])) $high_school = mysql_real_escape_string($_POST['high_school']);
	if (isset($_POST['prim_school'])) $prim_school = mysql_real_escape_string($_POST['prim_school']);
	
	if (isset($_POST['image'])) $image = mysql_real_escape_string($_POST['image']);
	
	//if (isset($_POST[''])) $ = $_POST[''];
	
	$query = "
	UPDATE Profile
	SET ";
	
	if (isset($age)) { $query = $query . "age='" . $age . "',";}
	if (isset($dob)) { $query = $query . "dob='" . $dob . "',";}
	if (isset($relationStat)) { $query = $query . "relationship_status='" . $relationStat . "'," ;}
	if (isset($sex)) { $query = $query . "gender='" . $sex . "'";}
	
	if (isset($houseno)) { $query = $query . "house_no='" . $houseno . "',";}
	if (isset($street)) { $query = $query . "street='" . $street . "',";}
	if (isset($pin_code)) { $query = $query . "pin='" . $pin_code . "',";}
	if (isset($city)) { $query = $query . "city='" . $city . "',";}
	if (isset($state)) { $query = $query . "state='" . $state . "',";}
	if (isset($phone_no)) { $query = $query . "phone_no='" . $phone_no . "',";}
	if (isset($email_id)) { $query = $query . "email_id='" . $email_id . "',";}
	if (isset($quote)) { $query = $query . "quote='" . $quote . "'";}
	
	if (isset($grad_school)) { $query = $query . "graduation_school='" . $grad_school . "',";}
	if (isset($high_school)) { $query = $query . "high_school='" . $high_school . "',";}
	if (isset($prim_school)) { $query = $query . "primary_school='" . $prim_school . "'";}
	
	if (isset($image)) {
		$tmpName="upload/" . $image;
		$fp = fopen($tmpName, 'r');
		$data = fread($fp, filesize($tmpName));
		$data = addslashes($data);
		$query = $query . "image='" . $data . "'";
	}
	
	$query = $query . " WHERE user_id='" . $_SESSION['userId'] . "';";
	//echo $query;
	if($query_out = mysql_query($query)){
		echo "Updated";
	}
	else{
		echo "Not Updated";
	}
	header('Location: profile.php');
?>