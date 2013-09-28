<!DOCTYPE html>
<html>
  <head>
    <title>Bootstrap 101 Template</title>
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

	</style>
	<script src="js/jquery.js" type="text/javascript"></script>
   	<script src="js/bootstrap.min.js" type="text/javascript"></script>
   	<script src="js/jquery.slimscroll.js" type="text/javascript"></script>
   	

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
						<a class="brand offset1" href="#">Mini-Facebook</a>
					<ul class="nav">
					  <li>
					       <form class="navbar-search pull-left">
						    	<input type="text" class="search-query" placeholder="Search">
						    </form>
					  </li>
					  <li><a href="#" style="color:white;">Home</a></li>
					  <li class="active"><a href="profile.html">Profile</a></li>
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
					  
					  <li><a href="#" style="color:white;">Messages</a></li>
					  <li><a href="#" style="color:white;">Settings</a></li>
					</ul>
					</div>
					</div>
				</div>
			</div>
			
			<div class="row-fluid" id="panelGuest" >
				<div class="span4 scrollable" style="height:600px;" id="messageUsers">
					<ul style="list-style-type:none;">
						<li><blockquote><p>Rahul Singhal</p><small>Last received message goes here...</small></blockquote></li>
						<hr/>
						<li><blockquote><p>Mayank Deghal</p><small>Last received message goes here...</small></blockquote></li>
						<hr/>
						<li><blockquote><p>Nishit bhandari bhandari</p><small>Last received message goes here...</small></blockquote></li>
						<hr/>
						<li><blockquote><p>Aditya Raj</p><small>Last received message goes here...</small></blockquote></li>
						<hr/>
						<li><blockquote><p>Rahul Singhal</p><small>Last received message goes here...</small></blockquote></li>
						<hr/>
						<li><blockquote><p>Rahul Singhal</p><small>Last received message goes here...</small></blockquote></li>
						<hr/>
						<li><blockquote><p>Rahul Singhal</p><small>Last received message goes here...</small></blockquote></li>
						<hr/>
					</ul>
				</div>		
				<div class="span7" style="">
					<h4 class="text-info text-center">Selected user name</h4>
					<div style="height:400px; border-left:2px solid rgb(238,238,238); border-right:2px solid rgb(238,238,238);" class="scrollable"  id = "messageArea">

						<ul style="list-style-type:none; width:90%;" class="populate-messages">
							<li><div class="sendersMessage">sender's message goes here...</div></li>
							<li><div class="receiversMessage">Receiver's message goes here...<br/> yo man ssup?</div></li>
							<li><div class="sendersMessage">sender's message goes here...</div></li>
							<li><div class="receiversMessage">Hey man!! <br/> I am good and sound!! you say how is your database project going? I heard you guys are building a prototype of facebook.. nice project huh!!...</div></li>
							<li><div class="sendersMessage">sender's message goes here...</div></li>
							<li><div class="receiversMessage">Receiver's message goes here...<br/> yo man ssup?</div></li>
							<li><div class="sendersMessage">sender's message goes here...</div></li>
							<li><div class="receiversMessage">Hey man!! <br/> I am good and sound!! you say how is your database project going? I heard you guys are building a prototype of facebook.. nice project huh!!...</div></li>
							<li><div class="sendersMessage">sender's message goes here...</div></li>
							<li><div class="receiversMessage">Receiver's message goes here...<br/> yo man ssup?</div></li>
							<li><div class="sendersMessage">sender's message goes here...</div></li>
							<li><div class="receiversMessage">Hey man!! <br/> I am good and sound!! you say how is your database project going? I heard you guys are building a prototype of facebook.. nice project huh!!...</div></li>
							<li><div class="sendersMessage">sender's message goes here...</div></li>
							<li><div class="receiversMessage">Receiver's message goes here...<br/> yo man ssup?</div></li>
							<li><div class="sendersMessage">sender's message goes here...</div></li>
							<li><div class="receiversMessage">Hey man!! <br/> I am good and sound!! you say how is your database project going? I heard you guys are building a prototype of facebook.. nice project huh!!...</div></li>
							<li><div class="sendersMessage">test<br/>test<br/>test<br/>test<br/>test<br/>test<br/>test<br/>test<br/>test<br/>test<br/>test<br/>test<br/></div></li>
							
						</ul>

					</div>
					<div class="text-center">
						<textarea rows="4" style="width:90%; margin-top:20px;"></textarea>
					</div>
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
