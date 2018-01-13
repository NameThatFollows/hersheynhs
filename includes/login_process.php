<?php
session_start();

$database = include($_SERVER["DOCUMENT_ROOT"].'/config.php');
$connection = new mysqli($database['host'], $database['user'], $database['pass'], $database['name']);

if (isset($_POST['submit'])) {
	$error='';
	if (empty($_POST['username']) || empty($_POST['stuid'])) {
		$error = "One or more fields were empty.";
	} else {
		$username = $_POST['username'];
		$stuid = $_POST['stuid'];

		$username = mysqli_real_escape_string($connection, stripslashes($username));
		$stuid = mysqli_real_escape_string($connection, stripslashes($stuid));

		$sql = "SELECT id FROM members WHERE stuid = '$stuid' AND username = '$username' AND id = '1'";
		if ($rows->num_rows == 1) {
			$_SESSION['login_user'] = $username;
			header("Location: admin.php");
			exit;
		} else {
			$sql = "SELECT id FROM members WHERE stuid = '$stuid' AND username = '$username'";
			$rows = $connection->query($sql);
			if ($rows->num_rows == 1) {
				$_SESSION['login_user'] = $username;
				header("location: dashboard.php");
				exit;
			} else {
				$error = "Your Username or Password is invalid. Please contact an officer/advisor to get help.";
			}
		}
		mysqli_close($connection);
	}
}
?>
