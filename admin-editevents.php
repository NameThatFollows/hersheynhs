<?php
	ini_set('display_errors',1);
	include('includes/session.php');

	if ($login_session != 'admin') {
		header('Location: 401.php');
		exit;
	}

	date_default_timezone_set('America/New_York');

	$connection = new mysqli($database['host'], $database['user'], $database['pass'], $database['name']);
?>

<html>
	<head>
		<title>Edit Events | Hershey National Honor Society</title>
		<link rel="stylesheet" type="text/css" href="./css/info.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://fonts.googleapis.com/css?family=Lato:400,700,900" rel="stylesheet">
	</head>
	<body>
		<header class="top">
			<div class="row">
				<div id="logo">
					<a href="/">HERSHEY NHS</a>
				</div>
				<div id="login">
					<a href="/logout.php" id="nav-button">LOG OUT</a>
				</div>
			</div>

			<nav class="top-nav">
				<ul>
					<li><a href="/admin.php">Dashboard</a></li><li><a href="/admin-editmembers.php">Edit Members</a></li><li class="active"><a href="/admin-editevents.php">Edit Events</a></li><li><a href="/admin-editpages.php">Edit Content</a></li><li><a href="/admin-help.php">Help</a></li>
				</ul>
			</nav>
		</header>

		<section id="banner">
			<div id="banner-image" style="background-image: url(/images/bg.jpg);">
				<div id="banner-text">
					<h1>Edit Events</h1>
					<p>Please select a page below to start editing!</p>
				</div>
			</div>
		</section>
		
		
		<section id="main-content">			
			<h1>Instructions:</h1>
			<ul>
				<li>If you would like to add an event, click on the "Add New Event" button below.</li>
				<li>If you would like to change an event, press the edit event button below the event you want to change. </li>
				<li>If you would like to remove an event, press the remove event button below the event you want to remove. </li>
				<li>What you see below is what the students will see in their dashboards.</li>
			</ul>

			<div class="center">
				<form action="/admin-addevent.php" method="post">
					<button type="submit" id="add" name="add" value="add">+ Add New Event</button>
				</form>
				
				<h1 style="text-align:center;">Current Events</h1>

				<hr />
				<table>
				<?php
					$result = $connection->query("SELECT id,eventname, startdate, enddate, link, sponsored, description FROM events ORDER BY enddate, eventname");

					if ($result->num_rows > 0) {
						$format = "F j, Y";
						while ($row = $result->fetch_assoc()) {
							echo '<tr><h3>'.$row["eventname"].'</h4>';

							// Setup Date
							$date = '';
							if ($row['startdate'] != 0 && $row['enddate'] != 0) {
								if ($row['startdate'] == $row['enddate']) {
									$date = ''.date($format, strtotime($row['enddate']));
								} else {
									$date = ''.date($format, strtotime($row['startdate'])).' - '.date($format, strtotime($row['enddate']));
								}
							} elseif ($row['startdate'] != 0) {
								$date = ''.date($format, strtotime($row['startdate']));
							} elseif ($row['enddate'] != 0) {
								$date = ''.date($format, strtotime($row['enddate']));
							}

							if (!empty($date) && $row['sponsored']) {
								echo '<h5 class="dense">'.$date.' | NHS Sponsored Event </h5>';
							} elseif (!empty($date)) {
								echo '<h5 class="dense">'.$date.'</h5>';
							} elseif ($row['sponsored']) {
								echo '<h5 class="dense">NHS Sponsored Event</h5>';
							}
							
							if ($row["description"] !== ""){
								echo '<p">'.nl2br($row["description"]).'</p>';
							} else {
								echo '<p">There is no description for this event.</p>';
							}
							
							if ($row["link"] !== "") {
								echo '<li class="signup-button"><a href="'.$row["link"].'"target="blank">Sign Up</a></li><br />';
							}

							echo '<form class="button-row" action="admin-editevent.php" method="post"><button type="submit" name="edit" value="'.$row['id'].'">~ Edit Event</button></form>';
							echo '<form class="button-row" action="/includes/processevent.php" method="post"><button type="submit" name="remove" value="'.$row['id'].'">- Remove Event</button></form>';

							echo '</tr><hr />';
						}
						
						echo '</table>';
					} else {
						echo '</table><h3">There are currently no events to sign up for. </h3>';
					}
					
					$connection->close();
				?>

				<br /><br /><p>Any questions regarding events should go to the advisors or officers.</p>
			</div>
		</section>

		<?php include 'footer.php'; ?>
	</body>
</html>