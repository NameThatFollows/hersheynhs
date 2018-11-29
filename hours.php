<?php
    /**
    * Takes needed data from the mysql query and places it in an array to be accessed by the rest of the page.
    * 
    * @param result the result of the mysql query.
    * @return an array of the needed data for the rest of the page.
    * @throws Exception if there are no results or more than 1 results.
    */
    function databaseToArray($result) {
        if ($result->num_rows < 1) {
            throw new Exception("User not found");
        } else if ($result->num_rows > 1) {
            throw new Exception("Duplicate username in database");
        } else {
            $userData = [];
            $row = $result->fetch_assoc();
            
            $userData['firstname'] = $row['name'];
            $userData['lastname'] = $row['lastname'];
            $userData['firstyear'] = $row['firstyear'];
            $userData['grade'] = $row['grade'];
            $userData['h1'] = $row['h1'];
            $userData['h2'] = $row['h2'];
            $userData['h3'] = $row['h3'];
            $userData['h4'] = $row['h4'];
            $userData['sponsored1'] = $row['sponsored1'];
            $userData['sponsored2'] = $row['sponsored2'];
            $userData['h4s'] = $row['h4s'];
            $userData['h5'] = $row['h5'];
            $userData['h6'] = $row['h6'];
            $userData['h7'] = $row['h7'];
            $userData['h8'] = $row['h8'];
            $userData['sponsored3'] = $row['sponsored3'];
            $userData['sponsored4'] = $row['sponsored4'];

            $userData['junioryearhours'] = $userData['h1'] + $userData['h2'] + $userData['h3'] + $userData['h4'] + $userData['h4s'];
            $userData['senioryearhours'] = $userData['h5'] + $userData['h6'] + $userData['h7'] + $userData['h8'];
            $userData['totalhours'] = $userData['h1'] + $userData['h2'] + $userData['h3'] + $userData['h4'] + $userData['h4s'] + $userData['h5'] + $userData['h6'] + $userData['h7'] + $userData['h8'];

            $userData['juniorsponsored'] = getNumberSponsoredEvents(1, $row);
            $userData['seniorsponsored'] = getNumberSponsoredEvents(2, $row);

            return $userData;
        }
    }

    function getNumberSponsoredEvents($year, $row) {
        $number = 0;

        if ($year === 1) {
            if (!empty($row['sponsored1'])) {
                $number++;
            }

            if (!empty($row['sponsored2'])) {
                $number++;
            }
        } else {
            if (!empty($row['sponsored3'])) {
                $number++;
            }

            if (!empty($row['sponsored4'])) {
                $number++;
            }
        }

        return $number;
    }

    function getSettings($result) {
        if ($result->num_rows < 1) {
            throw new Exception("User not found");
        } else if ($result->num_rows > 1) {
            throw new Exception("Duplicate username in database");
        } else {
            $settings = [];
            $row = $result->fetch_assoc();

            $settings['requiredhours'] = $row['requiredHours'];
            $settings['requiredsponsoredevents'] = $row['requiredSponsoredEvents'];

            return $settings;
        }
    }

    include("includes/session.php");

    $database = include("config.php");

    $connection = new mysqli($database['host'], $database['user'], $database['pass'], $database['name']);

    $getData = "SELECT * FROM members WHERE username = '$login_session'";
    $result = $connection->query($getData);

    $getSettingsData = "SELECT * FROM settings";
    $settingsResult = $connection->query($getSettingsData);

    $userData = [];
    $settings = [];
    try {
        $userData = databaseToArray($result);
        $settings = getSettings($settingsResult);
    } catch (Exception $e) {
        // Handle Exception
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Service Hours | Hershey National Honor Society</title>

        <link rel="stylesheet" type="text/css" href="./css/info.css">
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900" rel="stylesheet">

		<meta name="viewport" content="width=device-width, initial-scale=1">
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
					<li><a href="/dashboard.php">Dashboard</a></li><li class="active"><a href="/hours.php">Hours</a></li><li><a href="/events.php">Events</a></li><li><a href="/forms.php">Forms/Docs</a></li><li><a href="/faq.php">FAQ</a></li>
				</ul>
			</nav>
		</header>

		<section id="banner">
			<div id="banner-image" style="background-image: url(/images/hours.jpg);">
				<div id="banner-text">
					<h1>Service Hours</h1>
					<p>Your accumulated service hours</p>
				</div>
			</div>
        </section>
        
        <section id="main-content">
            <div class="center">
                <div>
                    <div class="bigger-number"><?php echo $userData['totalhours']; ?></div>
                    <p>service hours completed</p>
                    <div class="bigger-number"><?php echo $userData['juniorsponsored'] + $userData['seniorsponsored']; ?></div>
                    <p>sponsored events completed</p>
                </div>

                <?php
                    if ($userData['firstyear'] == 11) {
                        echo '<h4>Junior Year Requirements</h4>
                            <div class="flex">
                            <div class="flex-child">
                                <div class="big-number">';
                        
                        if ($userData['totalhours'] >= $settings['requiredhours']) {
                            echo '0';
                        } else {
                            echo $settings['requiredhours'] - $userData['totalhours'];
                        }
                        
                        echo '</div><p>more service hours</p></div>';

                        echo 
                            '<div class="flex-child">
                                <div class="big-number">';
                        
                        if ($userData['juniorsponsored'] >= $settings['requiredsponsoredevents']) {
                            echo '0';
                        } else {
                            echo $settings['requiredsponsoredevents'] - $userData['juniorsponsored'];
                        }
                        
                        echo '</div><p>more sponsored events</p></div></div>';
                    }
                ?>
                <h4>Senior Year Requirements</h4>
                <div class="flex">
                    <div class="flex-child">
                        <div class="big-number">
                        <?php
                            $hoursleft = 0;
                            if ($userData['junioryearhours'] > $settings['requiredhours']) {
                                $hoursleft = $settings['requiredhours'] * 2 - $userData['totalhours'];
                            } else {
                                if ($userData['firstyear'] == 11) {
                                    $hoursleft = $settings['requiredhours'];
                                } else {
                                    $hoursleft = $settings['requiredhours'] - $userData['senioryearhours'];
                                }
                            }

                            if ($hoursleft < 0) {
                                echo '0';
                            } else {
                                echo $hoursleft;
                            }
                        ?></div>
                        <p>more service hours</p>
                    </div>
                    <div class="flex-child">
                        <div class="big-number">
                        <?php
                            $sponsoredleft = $settings['requiredsponsoredevents'] - $userData['seniorsponsored'];

                            if ($sponsoredleft < 0) {
                                echo '0';
                            } else {
                                echo $sponsoredleft;
                            }
                        ?></div>
                        <p>more sponsored events</p>
                    </div>
                </div>

                <h4>Service Hours & Sponsored Events by Term</h4>
                <p><--- Scrolls left and right ---></p>
                <div class="table-container">
                    <table>
                        <?php
                            if ($userData['firstyear'] == 11) {
                                echo '<tr>
                                        <th colspan="6">Junior Year</th>
                                        <th>Summer</th>
                                        <th colspan="7">Senior Year</th>
                                    </tr>
                                    <tr>
                                        <th>MP1</th>
                                        <th>MP2</th>
                                        <th>MP3</th>
                                        <th>MP4</th>';
                                        
                                        for ($i = 1; $i <= $settings['requiredsponsoredevents']; $i++) {
                                            echo '<th>Event '.$i.'</th>';
                                        }
                                echo '<th>Summer</th>
                                        <th>MP1</th>
                                        <th>MP2</th>
                                        <th>MP3</th>
                                        <th>MP4</th>';
                                        for ($i = 1; $i <= $settings['requiredsponsoredevents']; $i++) {
                                            echo '<th>Event '.$i.'</th>';
                                        }
                                echo '</tr>';
                                echo "<tr><td>".$userData["h1"]."</td><td>".$userData["h2"]."</td><td>".$userData["h3"]."</td><td>".$userData["h4"]."</td><td>".$userData["sponsored1"]."</td><td>".$userData["sponsored2"]."</td><td>".$userData["h4s"]."</td><td>".$userData["h5"]."</td><td>".$userData["h6"]."</td><td>".$userData["h7"]."</td><td>".$userData["h8"]."</td><td>".$userData["sponsored3"]."</td><td>".$userData["sponsored4"]."</td>";
                            } else {
                                echo '<tr>
                                        <th colspan="7">Senior Year</th>
                                    </tr>
                                    <th>Summer</th>
                                        <th>MP1</th>
                                        <th>MP2</th>
                                        <th>MP3</th>
                                        <th>MP4</th>';
                                        for ($i = 1; $i <= $settings['requiredsponsoredevents']; $i++) {
                                            echo '<th>Event '.$i.'</th>';
                                        }
                                echo '</tr>';
                                echo "<tr><td>".$row["h5"]."</td><td>".$row["h6"]."</td><td>".$row["h7"]."</td><td>".$row["h8"]."</td><td>".$row["sponsored3"]."</td><td>".$row["sponsored4"]."</td>";
                            }
                        ?>
                    </table>
                </div>
                <br /><br /><br /><p>If you have any issues with these service hours, please contact any NHS officer or advisor. </p>
            </div>
        </section>

        <?php include 'footer.php'; ?>

    </body>
</html>