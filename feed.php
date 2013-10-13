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
				<div class="span7 offset1">
					<div class="post">
						<div class="media">
							<a class="pull-left" href="#">
								<img class="media-object" src="img/rahul.jpeg" width="64px" height="64px">
							</a>
							<div class="media-body">
								<h4 class="media-heading">Rahul Singhal</h4>	
								Hey there!! this is the very first text post. lets see if the newline characters work. Let me put some more random text so as to check if the text remains aligned. Wow this design looks awesome.<br/>
								Machaxx! :D
								<div class="like-dislike">
									<button type="button" class="btn btn-success btn-mini">
										<i class="icon-large icon-thumbs-up"></i> Like									
									</button>
									<button type="button" class="btn btn-danger btn-mini pull-right">
										<i class="icon-large icon-thumbs-down"></i> Dislike									
									</button>
								</div>
								<div style="background-color:#3D4A6C; padding:5px 10px 5px 10px; border-radius:10px;">
									<div>
										<span class="label label-info">65 Likes</span>
										<span class="pull-right">
											<span class="label label-success">12 October, 2013</span>
											<span class="label label-success">8:45 AM</span>
										</span>
									</div>
									<ul class="comments">
										<li>
											<span class="label label-default">Mayank</span> Test Comment Test Comment Test Comment Test Comment Test Comment Test Comment Test Comment Test Comment Test Comment Test Comment Test Comment Test Comment Test Comment Test Comment
											<br/>
											<span class="comment-timestamp">12 October, 2013 at 9:10 AM</span>
										</li>
										<li>
											<span class="label label-default">Rahul</span> Test Comment
											<br/>
											<span class="comment-timestamp">12 October, 2013 at 9:10 AM</span>
										</li>
										<li>
											<span class="label label-default">Mayank</span> Test Comment
											<br/>
											<span class="comment-timestamp">12 October, 2013 at 9:10 AM</span>
										</li>
										<li>
											<span class="label label-default">Rahul</span> Test Comment
											<br/>
											<span class="comment-timestamp">12 October, 2013 at 9:10 AM</span>
										</li>
										<li>
											<span class="label label-default">Mayank</span> Test Comment
											<br/>
											<span class="comment-timestamp">12 October, 2013 at 9:10 AM</span>
										</li>
										<li>
											<span class="label label-default">Rahul</span>
											<input type="text" placeholder="Comment here!" class="span10" style="margin:5px 10px 5px 15px;">
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<hr/>
					<div class="post">
						<div class="media">
							<a class="pull-left" href="#">
								<img class="media-object" src="img/rahul.jpeg" width="64px" height="64px">
							</a>
							<div class="media-body">
								<h4 class="media-heading">Rahul Singhal</h4>	
								Hey there!! this is the very first text post. lets see if the newline characters work. Let me put some more random text so as to check if the text remains aligned.
								<div class="like-dislike">
									<button type="button" class="btn btn-success btn-mini">
										<i class="icon-large icon-thumbs-up"></i> Like									
									</button>
									<button type="button" class="btn btn-danger btn-mini pull-right">
										<i class="icon-large icon-thumbs-down"></i> Dislike									
									</button>
								</div>
								<div style="background-color:#3D4A6C; padding:5px 10px 5px 10px; border-radius:10px;">
									<div>
										<span class="label label-info">65 Likes</span>
										<span class="pull-right">
											<span class="label label-success">12 October, 2013</span>
											<span class="label label-success">8:45 AM</span>
										</span>
									</div>
									<ul class="comments">
										<li>
											<span class="label label-default">Mayank</span> Test Comment Test Comment Test Comment Test Comment Test Comment Test Comment Test Comment Test Comment Test Comment Test Comment Test Comment Test Comment Test Comment Test Comment
											<br/>
											<span class="comment-timestamp">12 October, 2013 at 9:10 AM</span>
										</li>
										<li>
											<span class="label label-default">Rahul</span> Test Comment
											<br/>
											<span class="comment-timestamp">12 October, 2013 at 9:10 AM</span>
										</li>
										<li>
											<span class="label label-default">Mayank</span> Test Comment
											<br/>
											<span class="comment-timestamp">12 October, 2013 at 9:10 AM</span>
										</li>
										<li>
											<span class="label label-default">Rahul</span> Test Comment
											<br/>
											<span class="comment-timestamp">12 October, 2013 at 9:10 AM</span>
										</li>
										<li>
											<span class="label label-default">Mayank</span> Test Comment
											<br/>
											<span class="comment-timestamp">12 October, 2013 at 9:10 AM</span>
										</li>
										<li>
											<span class="label label-default">Rahul</span>
											<input type="text" placeholder="Comment here!" class="span10" style="margin:5px 10px 5px 15px;">
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<hr/>
					<div class="post">
							<div class="media">
						<a class="pull-left" href="#">
							<img class="media-object" src="img/rahul.jpeg" width="64px" height="64px">
						</a>
						<div class="media-body">
							<h4 class="media-heading">Rahul Singhal</h4>	
							Hey there!! this is the very first text post. lets see if the newline characters work. Let me put some more random text so as to check if the text remains aligned.
							<div class="like-dislike">
								<button type="button" class="btn btn-success btn-mini">
									<i class="icon-large icon-thumbs-up"></i> Like									
								</button>
								<button type="button" class="btn btn-danger btn-mini pull-right">
									<i class="icon-large icon-thumbs-down"></i> Dislike									
								</button>
							</div>
							<div style="background-color:#3D4A6C; padding:5px 10px 5px 10px; border-radius:10px;">
								<div>
									<span class="label label-info">65 Likes</span>
									<span class="pull-right">
										<span class="label label-success">12 October, 2013</span>
										<span class="label label-success">8:45 AM</span>
									</span>
								</div>
								<ul class="comments">
									<li>
										<span class="label label-default">Mayank</span> Test Comment Test Comment Test Comment Test Comment Test Comment Test Comment Test Comment Test Comment Test Comment Test Comment Test Comment Test Comment Test Comment Test Comment
										<br/>
										<span class="comment-timestamp">12 October, 2013 at 9:10 AM</span>
									</li>
									<li>
										<span class="label label-default">Rahul</span> Test Comment
										<br/>
										<span class="comment-timestamp">12 October, 2013 at 9:10 AM</span>
									</li>
									<li>
										<span class="label label-default">Mayank</span> Test Comment
										<br/>
										<span class="comment-timestamp">12 October, 2013 at 9:10 AM</span>
									</li>
									<li>
										<span class="label label-default">Rahul</span> Test Comment
										<br/>
										<span class="comment-timestamp">12 October, 2013 at 9:10 AM</span>
									</li>
									<li>
										<span class="label label-default">Aditya</span> Test Comment
										<br/>
										<span class="comment-timestamp">12 October, 2013 at 9:10 AM</span>
									</li>
									<li>
											<span class="label label-default">Rahul</span>
											<input type="text" placeholder="Comment here!" class="span10" style="margin:5px 10px 5px 15px;">
									</li>
								</ul>
							</div>
						</div>
					</div>
					</div>
					<hr/>


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
