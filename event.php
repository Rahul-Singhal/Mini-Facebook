<?php
	session_start();
	if(!isset($_SESSION['userId'])){
		header('Location: index.php');
	}
	require "getNotificationsAndRequests.php";
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Mini-Facebook</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
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
	
	</style>

	<script src="js/jquery.js" type="text/javascript"></script>
   	<script src="js/bootstrap.min.js" type="text/javascript"></script>
   	<script src="js/jquery.slimscroll.js" type="text/javascript"></script>

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
						<a class="brand offset1" href="#">Mini-Facebook</a>
					<ul class="nav">
					  <li>
					       <form class="navbar-search pull-left">
						    	<input type="text" class="search-query" placeholder="Search">
						    </form>
					  </li>
					  <li><a href="#" style="color:white;">Home</a></li>
					  <li class="active"><a href="#">Profile</a></li>
					  <li class="dropdown">
						<a class="dropdown-toggle"
						   data-toggle="dropdown"
						   href="#" style="color:white;">
							Notifications
							<b class="caret"></b>
						  </a>
						<ul class="dropdown-menu">
						    <?php
						  	$count = 0;
							  foreach($_SESSION['notifications'] as $noti){
							  	if($count > 6) break;
							  	if($noti[0]==='post')echo "<li><a href=\"#\">New post by ".$noti[1]."<br/>".$noti[2]."</a></li>";
							  	else if($noti[0]==='comment')echo "<li><a href=\"#\">".$noti[1]." commented on a post.<br/>".$noti[2]."</a></li>";
							  	else echo "<li><a href=\"#\">".$noti[1]." created an event.<br/>".$noti[2]."</a></li>";
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
							  	echo "<li><a href=\"#\">".$req[0]." sent you a request.<br/>".$req[1]."</a></li>";
							  }
							?>
						</ul>
					  </li>
					  
					  <li><a href="messages.php?receiver=empty" style="color:white;">Messages</a></li>
					  <li><a href="settings.php" style="color:white;">Settings</a></li>
					</ul>
					</div>
					</div>
				</div>
			</div>
			
			<div class="row-fluid " id="panelGuest">
				<div class="span3" style="border-right:4px solid #007AA3;">
					<img src="img/me.png" width="80%" class="img-polaroid">
					<br>
					<br>
					<ul class="nav nav-list" id="left-menu">
						<li class="nav-header">Favorites</li>
						<li><a href="#">New Feed</a></li>
						<li><a href="messages.php?receiver=empty">Messages</a></li>
						
						<li class="nav-header">Events</li>
						<li><a href="#">Upcoming</a></li>
						<li><a href="#">Recent</a></li>
						
						<li class="nav-header">Friends & Followers</li>
						<li><a href="friendList.php">Friend List</a></li>
						<li><a href="followerList.php">Follower List</a></li>
						
					</ul>
				</div>		
				<div class="span7 offset1">
					<h3> Upcoming Events </h3>
					
					<dl class="dl-horizontal">
					<dt> 23rd October, 1897 </dt>
					<dd> 6:00 pm </dd>
					<dt> Created by </dt>
					<dd> Mayank Dehgal </dd>
					<dt> Description </dt>
					<dd> Lauren Lauren Lauren Lauren Lauren Lauren Lauren Lauren Lauren Lauren Lauren Lauren Lauren Lauren Lauren Lauren </dd>
					<dt> Address </dt>
					<dd> <address>
						C/403, <br>
						Chandan Avenue, <br>
						Mira Road, Thane, <br>
						Maharashtra, <br>
						India <br>
						Pin-Code : 401107
					</address>
					</dd>
					</dl>
					
					
					<dl class="dl-horizontal">
					<dt> 23rd October, 1896 </dt>
					<dd> 6:00 pm </dd>
					<dt> Created by </dt>
					<dd> Mayank Dehgal </dd>
					<dt> Description </dt>
					<dd> Lauren Lauren Lauren Lauren Lauren Lauren Lauren Lauren Lauren Lauren Lauren Lauren Lauren Lauren Lauren Lauren </dd>
					<dt> Address </dt>
					<dd> <address>
						C/403, <br>
						Chandan Avenue, <br>
						Mira Road, Thane, <br>
						Maharashtra, <br>
						India <br>
						Pin-Code : 401107
					</address>
					</dd>
					</dl>
					
				</div>
			</div>
	  </div>
		<div class="span2" id="right-bar" style="position:fixed; height:100%;">
			<div id="ticker" style="height:40%;">
			<ul class="nav nav-list" id="left-menu" >
				<li class="nav-header">Activities</li>
				<li id="ticker-item"><a href="#">Rahul Singhal is now friends with Aditya Raj</a></li><div id="line"></div>
				<li id="ticker-item"><a href="#">Aditya Raj likes your status "yo"</a></li><div id="line"></div>
				<li id="ticker-item"><a href="#">Nishit Bhandari poked you.</a></li><div id="line"></div>
			</ul>
			</div>
			<hr>
			<div id="online" style="height:60%;">
			<div id = "online-friends" class="scrollable" style="height:80%; width:90%;">
				<ul class="nav nav-list" id="left-menu"  >
					<li class="nav-header">Online Friends</li>
					<li><a href="#">Rahul Singhal</a></li>
					<li><a href="#">Aditya Raj</a></li>
					<li><a href="#">Nishit Bhandari</a></li>
					<li><a href="#">Nishit Bhandari</a></li>
					<li><a href="#">User1</a></li>
					<li><a href="#">User2</a></li>
					<li><a href="#">User3</a></li>
					<li><a href="#">User4</a></li>
					<li><a href="#">User5</a></li>
					<li><a href="#">User6</a></li>
					<li><a href="#">User7</a></li>
					<li><a href="#">User8</a></li>
					<li><a href="#">User9</a></li>
				</ul>
			</div>
			<input style="width:90%; margin-top:3%; margin-left:5%;" placeholder="Search Friend.." />
			</div>
	  </div>

  </div>
  </div>
  </body>
</html>
