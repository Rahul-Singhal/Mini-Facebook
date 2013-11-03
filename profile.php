<!DOCTYPE HTML>
<?php
////////////////////// USER SHOULD NOT BE ABLE TO SEND FRIEND REQUEST TO HIMSELF /////////////////////////////////////
	session_start();
	if(!isset($_SESSION['userId'])){
		header('Location: index.php');
	}
	require "connect.inc.php";
	require "getNotificationsAndRequests.php";

	$query = "SELECT * FROM `Profile` WHERE `user_id` = \"".$_SESSION['userId']."\"";
    if($query_out = mysql_query($query)){
      $_SESSION['user_profile'] = mysql_fetch_assoc($query_out);
    }
?>

<html>
  <head>
    <title>Mini-Facebook</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="css/datepicker.css" rel="stylesheet">
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
	#results{
		list-style-type: none;
		font-weight:bold;
		font-size:16px;
		padding-top:5px;
		padding-bottom:5px;
	}
	</style>

	<script src="js/jquery.js" type="text/javascript"></script>
	<script src="js/bootstrap-datepicker.js" type="text/javascript" charset="utf-8"></script>
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
	
	<?php if(isset($_GET['editBasicInfo'])) $editBI = $_GET['editBasicInfo']; 
		  if(isset($_GET['editEduInfo'])) $editEI = $_GET['editEduInfo'];
		  if(isset($_GET['editContactInfo'])) $editCI = $_GET['editContactInfo'];
		  if(isset($_GET['editProfilePhoto'])) $editPP = $_GET['editProfilePhoto'];
		  if(isset($_GET['user_id']) && $_GET['user_id']!=$_SESSION['userId']) {
			//echo "<br> <br> <br> <br> <br> <br>";
			//echo $_GET['user_id'];
			$user_id_page = $_GET['user_id'];
			$query = "SELECT * FROM `Profile` WHERE `user_id` = \"".$user_id_page."\"";
			if($query_out = mysql_query($query)){
			  $_SESSION['user_profile'] = mysql_fetch_assoc($query_out);
			}
			
			$isfriendqry = "select user_id1 as id from Friends_with where user_id2 = \"".$_SESSION['userId']."\" and user_id1 = \"".$user_id_page."\" 
				UNION select user_id2 as id from Friends_with where user_id1 = \"".$_SESSION['userId']."\" and user_id2 = \"".$user_id_page."\";";
				
			$isreqfriendqry = "select `sender_id` from `Request` where sender_id='" . $_SESSION['userId'] . "' and receiver_id='$user_id_page';";
			
			$isfriendreqqry = "select `sender_id` from `Request` where sender_id='$user_id_page' and receiver_id='" . $_SESSION['userId'] . "';";
			//echo $isfriendqry;
			//echo $isfriendreqry;
			//exit();
			//exit();
			
			//$isfriend = 'false';
			//$isreqfriend = 'false';
			//$isfriendreq = 'false';
			
			if($query_out_isfriend = mysql_query($isfriendqry)){
			  $friendddd = mysql_fetch_assoc($query_out_isfriend);
			  if(isset($friendddd) && !empty($friendddd)){
				$isfriend = 'true';
				$isreqfriend = 'false';
				$isfriendreq = 'false';
			  }
			  else {
				$isfriend = 'false';
				$isreqfriend = 'false';
				$isfriendreq = 'false';
			
				 if($query_out_isreqfriend = mysql_query($isreqfriendqry)){
				  $isfriend = 'false';
				  //echo "HERe";
				  $reqfriendddd = mysql_fetch_assoc($query_out_isreqfriend);
				  if(isset($reqfriendddd) && !empty($reqfriendddd)){
					$isreqfriend = 'true';
					$isfriendreq = 'false';
				  }
				  else {
					$isreqfriend = 'false';
					$isfriendreq = 'false';
					
					if($query_out_isfriendreq = mysql_query($isfriendreqqry)){
					  $isreqfriend = 'false';
					  $frienddddreq = mysql_fetch_assoc($query_out_isfriendreq);
					  if(isset($frienddddreq) && !empty($frienddddreq)){
						$isfriendreq = 'true';
					  }
					  else $isfriendreq = 'false';
					}
				  }
				}
				}
			}
			else $isfriendreq = 'false';
			
			
			////  Follower ////////////////////////////////
			$isfollowerqry = "select followed_user_id as id from Follow where followedby_user_id = \"".$_SESSION['userId']."\" and followed_user_id = \"".$user_id_page."\";";
			//echo $isfollowerqry;
			//exit();
			if($query_out_isfollower = mysql_query($isfollowerqry)){
			  $followed = mysql_fetch_assoc($query_out_isfollower);
			  if(isset($followed) && !empty($followed)){
				$isfollowed = 'true';
			  }
			  else $isfollowed = 'false';
			}
			else $isfollowed = 'false';
			  
			
			//////////////////////////////////////////////
		  }
		  else if(isset($_GET['user_id'])){
			$user_id_page = $_GET['user_id'];
			$isfriend = 'false';
			$isreqfriend = 'false';
			$isfriendreq = 'false';
			$isfollowed = 'false';
			$self = 'true';
		  }
		  
		  if(isset($_GET['previewPhoto'])){
			$previewImage='true';
			$image = $_GET['fileName'];
		  }
		  

	?>
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
					  <li><a href="feed.php" style="color:white;">Home <span class="badge">42</span> </a></li>
					  <li class="active"><a href="profile.php">Profile</a></li>
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
							  	$result1 = mysql_query("select `first_name`,`last_name` from `Profile` where user_id = \"".$noti[1]."\" ");
								$row1 = mysql_fetch_array($result1);
							  	if($noti[0]==='post')echo "<li><a href=\"#\">New post by ".$row1['first_name']." ".$row1['last_name']."<br/>".$noti[2]."</a></li>";
							  	else if($noti[0]==='comment')echo "<li><a href=\"#\">".$row1['first_name']." ".$row1['last_name']." commented on a post.<br/>".$noti[2]."</a></li>";
							  	else echo "<li><a href=\"#\">".$row1['first_name']." ".$row1['last_name']." created an event.<br/>".$noti[2]."</a></li>";
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
					if (isset($previewImage) && !isset($user_id_page)) echo "<img src='upload/" . $image . "' width='80%' class='img-polaroid'>";
					else echo '<img src="data:image/jpeg;base64,'.base64_encode( $_SESSION['user_profile']['image'] ) . '" width="80%" class="img-polaroid"/>';
					?>
					<br>
					<br>
						
						<?php
						if (!((isset($editPP) && $editPP=='true') || isset($previewImage)) && !isset($user_id_page)) {
						echo '
						<form action="profile.php" method="get">
						<input type="hidden" value="true" name="editProfilePhoto">
						<button type="submit" class="btn btn-default btn-lg">
						  <i class="icon-edit"></i> Edit
						</button>
						</form>';
						}
						?>
					
					
					<?php
					if (((isset($editPP) && $editPP=='true') || isset($previewImage)) && !isset($user_id_page)) {
						if (isset($previewImage)){
							echo '<form action="saveUserInfo.php" method="post" enctype="multipart/form-data">
							<input type="hidden" name="image" value="'. $image .'">
							<button type="submit" class="btn btn-default btn-lg">
							  <i class="icon-ok-circle"></i> Save
							</button>
							</form>
							';
							
							echo '<form action="profile.php" method="post" enctype="multipart/form-data">
							<button type="submit" class="btn btn-default btn-lg">
							  <i class="icon-remove-circle"></i> Cancel
							</button>
							</form>
							';
						}
						echo ' 
						<form action="uploadFile.php" method="post" enctype="multipart/form-data">
							<input id="lefile" type="file" style="display:none" name="photoFile">
							<div class="input-append">
							<input id="photoCover" class="input-small" type="text">
							<a class="btn" onclick=\'$("input[id=lefile]").click();\'>Browse</a>
							</div>
							<button type="submit" class="btn btn-default btn-lg">
							  <i class="icon-upload"></i> Upload
							</button>
						</form>';
					}
					?>
					
					<ul class="nav nav-list" id="left-menu">
						<li class="nav-header">Favorites</li>
						<li><a href="feed.php">New Feed</a></li>
						<li><a href="messages.php?receiver=empty">Messages</a></li>
						
						<li class="nav-header">Events</li>
						<li><a href="event.php">Your Events</a></li>

						<li class="nav-header">Friends & Followers</li>
						<li><a href="friendList.php">Friend List</a></li>
						<li ><a href="followerList.php">Follower List</a></li>
						
					</ul>
				</div>		
				<div class="span8 ">
					<?php
					////////////// REPLACE  /////////////////////////////////////////////////////////////
					
					if(isset($user_id_page)){
						if($isfriend == 'true')
						echo " <form action='makeFriend.php' method='post' style='float:right'>
							<input type='hidden' name='makeFriend' value='$user_id_page'>
							<input type='hidden' name='adddel' value='del'>
							<input type='hidden' name='redirect' value='profile.php'>
							<button type='submit' class='btn btn-danger'>
							  <i class='icon-remove-circle'></i> Unfriend
							</button>
							</form>";
		////////////////////////////////// PUT REQUEST CANCEL OPTION HERE  ////////////////////////////////////////////				
						else if ($isreqfriend == 'true')
							echo "
							<span style='float:right' class='badge'> <h5> Request sent </h5> </span>
							
							<form action='makeFriend.php' method='post' style='float:right; margin-right:12px'>
							<input type='hidden' name='makeFriend' value='$user_id_page'>
							<input type='hidden' name='adddel' value='cancelReq'>
							<input type='hidden' name='redirect' value='profile.php'>
							<button type='submit' class='btn btn-danger'>
							  <i class='icon-remove-circle'></i> Cancel Friend Request
							</button>
							</form>
							";
							
						else if ($isfriendreq == 'true')
							echo " <form action='makeFriend.php' method='post' style='float:right'>
							<input type='hidden' name='makeFriend' value='$user_id_page'>
							<input type='hidden' name='adddel' value='accept'>
							<input type='hidden' name='redirect' value='profile.php'>
							<button type='submit' class='btn btn-success'>
							  <i class='icon-ok-circle'></i> Accept as Friend
							</button>
							</form>";
						
						else if(!isset($self))
						echo " <form action='makeFriend.php' method='post' style='float:right'>
							<input type='hidden' name='makeFriend' value='$user_id_page'>
							<input type='hidden' name='adddel' value='add'>
							<input type='hidden' name='redirect' value='profile.php'>
							<button type='submit' class='btn btn-success'>
							  <i class='icon-ok-circle'></i> Add Friend
							</button>
							</form>";
							
						if ($isfollowed == 'true')
						echo " <form action='makeFollower.php' method='post' style='float:right; margin-right:12px' >
							<input type='hidden' name='makeFollower' value='$user_id_page'>
							<input type='hidden' name='adddel' value='del'>
							<input type='hidden' name='redirect' value='profile.php'>
							<button type='submit' class='btn btn-danger'>
							  <i class='icon-remove-circle'></i> Unfollow
							</button>
							</form>";
							
						else if(!isset($self))
						echo " <form action='makeFollower.php' method='post' style='float:right; margin-right:12px'>
							<input type='hidden' name='makeFollower' value='$user_id_page'>
							<input type='hidden' name='adddel' value='add'>
							<input type='hidden' name='redirect' value='profile.php'>
							<button type='submit' class='btn btn-success'>
							  <i class='icon-ok-circle'></i> Follow
							</button>
							</form>";
					}
					
					////////////// REPLACE  /////////////////////////////////////////////////////////////
					?>
					<h3 style="float:left"><?php echo $_SESSION['user_profile']['first_name'].' '.$_SESSION['user_profile']['middle_name'].' '.$_SESSION['user_profile']['last_name']; ?></h3>
					<div style=	'clear:both'></div>
					<?php if (!isset($editBI) && !isset($user_id_page)){
					echo '
					<form action="profile.php" method="get" style="float:right">
						<button type="submit" class="btn btn-default btn-lg">
							<i class="icon-edit"></i> Edit
						</button>
						<input type="hidden" value="true" name="editBasicInfo">
					</form>';
					}
					?>
					
					<?php if (isset($editBI) && !isset($user_id_page)) {
						echo "<form action='saveUserInfo.php' method='post'>"; 
						echo '
						<button type="submit" class="btn btn-default btn-lg" style="float:right">
						  <i class="icon-ok-circle"></i> Save
						</button>
						';
					}
					?>
					<dl class="dl-horizontal" style="float:left">
						<h4>Basic Information	</h4>
						<dt>Age</dt>
						<?php //if (isset($editBI) && $editBI=='true' && !isset($user_id_page)){
								//echo "<dd> <input type='number' name='age' value='" . $_SESSION['user_profile']['age'] . "'> </dd>";
							  //}
							  /*else */echo "<dd>". $_SESSION['user_profile']['age'] ."</dd>"; 
						?>
						<dt>Date of Birth</dt>
						<?php if (isset($editBI) && $editBI=='true' && !isset($user_id_page)){
								echo "<dd> <input type='text' name='dob' class='datepicker' data-date-format='yyyy-mm-dd' value='" . $_SESSION['user_profile']['dob'] . "'> </dd>";
							}
							else echo "<dd>" . $_SESSION['user_profile']['dob'] . "</dd>"; 
						?>
						<dt>Relationship Status</dt>
						<?php if (isset($editBI) && $editBI=='true' && !isset($user_id_page)){
								//echo "<dd> <input type='number' name='relationStat' value='" . $_SESSION['user_profile']['relationship_status'] . "'> </dd>";
								if ($_SESSION['user_profile']['relationship_status'] == 0){
								echo "<dd>
											<input type='radio' name='relationStat' value='0' checked='checked' ><span> Single</span><br>
											<input type='radio' name='relationStat' value='1' ><span> In a relationship</span><br><br> 
										   </dd>";
								}
								else{
								echo "<dd>
											<input type='radio' name='relationStat' value='0' ><span> Single</span><br>
											<input type='radio' name='relationStat' value='1' checked='checked'><span> In a relationship</span><br><br> 
										   </dd>";
								}
							}
							else {
								echo "<dd>";
								if($_SESSION['user_profile']['relationship_status'] == 1) echo "In a relationship"; else echo "Single"; 
								echo "</dd>"; 
							}
						?>
						<dt>Gender</dt>
						<?php if (isset($editBI) && $editBI=='true' && !isset($user_id_page)){
								if ($_SESSION['user_profile']['gender'] == 'MALE'){
								echo "<dd>
											<input type='radio' name='sex' value='MALE' checked='checked' ><span> Male</span><br>
											<input type='radio' name='sex' value='FEMALE'><span> Female</span><br><br> 
										   </dd>";
								}
								else {
								echo "<dd>
											<input type='radio' name='sex' value='MALE' ><span> Male</span><br>
											<input type='radio' name='sex' value='FEMALE' checked='checked'><span> Female</span><br><br> 
										   </dd>";
								}
							}
							else echo "<dd>" . ucfirst(strtolower($_SESSION['user_profile']['gender'])) . "</dd>"; 
						?>
					</dl>
					<div style='clear:both'></div>
					<?php if (isset($editBI) && !isset($user_id_page)) echo "</form>"; ?>
					
					
					<form action="profile.php" method="get" style="float:right">
						<input type='hidden' value='true' name='editEduInfo'>
						<?php
						if (!isset($editEI) && !isset($user_id_page)){
						echo '
						<button type="submit" class="btn btn-default btn-lg">
						  <i class="icon-edit"></i> Edit
						</button>';
						}
						?>
					</form>
					
					<?php if (isset($editEI) && !isset($user_id_page)) {
						echo "<form action='saveUserInfo.php' method='post'>"; 
						echo '
						<button type="submit" class="btn btn-default btn-lg" style="float:right">
						  <i class="icon-ok-circle"></i> Save
						</button>';}
					?>
					<dl class="dl-horizontal" style="float:left">
						<h4>Education</h4>
						<dt>Graduation</dt>
						<?php if (isset($editEI) && $editEI=='true' && !isset($user_id_page)) echo "<dd> 
																			<input type='text' name='grad_school' value='" . $_SESSION['user_profile']['graduation_school'] . "'>
																		   </dd>";
							  else echo "<dd>" . $_SESSION['user_profile']['graduation_school'] . "</dd>"; 
							  //echo "<dd>IIT Bombay <small> - 2015 </small> </dd>"; 
						?>
						<dt>High School</dt>
						<?php if (isset($editEI) && $editEI=='true' && !isset($user_id_page)) echo "<dd> 
																			<input type='text' name='high_school' value='" . $_SESSION['user_profile']['high_school'] . "'>
																		   </dd>";
							  else echo "<dd>" . $_SESSION['user_profile']['high_school'] . "</dd>"; 
						?>
						<dt>Primary School</dt>
						<?php if (isset($editEI) && $editEI=='true' && !isset($user_id_page)) echo "<dd> 
																			<input type='text' name='prim_school' value='" . $_SESSION['user_profile']['primary_school'] . "'>
																		   </dd>";
							  else echo "<dd>" . $_SESSION['user_profile']['primary_school'] . "</dd>"; 
						?>
						
					</dl>
					<div style='clear:both'></div>
					<?php if (isset($editEI) && !isset($user_id_page)) echo "</form>"; ?>
					
					<form action="profile.php" method="get" style="float:right">
						<input type='hidden' value='true' name='editContactInfo'>
						<?php
						if (!isset($editCI) && !isset($user_id_page)){
						echo '
						<button type="submit" class="btn btn-default btn-lg">
						  <i class="icon-edit"></i> Edit
						</button>';
						}
						?>
					</form>
					
					<?php if (isset($editCI) && !isset($user_id_page)) {
						echo "<form action='saveUserInfo.php' method='post'>"; 
						echo '
						<button type="submit" class="btn btn-default btn-lg" style="float:right">
						  <i class="icon-ok-circle"></i> Save
						</button>';}
					?>
					<dl class="dl-horizontal" style="float:left">
						<h4>Contact Information</h4>
						<dt>Address:-</dt>
						
						<?php
						if (isset($editCI) && $editCI=='true' && !isset($user_id_page)) echo "	<br> <br>
																		<dt> House number : </dt> <dd> <input type='text' name='houseno' value='" . $_SESSION['user_profile']['house_no'] . "'> </dd>
																		<dt> Street : </dt> <dd> <input type='text' name='street' value='" . $_SESSION['user_profile']['street'] . "'> </dd>
																		<dt> PIN code : </dt> <dd> <input type='number' name='pin_code' value='" . $_SESSION['user_profile']['pin'] . "'> </dd>
																		<dt> City : </dt> <dd> <input type='text' name='city' value='" . $_SESSION['user_profile']['city'] . "'> </dd>
																		<dt> State : </dt> <dd> <input type='text' name='state' value='" . $_SESSION['user_profile']['state'] . "'> </dd>
																		";
							  else echo "<dd>
											<address>" .
											$_SESSION['user_profile']['house_no'].' '.$_SESSION['user_profile']['street'] . ", <br>" .
											$_SESSION['user_profile']['city']. ", <br>" .
											$_SESSION['user_profile']['pin']. ", <br>" .
											$_SESSION['user_profile']['state'].', '.$_SESSION['user_profile']['country'] . 
											"</address>
										</dd>"; 
						?>
						
						<dt>Phone Number</dt>
						<?php if (isset($editCI) && $editCI=='true' && !isset($user_id_page)) echo "<dd> 
																			<input type='number' name='phone_no' value='" . $_SESSION['user_profile']['phone_no'] . "'>
																		   </dd>";
							  else echo "<dd>" . $_SESSION['user_profile']['phone_no'] . "</dd>"; 
						?>
						<dt>Email-id</dt>
						<?php if (isset($editCI) && $editCI=='true' && !isset($user_id_page)) echo "<dd> 
																			<input type='email' name='email_id' value='" . $_SESSION['user_profile']['email_id'] . "'>
																		   </dd>";
							  else echo "<dd> <a href='mailto:#'>" . $_SESSION['user_profile']['email_id'] . "</a> </dd>"; 
						?>
						<dt>Quote</dt>
						<?php if (isset($editCI) && $editCI=='true' && !isset($user_id_page)) echo " <dd>
																			<textarea type='text' name='quote' rows='6' cols='1200'>" . $_SESSION['user_profile']['quote'] . "</textarea>
																		   </dd>
																		   ";
							  else echo "
						<dd>" . $_SESSION['user_profile']['quote'] . "</dd>";
						?>
					</dl>
					<div style='clear:both'></div>
					<?php if (isset($editCI) && !isset($user_id_page)) echo "</form>"; ?>
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
  
    <script>
        $(document).ready(function() {
    		$('.datepicker').datepicker();
		  });
		  
		$('input[id=lefile]').change(function() {
		$('#photoCover').val($(this).val());
		});
      </script>
<?php
	$query = "SELECT * FROM `Profile` WHERE `user_id` = \"".$_SESSION['userId']."\"";
    if($query_out = mysql_query($query)){
      $_SESSION['user_profile'] = mysql_fetch_assoc($query_out);
    }
?>
  </body>
</html>


