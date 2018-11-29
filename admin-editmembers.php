<?php
ini_set('display_errors',1);

include('includes/session.php');

if ($login_session != 'admin') {
	header('Location: 401.php');
	exit;
}

$database = include("config.php");

$connection = new mysqli($database['host'], $database['user'], $database['pass'], $database['name']);
?>

<html>
	<head>
		<title>Edit Members | Hershey National Honor Society</title>
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
					<li><a href="/admin.php">Dashboard</a></li><li class="active"><a href="/admin-editmembers.php">Edit Members</a></li><li><a href="/admin-editevents.php">Edit Events</a></li><li><a href="/admin-editpages.php">Edit Content</a></li><li><a href="/admin-help.php">Help</a></li>
				</ul>
			</nav>
		</header>

		<section id="banner">
			<div id="banner-image" style="background-image: url(/images/bg.jpg);">
				<div id="banner-text">
					<h1>Edit Members & Hours</h1>
					<p>Edit usernames, passwords, and service hours</p>
				</div>
			</div>
		</section>
		
		<section id="main-content">
			<h1>Instructions:</h1>
			<ol>
				<li>Open the Google Spreadsheet called <b>NHS Members & Hours.</b></li>
				<li>Make any changes you need to make. 
					<ul>
						<li><strong>First Year and Grade must be filled in.</strong> If the student started in 12th grade, service hours must be put in the "senior year" columns.</strong></li>
						<li><strong>DO NOT CHANGE THE COLUMNS. Changing the columns will break the upload process.</strong></li>
						<li><strong>Any users with errors will result in those users not being uploaded.</strong></li>
					</ul>
				</li>
				<li>Click File -> Download As -> Comma-separated values (CSV) and save it somewhere safe.</li>
				<li>Click the "Choose File" button below and find the file you just downloaded.</li>
				<li>Click <b>Import CSV</b> and wait for the process to finish. </li>
			</ol>

			<form enctype='multipart/form-data' action='admin-editmembers.php' method='post' id="upload-csv">
				<input size='50' type='file' name='filename' id='filename' />
				<input type='submit' name='submit' value='Upload CSV' />
			</form>

			<?php
				if (isset($_POST['submit'])) {
					$filename = $_FILES['filename']['name'];
					$ext = pathinfo($filename, PATHINFO_EXTENSION);
					echo $filename;
					if ($ext == "csv") {
						if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
							echo '<p class="success status">' . 'File '. $_FILES['filename']['name'] .' was uploaded successfully. ' . '</p>';
						}

						$deleterecords = "TRUNCATE TABLE members";
						if ($connection->query($deleterecords) === TRUE) {
							echo '<p class="success status">All current records purged</p>';
						} else {
							echo "Error deleting record: " . $conn->error . "<br /> \n";
						}

						$handle = fopen($_FILES['filename']['tmp_name'], "r");
						$firstRow = 0;

						$stopProcessing = FALSE;
						$hasErrors = FALSE;

						while ((($data = fgetcsv($handle, 1000, ","))) && (!$stopProcessing)) {
							if ($firstRow == 0) { 
								$firstRow++;
							} elseif ($firstRow == 1) {
								$adminUsername = $database['admin'];
								$adminPassword = $database['adminpass'];
								$import = "INSERT INTO members (name, lastname, username, stuid) VALUES ('$adminUsername', '$adminUsername', '$adminUsername', '$adminPassword');";
								mysqli_query($connection, $import) or die(mysql_error());
								$firstRow++;
							} else {
								if (empty($data[2]) || empty($data[3])) {
									$stopProcessing = TRUE;
								} elseif (empty($data[5]) || empty($data[6])) {
									echo '<p class="error status">ERROR: "First Year" and "Grade" are missing for '.$data[0].' '.$data[1].' in row '.($firstRow + 1).'. This user was skipped and cannot log in.</p>';
									$hasErrors = TRUE;
								} else {
									$import = "INSERT INTO members (name, lastname, username, stuid, firstyear, grade, h1, h2, h3, h4, sponsored1, sponsored2, h4s, h5, h6, h7, h8, sponsored3, sponsored4) VALUES ('$data[0]','$data[1]','$data[2]','$data[3]','$data[5]','$data[6]','$data[7]','$data[8]','$data[9]','$data[10]','$data[11]','$data[12]','$data[13]','$data[14]','$data[15]','$data[16]','$data[17]','$data[18]','$data[19]')";
									mysqli_query($connection, $import) or die(mysql_error());
								}
								$firstRow++;
							}
						}

						fclose($handle);

						if ($hasErrors) {
							echo '<p class="error big-text">Import successful, but with errors. Please fix the errors above and try again.</p>';
						} else {
							echo '<p class="success big-text">Import successful!</p>';
						}

					} else {
						echo '<p class="error">ERROR: File is not a CSV file. Please upload a CSV file!</p>';
					}
				}

			$sql = "SELECT name, lastname, username, stuid, firstyear, grade, h1, h2, h3, h4, sponsored1, sponsored2, h4s, h5, h6, h7, h8, sponsored3, sponsored4 FROM members";
			$result = $connection->query($sql);

			echo '<div class="table-container"><table class="center">';

			if($result->num_rows > 0) {
				echo '<tr><th colspan="6">Identifying Information</th><th colspan="6">Junior Year</th><th rowspan="2">Summer</th><th colspan="6">Senior Year</th></tr><tr><th>First Name</th><th>Last Name</th><th>Username</th><th>Student ID</th><th>First Year</th><th>Grade</th><th>MP1</th><th>MP2</th><th>MP3</th><th>MP4</th><th>Event 1</th><th>Event 2</th><th>MP1</th><th>MP2</th><th>MP3</th><th>MP4</th><th>Event 1</th><th>Event 2</th></tr>';

				while($row = $result->fetch_assoc()) {
					echo "<tr><td>".$row["name"]."</td><td>".$row["lastname"]."</td><td>".$row["username"]."</td><td>".$row["stuid"]."</td><td>".$row["firstyear"]."</td><td>".$row["grade"]."</td><td>".$row["h1"]."</td><td>".$row["h2"]."</td><td>".$row["h3"]."</td><td>".$row["h4"]."</td><td>".$row["sponsored1"]."</td><td>".$row["sponsored2"]."</td><td>".$row["h4s"]."</td><td>".$row["h5"]."</td><td>".$row["h6"]."</td><td>".$row["h7"]."</td><td>".$row["h8"]."</td><td>".$row["sponsored3"]."</td><td>".$row["sponsored4"]."</td>";
				}
			} else {
				echo '<p class="error">Records not available.</p>';
			}

			?>
			</table>
			</div>
		</section>

		<?php include 'footer.php'; ?>
		
	</body>
</html>
