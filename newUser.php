<?php
require "connect.inc.php";

// Get Search
// $search_string = preg_replace("/[^A-Za-z0-9]/", " ", $_POST['query']);
$inputID = $_POST['query'];
$query = "SELECT * FROM `User` WHERE `user_id` = \"$inputID\"";
// $query = mysql_real_escape_string($query);

	if($query_out = mysql_query($query)){
		if($row = mysql_fetch_assoc($query_out)){
			// $output = str_replace('NAME', $row['name'], $html);
			// $output = str_replace('USERID',$row['user_id'],$output);
			echo "User ID unavailable. Retry with another user-ID.";
		}
		else{
			echo "User ID available.";
		}
	}
?>