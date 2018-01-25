<?php
$title=$_POST["title"];
$text=$_POST["text"];

if (empty($title) or empty($text)) {
	exit('Empty fields');
}

$title = trim(htmlspecialchars($title));
$text = trim(htmlspecialchars($text));

$connect=mysqli_connect("localhost", "root", "");
mysqli_select_db($connect,"blog");

$insert="INSERT INTO posts (title, text) VALUES('$title', '$text')";
$ok = mysqli_query($connect, $insert);
if ($ok == False) {
	echo mysqli_error($connect);
}

mysqli_close($connect);
header("Location: index.php");
?>