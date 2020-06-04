<?php
require 'ImgResize.php';

if(isset($_POST['submit'])){

	if($_FILES['image']['tmp_name']){

		$img = new ImgResize;

		$st = $img->make('image');

		if($st){

		 	echo $st;
		
		}else{
		
			echo "Error";
		}

	}

	
	 
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>img</title>
</head>
<body>

	<form action="" method="post" enctype="multipart/form-data">
		<input type="file" name="image">
		
		<input type="submit" value="submit" name="submit">
	</form>
</body>
</html>