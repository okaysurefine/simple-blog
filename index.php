<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>blog</title>
	<link href="node_modules/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
	<link href="style.css" rel="stylesheet">
	
	<script src="node_modules/jquery/dist/jquery.min.js"></script>
	<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="node_modules/shufflejs/dist/shuffle.min.js"></script>
</head>
<body>
<?php
	$connect=mysqli_connect("localhost", "root", "");
	mysqli_select_db($connect,"blog");

	$posts = array();

	$result=mysqli_query($connect, "SELECT id, title, text FROM posts");
	while ($row=mysqli_fetch_assoc($result)) {
		$posts[] = $row;
	}

	mysqli_close($connect);
?>
	<div class="container">
		
			<div class="col-md-4"></div>
			<div class="title col-md-4">
				<h1>MY BLOG</h1>
			</div>
	
		<?php
			if (isset($_SESSION["admin"]) and $_SESSION["admin"] == True) {
		?>
		
		<div class="row">
			<div class="col-md-11"></div>
			<div class="col-md-1">
				<a href="add.html">
					<button type="button" class="btn btn-default btn-md">
						<span class="glyphicon glyphicon-plus"></span>
					</button>
				</a>

				<form method="post" action="login.php">
					<div class="row">
						<button type="submit"  class="btn btn-default">Выйти</button>
						<input type="hidden" name="operation" value="exit">
					</div>
				</form>
			</div>
		</div>
			

		<?php
			} else {
		?>


		<?php
			if (isset($_GET["auth"]) and  $_GET["auth"]=="bad") {
		?>
				<div class="row">
				<div class="alert alert-warning col-md-4">Неправильный логин или пароль</div>
				</div>
		<?php 
			}
		?>
		
		<div class="row">
			<form method="post" action="login.php">
				<div class="col-md-8"></div>
				<div class="login col-md-4">
					<input type="hidden" name="operation" value="login">
					<div class="form-group">
						<label for="login">Логин</label>
						<input name="login" placeholder="Введите логин" class="form-control">
					</div>
					<div class="form-group">
						<label for="password">Пароль</label>
						<input name="password" placeholder="Введите пароль" class="form-control">
					</div>
					<button type="submit" class="btn btn-default">Отправить</button>
				</div>
			</form>
		</div>
		<?php
			}
		?>
	
		<?php
			foreach ($posts as $key => $value) {
		?>
			<div class="row post">
				<h3><a href="post.php?id=<?php echo $value["id"] ?>"><?php echo $value["title"] ?></a></h3>
			</div>
		<?php
			}
		?>	
</body>
</html>