<?php
	if(isset($_POST)){
		if(isset($_POST['new_userID']) && isset($_POST['new_userFirst']) && isset($_POST['new_userLast']) && isset($_POST['new_emailID']) && isset($_POST['new_pass1']) && isset($_POST['new_pass2']) && isset($_POST['new_date'])){
			if(!empty($_POST['new_userID']) && !empty($_POST['new_userFirst']) && !empty($_POST['new_userLast']) && !empty($_POST['new_emailID']) && !empty($_POST['new_pass1']) && !empty($_POST['new_pass2']) && !empty($_POST['new_date'])){
				$pass1=$_POST['new_pass1'];
				$pass2=$_POST['new_pass2'];
				$first_name = $_POST['new_userFirst'];
				$last_name = $_POST['new_userLast'];
				$date = $_POST['new_date'];
				$gender = $_POST['new_gender'];
				
				$birthDate = explode("-", $date);
				//get age from date or birthdate
				$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[2], $birthDate[0]))) > date("md") ? ((date("Y")-$birthDate[0])-1):(date("Y")-$birthDate[0]));
				echo "Age is:".$age;
				
				
				if($pass1 != $pass2){
					header('Location: index.php?retry=b');
					exit();
				}else{
					$email = $_POST['new_emailID'];
					if(preg_match('/^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-zA-Z0-9]+$/', $email)){
						$userID = $_POST['new_userID'];
						$alreadyExists = checkExisting($userID);
						if($alreadyExists){
							header('Location: index.php?retry=d');
							exit();
						}
						else{
							if(insertUser($userID, $pass1)){
								//start session and insert other attributes as well.
								insertProfile($userID, $first_name, $last_name, $email, $date, $gender, $age);
								session_start();
								$_SESSION['userId']=$userID;
								header('Location: profile.php');
								exit();
							}
							else{
								header('Location: index.php?retry=e');
								exit();
							}
						}
					}else{
						 header('Location: index.php?retry=c');
						 exit();
					}
				}

			}
		}
	}

	function checkExisting($userID){
		require "connect.inc.php";
    	$query = "SELECT * FROM `User` WHERE `user_id` = '$userID'";
    	if($query_out = mysql_query($query)){
      		if($row = mysql_fetch_assoc($query_out)){
      			return true;
      		}
      		else{
      			return false;
      		}
      	}
	}

	function insertUser($userID, $pass){
		$query = "INSERT INTO `User` (`user_id`,`password`) VALUES ('$userID','$pass')";	
		// echo $query;
		// exit;
		if($query_out = mysql_query($query)){
			return true;
		}
		else{
			return false;
		}
	}
	
	function insertProfile($userID, $first_name, $last_name, $email, $date, $gender, $age){
		
			if ($gender == 'MALE') $tmpName="img/male.jpg";
			else $tmpName="img/female.jpg";
			$fp = fopen($tmpName, 'r');
			$data = fread($fp, filesize($tmpName));
			$data = addslashes($data);
			$img = "'" . $data . "'";
		
		$query = "INSERT INTO `Profile` (`user_id`,`first_name`,last_name,email_id,dob,gender,image,age) VALUES ('$userID','$first_name','$last_name','$email','$date','$gender'," . $img .",'$age')";	
		//echo $query;
		if($query_out = mysql_query($query)){
			return true;
		}
		else{
			return false;
		}
	}
?>