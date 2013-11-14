<?php

	session_start();
	if(!isset($_SESSION['userId'])){
		header('Location: index.php');
	}
	require "connect.inc.php";

//Output HTML Formating
$html = '';
$html .= '<li class="result">';
$html .= '<a href="profile.php?user_id=USERID" style="color:white;">';
$html .= 'NAME';
$html .= '</a>';
$html .= '</li>';

// Get Search
$search_string = preg_replace("/[^A-Za-z0-9]/", " ", $_POST['query']);
$search_string = mysql_real_escape_string($search_string);

// Check Length More Than One Character
if (strlen($search_string) >= 1 && $search_string !== ' ') {
	$query = "SELECT CONCAT(`first_name`,' ',`last_name`) AS `name` ,`user_id` FROM `Profile` WHERE `first_name` LIKE \"%$search_string%\" OR `last_name` LIKE \"%$search_string%\" LIMIT 0,5";
	// echo $query;
	// exit;

	if($query_out = mysql_query($query)){
		while($row = mysql_fetch_assoc($query_out)){
			$output = str_replace('NAME', $row['name'], $html);
			$output = str_replace('USERID',$row['user_id'],$output);
			echo $output;
		}
	}
}
?>