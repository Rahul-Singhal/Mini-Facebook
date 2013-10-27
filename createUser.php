<?php
	if(isset($_POST)){
		if(isset($_POST['new_userID']) && isset($_POST['new_userFirst']) && isset($_POST['new_userLast']) && isset($_POST['new_emailID']) && isset($_POST['new_pass1']) && isset($_POST['new_pass2']) && isset($_POST['new_date'])){
			if(!empty($_POST['new_userID']) && !empty($_POST['new_userFirst']) && !empty($_POST['new_userLast']) && !empty($_POST['new_emailID']) && !empty($_POST['new_pass1']) && !empty($_POST['new_pass2']) && !empty($_POST['new_date'])){
				$pass1=mysql_real_escape_string($_POST['new_pass1']);
				$pass2=mysql_real_escape_string($_POST['new_pass2']);
				$first_name = mysql_real_escape_string($_POST['new_userFirst']);
				$last_name = mysql_real_escape_string($_POST['new_userLast']);
				$date = mysql_real_escape_string($_POST['new_date']);
				$gender = mysql_real_escape_string($_POST['new_gender']);
				
				if($pass1 != $pass2){
					header('Location: index.php?retry=b');
					exit();
				}else{
					$email = mysql_real_escape_string($_POST['new_emailID']);
					if(preg_match('/^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-zA-Z0-9]+$/', $email)){
						$userID = mysql_real_escape_string($_POST['new_userID']);
						$alreadyExists = checkExisting($userID);
						if($alreadyExists){
							header('Location: index.php?retry=d');
							exit();
						}
						else{
							if(insertUser($userID, $pass1)){
								//start session and insert other attributes as well.
								insertProfile($userID, $first_name, $last_name, $email, $date, $gender);
								session_start();
								$_SESSION['userId']=$userID;
								makeUserOnline($userID);
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
		if($query_out = mysql_query($query)){
			return true;
		}
		else{
			return false;
		}
	}
	
	function insertProfile($userID, $first_name, $last_name, $email, $date, $gender){
		
			if ($gender == 'MALE') $tmpName="img/male.jpg";
			else $tmpName="img/female.jpg";
			$fp = fopen($tmpName, 'r');
			$data = fread($fp, filesize($tmpName));
			$data = addslashes($data);
			$img = "'" . $data . "'";
		
		$query = "INSERT INTO `Profile` (`user_id`,`first_name`,last_name,email_id,dob,gender,image) VALUES ('$userID','$first_name','$last_name','$email','$date','$gender'," . $img .")";	
		//echo $query;
		if($query_out = mysql_query($query)){
			return true;
		}
		else{
			return false;
		}
	}

	function makeUserOnline($userID){
	    $query = "UPDATE `User` SET `online` = 1 WHERE `user_id` = '$userID'";
	    if(mysql_query($query)){
	    }
	    else{
	      echo "error! invalid user id!";
	      exit;
	    }
  }
?>