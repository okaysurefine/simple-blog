<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>darko</title>
	<link href="node_modules/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
	<link href="style.css" rel="stylesheet">
	<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
<body>
	<?php
		$post_id = $_GET["id"];

		$connect=mysqli_connect("localhost", "root", "");
		mysqli_select_db($connect,"blog");


		$result=mysqli_query($connect, "SELECT title, text FROM posts WHERE id=$post_id");
		$data=mysqli_fetch_assoc($result);
		mysqli_close($connect);
	?>
	<div class="container">
		<div class="txt">
			<p class="bg-info"><?php echo $data["title"]?></p>
			
			<p><?php echo $data["text"]?></p> 
		</div>	
	</div>
</body>
</html>