<?php 
    ini_set('display_errors', '1');

    if (isset($_POST['submit'])) {
        $file = $_SERVER["DOCUMENT_ROOT"] . "/pages/home.html";
        if (file_exists($file)) {
            file_put_contents($file, $_POST['homeText']);
        }

        $file = $_SERVER["DOCUMENT_ROOT"] . "/pages/dashboard.html";
        if (file_exists($file)) {
            file_put_contents($file, $_POST['dashboardText']);
        }

        $file = $_SERVER["DOCUMENT_ROOT"] . "/pages/forms.html";
        if (file_exists($file)) {
            file_put_contents($file, $_POST['formsText']);
        }

        $file = $_SERVER["DOCUMENT_ROOT"] . "/pages/faq.html";
        if (file_exists($file)) {
            file_put_contents($file, $_POST['faqText']);
        }
    }

    header("location: /admin-editpages.php");
?>