<?php 
    ini_set('display_errors', '1');

    include('includes/session.php');

    if ($login_session != 'admin') {
        header('Location: 401.php');
        exit;
    }

    $connection = new mysqli($database['host'], $database['user'], $database['pass'], $database['name']);
?>

<html>
    <head>
        <title>Add Event | Hershey National Honor Society</title>
        <link rel="stylesheet" type="text/css" href="./css/form.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://fonts.googleapis.com/css?family=Lato:400,700,900" rel="stylesheet">
    </head>
    <body>
        <a href="/admin-editevents.php">< GO BACK</a>
        <?php 
            if (isset($_POST['add'])) {
                echo '<h2>New Event</h2>';
                echo '<form action="includes/processevent.php" method="post">';
                echo '<label>Event Name</label><input required id="eventname" autofocus="autofocus" name="eventname" type="text" /></div>';
                echo '<label>Event Dates</label><p><strong>FOR multi-day events</strong>, fill start and end dates normally. <br /><strong>FOR one-day events</strong>, put the same date in start and end dates. <br /><strong>FOR events with no date</strong>, leave the dates blank.</p>';
                echo '<div class="half halfleft"><label>Start Date</label><input id="startdate" placeholder="YYYY-MM-DD" name="startdate" type="date" /></div>';
                echo '<div class="half halfright"><label>End Date</label><input id="enddate" placeholder="YYYY-MM-DD" name="enddate" type="date" /></div>';
                echo '<label>Signup Link</label><input id="link" name="link" type="text" />';
                echo '<label>Sponsored Event?</label> <input id="sponsored" name="sponsored" type="checkbox" />';
                echo '<label>Event Description</label><textarea id="description" name="description" type="text" ></textarea>';
                echo '<button type="submit" name="add" value="0">Add Event</button>';
                echo '</form>';
            }
        ?>
    </body>
</html>