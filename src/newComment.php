<?php
	
	session_start();
	if(!isset($_SESSION['userId'])){
		header('Location: index.php');
	}
	
	if(isset($_POST)){
		if(isset($_POST['comment_id']) && isset($_POST['commentData'])){
			$post = explode("_", $_POST['comment_id']);
			require "connect.inc.php";
			$commentData = mysql_real_escape_string($_POST['commentData']);
			$sender_id = $_SESSION['userId'];
			$query = "INSERT INTO `Comment` (`post_id`,`comment_id`,`sender_id`,`data`) VALUES ($post[0],$post[1],'$sender_id','$commentData')";
			//echo $query;
			if(mysql_query($query)){
				$query = "(SELECT `user_id2` AS user FROM `Friends_with` WHERE `user_id1`= '".$_SESSION['userId']."') UNION (SELECT `user_id1` AS user FROM `Friends_with` WHERE `user_id2`= '".$_SESSION['userId']."')";
				$flag = false;
				if($query_out = mysql_query($query)){
					while($row = mysql_fetch_assoc($query_out)){
						$query1 = "INSERT INTO `Comment_notification` VALUES ('$post[0]','$post[1]','".$row['user']."',0 )";
						if(!mysql_query($query1)){
							$flag = true;
						}
					}
					if($flag){
						while($row = mysql_fetch_assoc($query_out)){
							$query1 = "DELETE IF EXISTS FROM `Comment_notification` VALUES ('$post[0]','$post[1]','".$row['user']."',0 )";
							if(!mysql_query($query1)){
								$flag = true;
							}
						}
					}
					header('Location: feed.php');
      				exit;
				}
				else{
				echo "Error inserting comment into database!!";
			    exit;
				}
			}
			else{
				echo "jkError inserting comment into database!!";
			    exit;
			}

		}
	}


?>