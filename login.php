<?php
session_start();

$operation=$_POST["operation"];
if ($operation=="login") {

	$connect=mysqli_connect("localhost", "root", "");
	mysqli_select_db($connect,"blog");

	$result=mysqli_query($connect, "SELECT id, login, password FROM user");
	if (mysqli_errno($connect)>0) {
	 	exit(mysqli_error($connect));
	}

	$login=$_POST["login"];
	$password=$_POST["password"];

	if (empty($login) or empty($password)) {
		exit("Empty fields");
	}

	$login=trim(htmlspecialchars($login));
	$password=trim(htmlspecialchars($password));

	if ($result==False or mysqli_num_rows($result)==0) {
		exit("No users");
	}

	$check=mysqli_fetch_assoc($result);

	if ($check["login"]==$login and $check["password"]==$password) {
		$_SESSION["admin"]=TRUE;
	}
	else {
		header("Location: index.php?auth=bad");
		exit();
	}
	mysqli_close($connect);
} else if ($operation=="exit") {
	unset($_SESSION["admin"]);
}

header("Location: index.php");
?>