<?php
if ($_FILES["photoFile"]["error"] > 0)
  {
  echo "Error: " . $_FILES["photoFile"]["error"] . "<br>";
  }
else
  {
  echo "Upload: " . $_FILES["photoFile"]["name"] . "<br>";
  echo "Type: " . $_FILES["photoFile"]["type"] . "<br>";
  echo "Size: " . ($_FILES["photoFile"]["size"] / 1024) . " kB<br>";
  echo "Stored in: " . $_FILES["photoFile"]["tmp_name"];
  
	$previewImage='true';
	$image = $_FILES['photoFile']['name']; 
	$tmp = $_FILES['photoFile']['tmp_name']; 
	$location = 'upload/';
	if (!is_dir($location)) {
		echo "The directory was successfully created.";
		mkdir($location);       
	}
	move_uploaded_file($tmp, $location.$image);
	
	echo "<br>";
	echo "Location: profile.php?previewPhoto=true&fileName=" . $image;
	
	header("Location: profile.php?previewPhoto=true&fileName=".$image);
  }
?>