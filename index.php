<!DOCTYPE HTML>

<?php
  $error_flag = false;
  $error_value;
  if(isset($_GET['retry'])){
    $error_type = $_GET['retry'];
    $error_flag = true;
    if($error_type == 'a'){
      $error_value = "Wrong credentials!! Try Again!";
    }
    if($error_type == 'b'){
      $error_value = "Wrong inputs!! Passwords don't match. Try Again!";
    }
    if($error_type == 'c'){
      $error_value = "Wrong Email-ID. Try Again!";
    }
    if($error_type == 'd'){
      $error_value = "User-ID already exists!! Choose a different user-ID!";
    }
    if($error_type == 'e'){
      $error_value = "Connectivity problem!! Sorry, for the inconvenience. Try again!";
    }
  }
  else{
    $error_flag = false;
  }
?>

  <html>
  <head>
    <title>Mini-Facebook</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/datepicker.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/index.css" />
    <style type="text/css">
      #create-form{
        padding-left: 40%;
        text-align: middle;
      }
      #top{
        float:right;
      }
      .top-bar{
        background: rgb(0,136,204);
      }
      .input-xlarge{
        height:25px;
      }
    </style>
    <script src="js/jquery.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/bootstrap-datepicker.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/jquery.lightbox_me.js" type="text/javascript" charset="utf-8"></script>  
    <script type="text/javascript" charset="utf-8">
    $(function() {
          $('#top').click(function(e) {
            $("#sign_up").lightbox_me({centered: true, onLoad: function() {
              $("#sign_up").find("input:first").focus();
            }});
            e.preventDefault();
          });
    });
    </script>
  </head>
<body>
    <div class="" id="loginModal">
          <div class="modal-header top-bar">
            <button class="btn btn-primary" id="top">Login</button>
            <h3 style='color:white'>Mini-Facebook</h3>
            <div style="clear:both"> </div>
            <div id="sign_up">
              <h4>Please sign in using the form below</h4>
              <form action="loginCheck.php" id="sign_up_form" method="post">
                <label><strong>Username:</strong> <input type="text" name="username"/></label>
                <label><strong>Password:</strong> <input type="password" name="password"/></label>
                <input type="hidden" name="url">
                <button class="btn btn-primary" type="submit">Login</button>
              </form>
              <a id="close_x" class="close" href="#">Close</a>
            </div>
          </div>
          <div>
            <div class="alert alert-error span12 text-center" <?php if($error_flag) echo "style=\"display:block;\""; else echo "style=\"display:none;\""; ?>> <b><?php echo $error_value;?><b/></div>
            <div class="well" id="create-form">
                  <h3> Welcome to Mini-Facebook</h3>
                  <h4> Connect with your friends and the world around you. </h4>
                  <form action="createUser.php" method="post">
                    <label>User-ID</label>
                    <input type="text" value="" class="input-xlarge" name="new_userID">
                    <label>First Name</label>
                    <input type="text" value="" class="input-xlarge" name="new_userFirst">
                    <label>Last Name</label>
                    <input type="text" value="" class="input-xlarge" name="new_userLast">
                    <label>Email</label>
                    <input type="text" value="" class="input-xlarge" name="new_emailID">
                    <label>New Password</label>
                    <input type="password" value="" class="input-xlarge" name="new_pass1">
                    <label>Re-enter Password</label>
                    <input type="password" value="" class="input-xlarge" name="new_pass2">
                    <label>Birthday</label>
                    <input type="date" name="new_date">
                    <label>Gender</label>
					<input type="radio" name="new_gender" value="MALE" checked="checked"><span> Male</span><br>
					<input type="radio" name="new_gender" value="FEMALE"><span> Female</span>
                    <br>
                    <br>
                    <div>
                      <button class="btn btn-primary">Create Account</button>
                    </div>
                  </form>  
            </div>
          </div>
    </div>
    
    <script>
        $(document).ready(function() {
    		$('.datepicker').datepicker();
		  });
      </script>
</body>
