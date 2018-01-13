<?php
ini_set('display_errors',1);

include('includes/session.php');

if ($login_session != 'admin') {
	header('Location: 401.php');
	exit;
}

?>

<html>
	<head>
		<title>Edit Content | Hershey National Honor Society</title>
		<link rel="stylesheet" type="text/css" href="./css/info.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://fonts.googleapis.com/css?family=Lato:400,700,900" rel="stylesheet">
		<script src="/pages/tinymce/tinymce.min.js"></script>

		<style>
			div {
				overflow: initial;
			}
		</style>
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
					<li><a href="/admin.php">Dashboard</a></li><li><a href="/admin-editmembers.php">Edit Members</a></li><li><a href="/admin-editevents.php">Edit Events</a></li><li class="active"><a href="/admin-editpages.php">Edit Content</a></li><li><a href="/admin-help.php">Help</a></li>
				</ul>
			</nav>
		</header>

		<section id="banner">
			<div id="banner-image" style="background-image: url(/images/bg.jpg);">
				<div id="banner-text">
					<h1>Edit Content</h1>
					<p>Please select a page below to start editing!</p>
				</div>
			</div>
		</section>
		
		<section id="main-content">
			<h1>Instructions:</h1>
			<ol>
				<li>Choose any or all of the pages below to edit. 
				<li>Add and format any text, images, videos, etc. you want using the editors below. Whatever you see below will show up on the page.</li>
				<li>When you are satisfied with the edits, press the "Save & Publish" button at the bottom. Saving will save all the pages all at once.</li>
			</ol>

			<h1>Edit Pages</h1>
			<form action="includes/savepages.php" method="post">
				<h4>Home</h4>
				<p>This is a <strong>public</strong> page that shows at "hersheynhs.com." Use this page for any public facing content.</p>
				<textarea name="homeText" id="editHome">
					<?php include 'pages/home.html'; ?>
				</textarea>

				<h4>Dashboard</h4>
				<p>This is a <strong>private</strong> page that shows once students log in.</p>
				<textarea name="dashboardText" id="editDashboard">
					<?php include 'pages/dashboard.html'; ?>
				</textarea>

				<h4>Forms/Docs</h4>
				<p>This is a <strong>private</strong> page that shows when students click on Forms/Docs in the navigation menu.</p>
				<textarea name="formsText" id="editForms">
					<?php include 'pages/forms.html'; ?>
				</textarea>

				<h4>FAQ</h4>
				<p>This is a <strong>private</strong> page that shows when students click on FAQ in the navigation menu.</p>
				<textarea name="faqText" id="editFAQ">
					<?php include 'pages/faq.html'; ?>
				</textarea>

				<button class="save" name="submit" type="submit">Save & Publish</input>
			</form>
			<script>
				tinymce.init({
					selector:'#editHome, #editDashboard, #editForms, #editFAQ',
					height: 500,
					plugins: [
        				"advlist autolink lists link image charmap print preview anchor searchreplace visualblocks code fullscreen insertdatetime media table paste imagetools wordcount textcolor"
					],
    				toolbar: "insertfile undo redo | formatselect styleselect | bold italic underline forecolor backcolor | link image | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | fullscreen",
					branding: false,
					browser_spellcheck: true,
					contextmenu: false,
					content_css : '/css/info.css',
					menu: {
						file: {title: 'File', items: 'preview | print'},
						edit: {title: 'Edit', items: 'undo redo | cut copy paste pastetext | selectall'},
						view: {title: 'View', items: 'code | preview fullscreen'},
						insert: {title: 'Insert', items: 'image link media table | charmap hr | insertdatetime'},
						format: {title: 'Format', items: 'bold italic underline strikethrough superscript subscript code | formats align | removeformat'},
						table: {title: 'Table', items: 'inserttable tableprops deletetable | cell row column'}
					}
				});
			</script>
		</section>

		<?php include 'footer.php'; ?>

	</body>
</html>
