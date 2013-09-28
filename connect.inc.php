<?php
  $host = 'localhost';
  $user = 'root';
  $pass = '';
  if(mysql_connect($host, $user, $pass) && mysql_select_db("Mini-Facebook")){
  	echo "connected!!";
  }else{
  	echo "not connected!!";
  	
  }
?>
