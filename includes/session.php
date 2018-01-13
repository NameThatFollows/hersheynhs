<?php

$database = include($_SERVER["DOCUMENT_ROOT"].'/config.php');

$connection = new mysqli($database['host'], $database['user'], $database['pass'], $database['name']);

session_start();

$user_check = $_SESSION['login_user'];

$sql = "SELECT username FROM members WHERE username = '$user_check'";
$result = $connection->query($sql);

$row = $result->fetch_assoc();
$login_session = $row['username'];
if (empty($login_session) || !isset($login_session)){
	mysqli_close($connection);
	header('Location: login.php?nosession=1');
}

?>
