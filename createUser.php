<?php
	if(isset($_POST)){
		if(isset($_POST['new_userID']) && isset($_POST['new_userFirst']) && isset($_POST['new_userLast']) && isset($_POST['new_emailID']) && isset($_POST['new_pass1']) && isset($_POST['new_pass2'])){
			if(!empty($_POST['new_userID']) && !empty($_POST['new_userFirst']) && !empty($_POST['new_userLast']) && !empty($_POST['new_emailID']) && !empty($_POST['new_pass1']) && !empty($_POST['new_pass2'])){
				$pass1=$_POST['new_pass1'];
				$pass2=$_POST['new_pass2'];
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
    	$query = "SELECT * FROM `loginData` WHERE `user_id` = '$userID'";
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
		$query = "INSERT INTO `loginData` (`user_id`,`password`) VALUES ('$userID','$pass')";	
		if($query_out = mysql_query($query)){
			return true;
		}
		else{
			return false;
		}
	}
?>