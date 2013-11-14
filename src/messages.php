<?php
	session_start();
	if(!isset($_SESSION['userId'])){
		header('Location: index.php');
	}
	require "connect.inc.php";
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
		overflow: hidden;
	}
	.scrollable:hover{
		overflow-y:scroll;
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
	.message {
	   overflow:hidden;
	   width:498px;
	   margin-bottom:5px;
	   border:1px solid #999;
	}
	.messagehead {
	   overflow:hidden;
	   background:#FFC;
	   width:500px;
	}
	.messagecontent {
	   overflow:hidden;
	   width:496px;
	}
	.navbar-inner, .brand
	{
	   background: rgb(0,136,204); /* Old browsers */
	    /* remove the gradient */
	   background-image: none;
	    /* set font color to white */
	    color: white ! important;
	}

	.populate-messages li{
		width:100%
	}

	.Mtime{
		color: #673030;
		font-weight: bold;
		font-size: 10px;
	}

	.sendersMessage{
		border-left:5px solid rgb(238,238,238);
		padding-top:5px;
		padding-bottom:5px;
		padding-left:15px;
		width:70%;
	}

	.receiversMessage{
		border-right:5px solid rgb(238,238,238);
		padding-top:5px;
		padding-bottom:5px;
		padding-right:15px;
		text-align:right;
		margin-left:27%;
		width:70%;
	}
	.slimScrollDiv1{
		float:left;
	}
	.slimScrollDiv2{

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
			var x = $('#messageUsers').height();
			var y = $('#messageUsers').width();
      		$('#messageUsers').slimScroll({
	      	 height: x,
	      	 width: y,
	      	 wrapperClass:'slimScrollDiv1'
	      	});

	      	var x = $('#messageArea').height();
			var y = $('#messageArea').width();
      		$('#messageArea').slimScroll({
	      	 height: x,
	      	 width: y,
	      	 start:'bottom',
	      	 wrapperClass:'slimScrollDiv2'

	      	});

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
					  <li><a style="color:white;" href="profile.php">Profile</a></li>
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
					  
					  <li class="active"><a href="#" style="color:white;">Messages</a></li>
					  <li><a href="logout.php" style="color:white;">Logout</a></li>
					</ul>
					</div>
					</div>
				</div>
			</div>
			
			<div class="row-fluid" id="panelGuest" >
				<div class="span4 scrollable" style="height:600px;" id="messageUsers">
					<ul style="list-style-type:none;">
						<?php 
						$data = array();
						//$userid = $_SESSION['userId'];
						//$results = mysql_query("SELECT `user_id1` FROM  `friends_with` WHERE `user_id2` = \"".$_SESSION['userId']."\" UNION SELECT `user_id2` AS 'user_id1' FROM `friends_with` WHERE `user_id1` =  \"".$_SESSION['userId']."\" ");
						$results = mysql_query("SELECT distinct id from ((select date_time,receiver_id as id,data from `Message` where sender_id = \"".$_SESSION['userId']."\") UNION (select date_time,sender_id as id,data from `Message` where receiver_id = \"".$_SESSION['userId']."\") order by date_time DESC ) AS `table`");
						// echo "SELECT distinct id from ((select date_time,receiver_id as id,data from `Message` where sender_id = \"".$_SESSION['userId']."\") UNION (select date_time,sender_id as id,data from `Message` where receiver_id = \"".$_SESSION['userId']."\") order by date_time DESC ) AS `table`";
						// exit;
						while($row = mysql_fetch_array($results)) {
							$data[]=$row['id'];
							$result1 = mysql_query("select `first_name`,`last_name` from `Profile` where user_id = \"".$row['id']."\" ");
							$row1 = mysql_fetch_array($result1);
						?>
						<a href = "messages.php?receiver=<?php echo $row['id'] ?>" >
						<li><blockquote><p><?php echo $row1['first_name'] . " " . $row1['last_name'] ?></p></blockquote></li>
						<hr/>
						</a>
						<?php 
						}
						?>
						<hr/>
						<hr/>
						<?php
						$results = mysql_query("SELECT `user_id1` AS `id` from `Friends_with` where `user_id2` = \"".$_SESSION['userId']."\" UNION SELECT `user_id2` AS `id`from `Friends_with` where `user_id1` = \"".$_SESSION['userId']."\" ");
						while($row = mysql_fetch_array($results)) {
							if(!in_array($row['id'], $data)){
							$result1 = mysql_query("select `first_name`,`last_name` from `Profile` where user_id = \"".$row['id']."\" ");
							$row1 = mysql_fetch_array($result1);
							?>
							<a href = "messages.php?receiver=<?php echo $row['id'] ?>" >
							<li><blockquote><p><?php echo $row1['first_name'] . " " . $row1['last_name'] ?></p></blockquote></li>
							<hr/>
							</a>
							<?php 
							}
						}
						?>
					</ul>
				</div>		
				<?php 
					//$userid = $_SESSION['userId'];
					//$results = mysql_query("SELECT `user_id1` FROM  `friends_with` WHERE `user_id2` = \"".$_SESSION['userId']."\" UNION SELECT `user_id2` AS 'user_id1' FROM `friends_with` WHERE `user_id1` =  \"".$_SESSION['userId']."\" ");
					$other_id = $_GET["receiver"];
					if($other_id==='empty'){
						$results = mysql_query("SELECT distinct id from ((select date_time,receiver_id as id,data from `Message` where sender_id = \"".$_SESSION['userId']."\") UNION (select date_time,sender_id as id,data from `Message` where receiver_id = \"".$_SESSION['userId']."\") order by date_time DESC ) AS `table`");
						$row = mysql_fetch_array($results);
						$other_id = $row['id'];
					}
					$results = mysql_query("select `first_name`,`last_name` from `Profile` where user_id = \"".$other_id."\" ");
					$row = mysql_fetch_array($results);
				?>
				<div class="span7" style="">
					<h4 class="text-info text-center"><?php echo $row['first_name'] . " " . $row['last_name'] ?></h4>
					<div style="height:400px; border-left:2px solid rgb(238,238,238); border-right:2px solid rgb(238,238,238);" class="scrollable"  id = "messageArea">
						<ul style="list-style-type:none; width:90%;" class="populate-messages">
							<?php
							$results = mysql_query("select * from `Message` where `sender_id` = \"".$_SESSION['userId']."\" AND `receiver_id` = \"".$other_id."\" OR  `sender_id` = \"".$other_id."\" AND `receiver_id` = \"".$_SESSION['userId']."\" order by date_time ASC");
							
							while($row = mysql_fetch_array($results)) {
								if($row['sender_id'] === $other_id){
								?>
								<li><div class="receiversMessage"><span class="Mtime"><?php echo date('F j,Y,g:i a',strtotime($row['date_time'])); ?></span><br/><?php echo $row['data'] ?></div></li>
								<?php 
								}
								else{
								?>
								<li><div class="sendersMessage"><span class="Mtime"><?php echo date('F j,Y,g:i a',strtotime($row['date_time'])); ?></span><br/><?php echo $row['data'] ?></div></li>
								<?php
								}
							}
							?>
						</ul>

					</div>
					<div class="text-center">
						<textarea id="message" rows="4" style="width:90%; margin-top:20px;"></textarea>
						<input type="button" value="Send" onClick="send();"/>
					</div>
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
			<hr/>
			<div id="online" style="height:60%;">
			<div id = "online-friends" class="scrollable" style="height:80%; width:90%;">
				<ul class="nav nav-list" id="left-menu"  >
					<li class="nav-header">Online Friends</li>
					<?php 
					$friends = "select user_id1 as id from Friends_with where user_id2 = \"".$_SESSION['userId']."\" UNION select user_id2 as id from Friends_with where user_id1 = \"".$_SESSION['userId']."\";";			
					if($query_out1 = mysql_query($friends)){
							while($_SESSION['friends'] = mysql_fetch_assoc($query_out1)){
								$online = "select first_name,last_name from Profile,User where Profile.user_id = User.user_id and User.user_id = \"".$_SESSION['friends']['id']."\" and User.online = 1;";
								if($query_out3 = mysql_query($online)){
									if($_SESSION['online'] = mysql_fetch_assoc($query_out3)){
									echo "<li><a href=\"#\">".$_SESSION['online']['first_name']." ".$_SESSION['online']['last_name']."</a></li>";
									}
								}
					}}?>
				</ul>
			</div>
			<input style="width:90%; margin-top:3%; margin-left:5%;" placeholder="Search Friend.." />
	  </div>

  </div>

<script type="text/javascript">

function showmessages(){
   //Send an XMLHttpRequest to the 'show-message.php' file
   var otherid = "<?php echo $other_id ; ?>";
   var showurl = 'show-messages.php?other='+otherid;
   if(window.XMLHttpRequest){
      xmlhttp = new XMLHttpRequest();
      xmlhttp.open("GET",showurl,false);
      xmlhttp.send(null);
   }
   else{
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      xmlhttp.open("GET",showurl,false);
      xmlhttp.send();
   }
   //Replace the content of the messages with the response from the 'show-messages.php' file
   document.getElementById('messageArea').innerHTML = xmlhttp.responseText;
   //Repeat the function each 3 seconds
   setTimeout('showmessages()',3000);
}
//Start the showmessages() function
showmessages();

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
   //Repeat the function each 3 seconds
   setTimeout('online()',3000);
}

online();

function cleartext(){
	document.getElementById("message").value = "";
}

function send(){
   //Send an XMLHttpRequest to the 'send.php' file with all the required informations
   console.log("yp there");
   var receiver = "<?php echo $other_id ; ?>";
   var sendto = 'send.php?message=' + document.getElementById('message').value + '&name=' + receiver;
   if(window.XMLHttpRequest){
      xmlhttp = new XMLHttpRequest();
      xmlhttp.open("GET",sendto,false);
      xmlhttp.send();
   }
   else{
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      xmlhttp.open("GET",sendto,false);
      xmlhttp.send();
   }
   cleartext();
}
 
</script>
  
   
  </body>
</html>