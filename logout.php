<?php
session_start();
if(session_destroy()) {
	echo "Successfully logged out!<br />";
	echo "Redirecting...";
	header('Refresh: 0; url=http://hersheynhs.com');
}
?>

<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
</html>
