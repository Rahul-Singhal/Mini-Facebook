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
						  <li><a href="#">Link1</a></li>
						  <li><a href="#">Link2</a></li>
						  <li><a href="#">Link3</a></li>
						  <li><a href="#">Link4</a></li>
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
						  <li><a href="#">FR1</a></li>
						  <li><a href="#">FR2</a></li>
						  <li><a href="#">FR3</a></li>
						  <li><a href="#">FR4</a></li>
						</ul>
					  </li>
					  
					  <li><a href="messages.html" style="color:white;">Messages</a></li>
					  <li><a href="#" style="color:white;">Settings</a></li>
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
						<li class="active"><a href="#">New Feed</a></li>
						<li><a href="#">Messages</a></li>
						
						<li class="nav-header">Events</li>
						<li><a href="#">Upcoming</a></li>
						<li><a href="#">Recent</a></li>
						
						<li class="nav-header">Friends</li>
						<li><a href="#">List</a></li>
						<li><a href="#">Requests</a></li>
						<li><a href="#">Suggestions</a></li>
						
					</ul>
				</div>		
				<div class="span8 ">
					<h3>Mayank Dehgal</h3>
					<dl class="dl-horizontal">
						<h4>Basic Information	</h4>
						<dt>Age</dt>
						<dd>20</dd>
						<dt>Date of Birth</dt>
						<dd>5th March, 1994</dd>
						<dt>Relationship Status</dt>
						<dd>Occupied</dd>
						<dt>Gender</dt>
						<dd>Male</dd>
					</dl>
					
					<dl class="dl-horizontal">
						<h4>Education</h4>
						<dt>Graduation</dt>
						<dd>IIT Bombay <small> - 2015 </small> </dd>
						<dt>High School</dt>
						<dd>Maa Bharti <small> - 2011 </small> </dd>
						<dt>Primary School</dt>
						<dd>S.V.P.V <small> - 2009 </small> </dd>
					</dl>
					
					<dl class="dl-horizontal">
						<h4>Contact Information</h4>
						<dt>Address</dt>
						<dd>
							<address>
								C/403, <br>
								Chandan Avenue, <br>
								Mira Road, <br>
								Maharashtra
							</address>
						</dd>
						<dt>Phone Number</dt>
						<dd>8652549510</dd>
						<dt>Email-id</dt>
						<dd> <a href="mailto:#">mayankdehgal94@gmail.com</a> </dd>
						<dt>Quote</dt>
						<dd>
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur molestie pharetra lacus, a tincidunt elit fermentum ac. Praesent ac mauris nisl. Cras aliquet imperdiet nunc, vestibulum faucibus urna laoreet eu. Aliquam pharetra leo ut mauris tempus dignissim. Aenean mollis dui sed orci hendrerit vitae hendrerit nisi convallis. Ut id libero a metus ullamcorper consectetur. Suspendisse sed risus erat. In pharetra velit condimentum nisl interdum sed iaculis mi consectetur. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas vulputate consectetur urna, a dignissim odio vestibulum a.
Aliquam pharetra, nunc a tempor sodales, orci sem pretium orci, quis pretium tellus purus ac nunc. Morbi dignissim urna eget sapien laoreet volutpat. Sed lacus lorem, vulputate eu aliquet non, egestas vel augue. Fusce gravida arcu at elit pharetra luctus. Curabitur pretium mi vitae purus posuere lobortis. Fusce pulvinar, mi at eleifend venenatis, magna risus rhoncus ipsum, dapibus ornare nisi risus ac lorem. Etiam feugiat felis eu nulla pretium pellentesque. Curabitur id lorem ut orci blandit commodo. Vestibulum tempor ultricies nibh, eu malesuada nibh commodo non. Morbi malesuada porta fringilla. Mauris suscipit vestibulum ante ut laoreet. Duis eget mollis tortor. In imperdiet tempus mauris eu hendrerit. Vivamus ultrices rutrum magna sit amet dapibus. Phasellus sem justo, pulvinar vitae adipiscing ut, dictum in tellus.
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur molestie pharetra lacus, a tincidunt elit fermentum ac. Praesent ac mauris nisl. Cras aliquet imperdiet nunc, vestibulum faucibus urna laoreet eu. Aliquam pharetra leo ut mauris tempus dignissim. Aenean mollis dui sed orci hendrerit vitae hendrerit nisi convallis. Ut id libero a metus ullamcorper consectetur. Suspendisse sed risus erat. In pharetra velit condimentum nisl interdum sed iaculis mi consectetur. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas vulputate consectetur urna, a dignissim odio vestibulum a.
Aliquam pharetra, nunc a tempor sodales, orci sem pretium orci, quis pretium tellus purus ac nunc. Morbi dignissim urna eget sapien laoreet volutpat. Sed lacus lorem, vulputate eu aliquet non, egestas vel augue. Fusce gravida arcu at elit pharetra luctus. Curabitur pretium mi vitae purus posuere lobortis. Fusce pulvinar, mi at eleifend venenatis, magna risus rhoncus ipsum, dapibus ornare nisi risus ac lorem. Etiam feugiat felis eu nulla pretium pellentesque. Curabitur id lorem ut orci blandit commodo. Vestibulum tempor ultricies nibh, eu malesuada nibh commodo non. Morbi malesuada porta fringilla. Mauris suscipit vestibulum ante ut laoreet. Duis eget mollis tortor. In imperdiet tempus mauris eu hendrerit
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
  </body>
</html>
