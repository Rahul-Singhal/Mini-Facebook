<?php
	session_start();
	if(!isset($_SESSION['userId'])){
		header('Location: index.php');
	}
	
	require "connect.inc.php";
	require "getNotificationsAndRequests.php";

	$checkValid = "SELECT * FROM Event_Notification WHERE `event_id`=".$_GET['event_id']." AND `receiver_id` = '".$_SESSION['userId']."'";
	// echo $checkValid;
	// exit;
	$out=mysql_query($checkValid);
	// echo $out;
	// exit;
	if($row = mysql_fetch_assoc($out)){

	}
	else{
		header('Location: event.php');
	}

	$event_info = "SELECT * from Event,Event_Notification where Event.event_date_time > CURRENT_TIMESTAMP AND Event.event_id = Event_Notification.event_id AND Event.event_id = ".$_GET['event_id']." AND (receiver_id = \"".$_SESSION['userId']."\" OR sender_id = \"".$_SESSION['userId']."\") GROUP BY `Event`.`event_id` ORDER BY Event.event_date_time;";
	// echo "SELECT * from Event,Event_Notification where Event.event_id = Event_Notification.event_id and receiver_id = \"".$_SESSION['userId']."\";";
	// echo $event_info;
	// exit;
	$friends = "select user_id1 as id from Friends_with where user_id2 = \"".$_SESSION['userId']."\" UNION select user_id2 as id from Friends_with where user_id1 = \"".$_SESSION['userId']."\";";
	
	
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Mini-Facebook</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
	<link href="css/datepicker.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<style type="text/css">
	body, html {
                height: 100%;
				padding-right:0;
				margin-right:0;
            }
	.scrollable{
		max-height: 90%;
		overflow: auto;
	}
	
	a{
	text-decoration:none;
	color:"white";
	}
	
	#top {
		/*background-color: #4c66a4;
		color: #ffffff;*/
	}
	#panelGuest{
		overflow-y:auto;
		overflow-x:hidden;
		margin-top:6%;
	}
	#left-menu{
		width:75%;
	}
	#ticker{
		padding-left:0;
		margin-left:0;
		height:300px;
	}
	#ticker-item{
		background-color: #dff0d8;
	}
	#line{
		height:2px;
	}
	#right-bar{
		border-left:4px solid #007AA3;	
		padding-left:5px;
	  margin-left: 82%;
	  *margin-left: 81.5%;
	}
	.navbar-inner, .brand
	{
	   background: rgb(0,136,204); /* Old browsers */
	    /* remove the gradient */
	   background-image: none;
	    /* set font color to white */
	    color: white ! important;
	}

	.comments{
		padding-top: 10px;
		margin:0px;
		list-style-type: none;
		color:white;
		font-size: 11px;
		font-family: 'lucida grande',tahoma,verdana,arial,sans-serif;

	}
	.comments li{
		background-color: rgba(255,230,204,0.3 );
		//#FFE6CC;
		margin-bottom:2px;
		padding:0px 3px 0px 3px;
		line-height:1.5;

	}
	.comment-timestamp{
		color:#DBB84D;
		font-weight: bold;
		font-size: 10px;
	}
	.like-dislike{
		padding-left:10px;
		padding-right:10px;
		padding-top:20px;
	}
	#results{
		list-style-type: none;
		font-weight:bold;
		font-size:16px;
		padding-top:5px;
		padding-bottom:5px;
	}
	
	</style>

	<script src="js/jquery.js" type="text/javascript"></script>
   	<script src="js/bootstrap.min.js" type="text/javascript"></script>
   	<script src="js/bootstrap-datepicker.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/jquery.slimscroll.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/liveSearch.js"></script>

   	<script>
		function onLoadFunction(){

	      	var x = $('#online-friends').height();
			var y = $('#online-friends').width();
      		$('#online-friends').slimScroll({
	      	 height: x,
	      	 width: y,
	      	 wrapperClass:'slimScrollDiv3'
	      	});	
		}
					
	</script>
  </head>
  <body onload="onLoadFunction()">
  <div class="container-fluid max-height no-overflow">
	<div class="row-fluid" id="top">
		<div class="span10">
			<div class="row-fluid  navbar-fixed-top span10" id="top" >
				<div >
					<div class="navbar">
					<div class="navbar-inner">
						<a class="brand offset1" href="feed.php">Mini-Facebook</a>
					<ul class="nav">
					  <li>
					       <form class="navbar-search pull-left">
						    	<input type="text" class="search-query" id="searchFriend" placeholder="Search">
						    	<ul id="results"></ul>
						    </form>
					  </li>
					  <li><a href="feed.php" style="color:white;">Home</a></li>
					  <li ><a style="color:white;" href="profile.php">Profile</a></li>
					  <li class="dropdown">
						<a class="dropdown-toggle"
						   data-toggle="dropdown"
						   href="#" style="color:white;">
							Notifications
							<b class="caret"></b>
						  </a>
						<ul class="dropdown-menu">
						  <?php
						  	foreach($_SESSION['CurEvent'] as $ce){
						  		$result1 = mysql_query("select `first_name`,`last_name` from `Profile` where user_id = \"".$ce[0]."\" ");
								$row1 = mysql_fetch_array($result1);
						  		echo "<li><a href=\"Event.php?event_id=".$ce[2]."\">Event <b>".$ce[1]."</b> by ".$row1['first_name']." ".$row1['last_name']."<br/>is scheduled <b>Today</b>"."</a></li>";
						  	}
						  	$count = 0;
							  foreach($_SESSION['notifications'] as $noti){
							  	if($count > 6) break;
							  	$result1 = mysql_query("select `first_name`,`last_name` from `Profile` where user_id = \"".$noti[1]."\" ");
								$row1 = mysql_fetch_array($result1);
							  	if($noti[0]==='post')echo "<li><a href=\"post.php?post_id=".$noti[4]."\">New post by ".$row1['first_name']." ".$row1['last_name']."<br/>".$noti[2]."</a></li>";
							  	else if($noti[0]==='comment')echo "<li><a href=\"post.php?post_id=".$noti[4]."\">".$row1['first_name']." ".$row1['last_name']." commented on a post.<br/>".$noti[2]."</a></li>";
							  	else echo "<li><a href=\"Event.php?event_id=".$noti[4]."\">".$row1['first_name']." ".$row1['last_name']." created an event.<br/>".$noti[2]."</a></li>";
							  	$count++;
							  }
						  ?>
						</ul>
					  </li>
					  
					  <li class="dropdown">
						<a class="dropdown-toggle"
						   data-toggle="dropdown"
						   href="#" style="color:white;">
							Requests
							<b class="caret"></b>
						  </a>
						<ul class="dropdown-menu">
						  <?php
							  foreach($_SESSION['requests'] as $req){
							  	$result1 = mysql_query("select `first_name`,`last_name` from `Profile` where user_id = \"".$req[0]."\" ");
								$row1 = mysql_fetch_array($result1);
							  	echo "<li><a href=\"profile.php?user_id=".$req[0]."\">".$row1['first_name']." ".$row1['last_name']." sent you a request.<br/>".$req[1]."</a></li>";
							  }
						  ?>
						</ul>
					  </li>
					  
					  <li><a href="messages.php?receiver=empty" style="color:white;">Messages</a></li>
					  <li><a href="logout.php" style="color:white;">Logout</a></li>
					</ul>
					</div>
					</div>
				</div>
			</div>
			
			<div class="row-fluid " id="panelGuest">
				<div class="span3" style="border-right:4px solid #007AA3;">
					<?php
					echo '<img src="data:image/jpeg;base64,'.base64_encode( $_SESSION['user_profile']['image'] ) . '" width="80%" class="img-polaroid"/>';
					?>
					<br>
					<br>
					<ul class="nav nav-list" id="left-menu">
						<li class="nav-header">Favorites</li>
						<li><a href="feed.php">New Feed</a></li>
						<li><a href="messages.php?receiver=empty">Messages</a></li>
						
						<li class="nav-header">Events</li>
						<li class="active"><a href="event.php">Your Events</a></li>

						<li class="nav-header">Friends & Followers</li>
						<li><a href="friendList.php">Friend List</a></li>
						<li ><a href="followerList.php">Follower List</a></li>
						
					</ul>
				</div>		
				<div class="span7 offset1">
					<h3> Create an Event </h3>
					<div>
					<form method="post" action="newEvent.php">
					
					<textarea name="event-description" rows="6" style="width:55%; float:left;" placeholder="Description of the event"></textarea>
					
					<input type="text" name="event-name" style="float:right; width:40%;" placeholder="Event name">
					<br>
					<br>
					<input type="text" name="event-date" class="datepicker" style="float:right; width:40%;" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd">
					<br>
					<br>
					<input type="number" name="event-time-hours" style="float:left; width:18%; margin-left:5px;" placeholder="hh" min="0" max="23">
					<input type="number" name="event-time-mins" style="float:right; width:18%;" placeholder="mm" min="0" max="59">
					
					<div style="clear:both"></div>
					
					<input type="text" name="event-house-no" style="float:left; width:47%;" placeholder="House Number">
					<input type="text" name="event-street" style="float:right; width:47%;" placeholder="Street">
					<br>
					<input type="text" name="event-city" style="float:left; width:47%;" placeholder="City">
					<input type="text" name="event-state" style="float:right; width:47%;" placeholder="State">
					<br>
					<input type="number" name="event-pin" style="float:left; width:47%;" placeholder="Pin Code">
					<input type="text" name="event-country" style="float:right; width:47%;" placeholder="Country">
					<br>

					<br>
					<button class="btn btn-inverse" type="submit"style="margin-bottom:30px; width:125px;">Create!</button>
					</form>
					</div>
				
				
					<h3> Upcoming Events </h3>
					<?php if($query_out = mysql_query($event_info)){
							while($_SESSION['event_info']= mysql_fetch_assoc($query_out)){
								$creator = "SELECT first_name,last_name,user_id from Profile,Event where Profile.user_id = Event.sender_id and sender_id = \"".$_SESSION['event_info']['sender_id']."\";";
								$query_out3 = mysql_query($creator);
								$_SESSION['creator'] = mysql_fetch_assoc($query_out3);
								// if($_SESSION['creator']['user_id'] == $_SESSION['userId'])
								echo "<div>";
								$eventidd = $_SESSION['event_info']['event_id'];
								if($_SESSION['creator']['user_id'] == $_SESSION['userId'])
								echo "<form action='deleteEvent.php' method='post'>
								<input type='hidden' name='eventId' value='$eventidd'>
								<button type='submit' class='btn btn-danger' style=\"float:right;\">Cancel Event</button>
								</form>";
								echo "<div><dl class=\"dl-horizontal\">
								<dt>Event Name</dt>
								<dd>".$_SESSION['event_info']['event_name']." </dd>
								<dt>Date</dt>
								<dd>".$_SESSION['event_info']['event_date_time']." </dd>
								<dt> Created by </dt>
								<dd> ".$_SESSION['creator']['first_name']." ".$_SESSION['creator']['last_name']." </dd>
								<dt> Description </dt>
								<dd>".$_SESSION['event_info']['description']."</dd>
								<dt> Address </dt>
								<dd> <address>
									".$_SESSION['event_info']['house_no']."<br>
									".$_SESSION['event_info']['street']."<br>
									".$_SESSION['event_info']['city']."<br>
									".$_SESSION['event_info']['state']."<br>
									".$_SESSION['event_info']['country']."<br>
									".$_SESSION['event_info']['pin']."
								</address>
								</dd>
								</dl></div></div>
								";}}?>
					
					
					
					
				</div>
			</div>
	  </div>
		<div class="span2" id="right-bar" style="position:fixed; height:100%;">
			<div id="ticker" style="height:40%;">
			<ul class="nav nav-list" id="left-menu" >
				<li class="nav-header">Links</li>
				<li>
				<a href="http://asc.iitb.ac.in" target="_blank" width="100%"> 
						<span class="label label-info" style="padding-right:71px; padding-left:71px;"> 
							<h4> ASC </h4> 
						</span> 
				</a>
				</li>
				<li>
				<a href="http://gpo.iitb.ac.in" target="_blank" width="100%"> 
						<span class="label label-important" style="padding-right:70px; padding-left:70px;"> 
							<h4> GPO </h4> 
						</span> 
				</a>
				</li>
				<li>
				<a href="http://moodle.iitb.ac.in" target="_blank" width="100%"> 
						<span class="label label-warning" style="padding-right:58px; padding-left:58px;"> 
							<h4> Moodle </h4> 
						</span> 
				</a>
				</li>
				<li>
				<a href="http://www.cse.iitb.ac.in" target="_blank" width="100%"> 
						<span class="label label-success" style="padding-right:72px; padding-left:71px;"> 
							<h4> CSE </h4> 
						</span> 
				</a>
				</li>
				<li>
				<a href="http://www.iitb.ac.in" target="_blank" width="100%"> 
						<span class="label label-inverse" style="padding-right:73px; padding-left:73px;"> 
							<h4> IITB </h4> 
						</span> 
				</a>
				</li>
			</ul>
			</div>
			<hr>
			<div id="online" style="height:60%;">
			<div id = "online-friends" class="scrollable" style="height:80%; width:90%;">
				<ul class="nav nav-list" id="left-menu"  >
					<li class="nav-header">Online Friends</li>
					<?php 
					$friends = "select user_id1 as id from Friends_with where user_id2 = \"".$_SESSION['userId']."\" UNION select user_id2 as id from Friends_with where user_id1 = \"".$_SESSION['userId']."\";";
					$count = 0;
					if($query_out1 = mysql_query($friends)){
						while($_SESSION['friends'] = mysql_fetch_assoc($query_out1)){
							$online = "select first_name,last_name from Profile,User where Profile.user_id = User.user_id and User.user_id = \"".$_SESSION['friends']['id']."\" and User.online = 1;";
							if($query_out3 = mysql_query($online)){
								if($_SESSION['online'] = mysql_fetch_assoc($query_out3)){
								echo "<li><a id=\"of$count\" href=\"#\">".$_SESSION['online']['first_name']." ".$_SESSION['online']['last_name']."</a></li>";
								$count += 1;
								}
							}
					}}?>
				</ul>
			</div>
			<input id="onlineSearch" style="width:90%; margin-top:3%; margin-left:5%;" placeholder="Search Friend.." />
	  </div>
	  </div>

  </div>
  </div>
  
  <script>
	$(document).ready(function() {
		$('.datepicker').datepicker();
	  });
	  
	  function online(){
			//Send an XMLHttpRequest to the 'show-message.php' file
			if(window.XMLHttpRequest){
				xmlhttp = new XMLHttpRequest();
				xmlhttp.open("GET","online.php",false);
				xmlhttp.send(null);
			}
			else{
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				xmlhttp.open("GET","online.php",false);
				xmlhttp.send();
			}
			//Replace the content of the messages with the response from the 'show-messages.php' file
			document.getElementById('online-friends').innerHTML = xmlhttp.responseText;
			//Repeat the function each 10 seconds
			setTimeout('online()',3000);
		}

		online();
	  
  </script>
  </body>
</html>
