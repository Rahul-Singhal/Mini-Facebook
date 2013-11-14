<?php
	
	session_start();
	if(!isset($_SESSION['userId'])){
		header('Location: index.php');
	}

	if(isset($_POST)){
		if(isset($_POST['like'])){
			$postID = $_POST['post_id'];
			$userID = $_SESSION['userId'];
			require "connect.inc.php";
			$query = "SELECT COUNT(*) AS `count` fROM `Likes` WHERE `user_id` = '$userID' AND `likes_post_id` = '$postID'";
			// echo $query;
			// exit;
			if($query_out = mysql_query($query)){
				if($row = mysql_fetch_assoc($query_out)){
					if($row['count'] == 0){
						// echo "I am here";
						// exit();
						$query = "INSERT INTO `Likes` VALUES('$userID','$postID')";
						if(mysql_query($query)){
							$query = "UPDATE `Post` SET `likes` = `likes` + 1 WHERE `post_id` = '$postID'";
							if(mysql_query($query)){
								header('Location: feed.php');
      							exit;
							}
							else{
								echo "database insertion error!";
								exit();
							}
						}
						else{
							echo "error in database insertion!";
							exit();
						}
					}
					header('Location: feed.php');
      				exit;
				}
			}
		}
		else if(isset($_POST['dislike'])){
			$postID = $_POST['post_id'];
			$userID = $_SESSION['userId'];
			require "connect.inc.php";
			$query = "SELECT COUNT(*) AS `count` fROM `Likes` WHERE `user_id` = '$userID' AND `likes_post_id` = '$postID'";
			if($query_out = mysql_query($query)){
				if($row = mysql_fetch_assoc($query_out)){
					if($row['count'] == 1){
						$query = "DELETE FROM `Likes` WHERE `user_id` = '$userID' AND `likes_post_id` = '$postID'";
						if(mysql_query($query)){
							$query = "UPDATE `Post` SET `likes` = `likes` - 1 WHERE `post_id` = '$postID'";
							if(mysql_query($query)){
								header('Location: feed.php');
      							exit;
							}
							else{
								echo "database insertion error!";
								exit();
							}
						}
						else{
							echo "error in database insertion!";
							exit();
						}
					}
					header('Location: feed.php');
      				exit;
				}
			}
		}
		else{

		}
	}
?>