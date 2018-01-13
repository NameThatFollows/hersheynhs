<?php 
    ini_set('display_errors', '1');

    $database = include($_SERVER["DOCUMENT_ROOT"].'/config.php');

    $connection = new mysqli($database['host'], $database['user'], $database['pass'], $database['name']);
    
    if (isset($_POST['add'])) {
        $eventname = mysqli_real_escape_string($connection, $_POST['eventname']);
        $startdate = mysqli_real_escape_string($connection, $_POST['startdate']);
        $enddate = mysqli_real_escape_string($connection, $_POST['enddate']);
        $signuplink = mysqli_real_escape_string($connection, $_POST['link']);
        $sponsored = isset($_POST['sponsored']);
        $description = mysqli_real_escape_string($connection, $_POST['description']);

        $sql = "INSERT INTO events (eventname, startdate, enddate, link, sponsored, description) VALUES ('$eventname', '$startdate', '$enddate', '$signuplink', '$sponsored', '$description')";

        $actionType = "Event Successfully Added!";
    } elseif (isset($_POST['edit'])) {
        $eventname = mysqli_real_escape_string($connection, $_POST['eventname']);
        $startdate = mysqli_real_escape_string($connection, $_POST['startdate']);
        $enddate = mysqli_real_escape_string($connection, $_POST['enddate']);
        $signuplink = mysqli_real_escape_string($connection, $_POST['link']);
        $sponsored = isset($_POST['sponsored']);
        $description = mysqli_real_escape_string($connection, $_POST['description']);
        $eventNumber = mysqli_real_escape_string($connection, $_POST['id']);

        $sql = "UPDATE events SET eventname = '$eventname', startdate = '$startdate', enddate = '$enddate', link = '$signuplink', sponsored = '$sponsored', description = '$description' WHERE id = '$eventNumber'";

        $actionType = "Event Successfully Modified!";
    } elseif (isset($_POST['remove'])) {
        $eventNumber = mysqli_real_escape_string($connection, $_POST['remove']);
        $sql = "DELETE FROM events WHERE id='$eventNumber'";
        $actionType = "Event Successfully Removed!";
    }

    if (mysqli_query($connection, $sql)) {
        echo $actionType;
    } else {
        echo "Something went wrong" . mysqli_error($connection);
    }

    mysqli_close($connection);

    header('Refresh: 1; url=/admin-editevents.php');
?>