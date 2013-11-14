<?php
	session_start();
	if(!isset($_SESSION['userId'])){
		header('Location: index.php');
	}

	require "getNotificationsAndRequests.php";

	require "connect.inc.php";

	$checkValid = "SELECT * FROM Post_notification WHERE `post_id`=".$_GET['post_id']." AND `receiver_id` = '".$_SESSION['userId']."'";
	// echo $checkValid;
	// exit;
	$out=mysql_query($checkValid);
	// echo $out;
	// exit;
	if($row = mysql_fetch_assoc($out)){

	}
	else{
		header('Location: feed.php');
	}

	$username = "select first_name,last_name from Profile where user_id = \"".$_SESSION['userId']."\";";
	$_SESSION['username'] = mysql_fetch_assoc(mysql_query($username));
	// $query = "select * from (select post_id,max(date_time) as date_time from (SELECT post_id,date_time FROM `Post`,`Posts` WHERE Post.post_id not in
	// 		(select post_id from Comment) and `post_id` = `posts_post_id` and user_id= \"".$_SESSION['userId']."\" 
	// 		UNION SELECT Post.post_id,date_time FROM `Post`,`Post_notification` where Post.post_id not in
	// 		(select post_id from Comment) and `Post`.`post_id` = `Post_notification`.`post_id` AND receiver_id= \"".$_SESSION['userId']."\" UNION	
	// 		select post_id,date_time from Comment where post_id in 
	// 		(SELECT post_id FROM `Post`,`Posts` WHERE `post_id` = `posts_post_id` and user_id= \"".$_SESSION['userId']."\" 
	// 		UNION SELECT Post.post_id FROM `Post`,`Post_notification` where 
	// 		`Post`.`post_id` = `Post_notification`.`post_id` AND receiver_id= \"".$_SESSION['userId']."\" ))t1 group by t1.post_id)t2 order by t2.date_time desc ;";

	
	
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
						<a class="brand offset1" href="#">Mini-Facebook</a>
					<ul class="nav">
					  <li>
					       <form class="navbar-search pull-left">
						    	<input type="text" class="search-query" id="searchFriend" placeholder="Search">
						    	<ul id="results"></ul>
						    </form>
					  </li>
					  <li class="active"><a href="#" style="color:white;">Home</a></li>
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
						<li class="active"><a href="#">New Feed</a></li>
						<li><a href="messages.php?receiver=empty">Messages</a></li>
						
						<li class="nav-header">Events</li>
						<li><a href="event.php">Your Events</a></li>
						
						<li class="nav-header">Friends & Followers</li>
						<li><a href="friendList.php">Friend List</a></li>
						<li><a href="followerList.php">Follower List</a></li>
						
					</ul>
				</div>		
				<div class="span7 offset1">
					<div>
					<form method="post" action="newPost.php">
					<textarea name="new_post" rows="6" style="width:100%;" <?php echo "placeholder=\"Hey! ".$_SESSION['username']['first_name']." ".$_SESSION['username']['last_name']."... Share your thoughts!!\"";?> ></textarea>
					<button class="btn btn-inverse" type="submit"style="margin-bottom:30px; width:125px;">Post!</button>
					</form>
					</div>
					
					<?php
								$post_info = "select post_id,date_time,likes,data from Post where post_id = \"".$_GET['post_id']."\";";
								$query_out4 = mysql_query($post_info);
								$_SESSION['post_info'] = mysql_fetch_assoc($query_out4);
								$post_sender = "SELECT first_name,last_name,image from Profile,Posts where Profile.user_id = Posts.user_id and posts_post_id = \"".$_SESSION['post_info']['post_id']."\";";
								$query_out2 = mysql_query($post_sender);
								$_SESSION['post_sender'] = mysql_fetch_assoc($query_out2);
					echo "<div class=\"post\" id = \"".$_SESSION['post_info']['post_id']."\">
						<div class=\"media\">
							<a class=\"pull-left\" href=\"#\">";
							echo '<img src="data:image/jpeg;base64,'.base64_encode( $_SESSION['post_sender']['image'] ) . '" width="64px" height="64px" class="img-polaroid"/>';
							echo "</a>
							<div class=\"media-body\">
									  
	  
    
								<h4 class=\"media-heading\">".$_SESSION['post_sender']['first_name']." ".$_SESSION['post_sender']['last_name']."</h4>"	
								.$_SESSION['post_info']['data']."
								<div class=\"like-dislike\">
									<form method=\"post\" action=\"like.php\">
									<button type=\"submit\" name=\"like\" class=\"btn btn-success btn-mini\">
										<i class=\"icon-large icon-thumbs-up\"></i> Like									
									</button>
									<button type=\"submit\" name=\"dislike\" class=\"btn btn-danger btn-mini pull-right\">
										<i class=\"icon-large icon-thumbs-down\"></i> Dislike									
									</button>
									<input type=\"hidden\" name=\"post_id\" class=\"span8\" style=\"margin:5px 10px 5px 15px;\" value=\"".$_SESSION['post_info']['post_id']."\">
									</form>
								</div>
								<div style=\"background-color:#3D4A6C; padding:5px 10px 5px 10px; border-radius:10px;\">
									<div>
										<span class=\"label label-info\">".$_SESSION['post_info']['likes']." likes </span>
										<span class=\"pull-right\">
											<span class=\"label label-success\">".date('F j,Y,g:i a',strtotime($_SESSION['post_info']['date_time']))."</span>
										</span>
									</div>
									<ul class=\"comments\">";
									$comment_query = "Select * FROM Comment WHERE Comment.post_id = \"".$_SESSION['post_info']['post_id']."\" ORDER BY date_time ASC;";
										$index = 1;
										if($query_out = mysql_query($comment_query)){
												while($_SESSION['comment_info'] = mysql_fetch_assoc($query_out)){
												$comment_sender = "SELECT first_name, last_name,image from Profile,Comment where Profile.user_id = Comment.sender_id and Comment.post_id = \"".$_SESSION['comment_info']['post_id']."\" and Comment.comment_id = \"".$_SESSION['comment_info']['comment_id']."\";";
												$query_out3 = mysql_query($comment_sender);
												$_SESSION['comment_sender'] = mysql_fetch_assoc($query_out3);
										echo "<li id = \"".$_SESSION['comment_info']['post_id'].$_SESSION['comment_info']['comment_id']."\">
											<span class=\"label label-default\">".$_SESSION['comment_sender']['first_name']." ".$_SESSION['comment_sender']['last_name']."</span>".$_SESSION['comment_info']['data']."
											<br/>
											<span class=\"comment-timestamp\">".date('F j,Y,g:i a',strtotime($_SESSION['comment_info']['date_time']))."</span>
										</li>";
											//$index = (int)($_SESSION['comment_info']['comment_id']);
											$index++;
										
										 }} 
										
										echo "<li name = \"".$_SESSION['post_info']['post_id'].$index."\">
											<form method=\"post\" action=\"newComment.php\">
											<span class=\"label label-default\">".$_SESSION['username']['first_name']." ".$_SESSION['username']['last_name']."</span>
											<input name=\"commentData\" type=\"text\" onkeydown=\"if (event.keyCode == 13) { this.form.submit(); return false; }\" placeholder=\"Comment here!\" style=\"margin:5px 0px 5px 0px; width:74%;\">
											<input type=\"hidden\" name=\"comment_id\" class=\"span8\" style=\"margin:5px 10px 5px 15px;\" value=\"".$_SESSION['post_info']['post_id']."_".$index."\">
											</form>
										</li>
									</ul>
								</div>
							</div>
							
						</div>
					</div>
					<hr/>";?>


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
  
  
	<script type="text/javascript">

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
