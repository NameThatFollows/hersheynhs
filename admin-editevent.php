<?php 
    ini_set('display_errors', '1');

    include('includes/session.php');

    if ($login_session != 'admin') {
        header('Location: 401.php');
        exit;
    }

    $eventNumber = $_POST['edit'];

    $connection = new mysqli($database['host'], $database['user'], $database['pass'], $database['name']);
    $result = $connection->query('SELECT id, eventname, startdate, enddate, link, sponsored, description FROM events WHERE id='.$eventNumber.' ORDER BY enddate, eventname');

    $eventData = $result->fetch_assoc();

    // header("location: /admin-editevents.php");
?>

<html>
    <head>
        <title>Edit Event | Hershey National Honor Society</title>
        <link rel="stylesheet" type="text/css" href="./css/form.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://fonts.googleapis.com/css?family=Lato:400,700,900" rel="stylesheet">
    </head>
    <body>
        <a href="/admin-editevents.php">< GO BACK</a>
        <?php 
            if (isset($_POST['edit'])) {
                echo '<h2>Editing Event #'.$eventNumber.'</h2>';
                echo '<form action="includes/processevent.php" method="post"><input id="id" name="id" type="hidden" placeholder="Event ID" value="'.$eventData['id'].'"/>';
                echo '<label>Event Name</label><input required id="eventname" name="eventname" type="text" placeholder="Event Name *" value="'.$eventData['eventname'].'"/></div>';
                echo '<label>Event Dates</label><p><strong>FOR multi-day events</strong>, fill start and end dates normally. <br /><strong>FOR one-day events</strong>, put the same date in start and end dates. <br /><strong>FOR events with no date</strong>, leave the dates blank.</p>';
                echo '<div class="half halfleft"><label>Start Date</label><input id="startdate" name="startdate" type="date" placeholder="YYYY-MM-DD" value="'.$eventData['startdate'].'"/></div>';
                echo '<div class="half halfright"><label>End Date</label><input id="enddate" name="enddate" type="date" placeholder="YYYY-MM-DD" value="'.$eventData['enddate'].'"/></div>';
                echo '<label>Signup Link</label><input id="link" name="link" type="text" placeholder="Signup Link" value="'.$eventData['link'].'"/>';
                echo '<label>Sponsored Event?</label> <input id="sponsored" name="sponsored" type="checkbox" placeholder="NHS Sponsored Event?"';
                if ($eventData['sponsored']) {
                    echo 'checked';
                }
                echo '/>';
                echo '<label>Event Description</label><textarea id="description" name="description" type="text" placeholder="Event Description">'.$eventData['description'].'</textarea>';
                echo '<button type="submit" name="edit">Edit Event</button>';
                echo '</form>';
            }
        ?>
    </body>
</html>