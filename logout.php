<?php
include("db.php");
session_start();
session_destroy();
unset($_SESSION['username']);
?>

<html>
<head>
    <title>Logout</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <header>
        <h1>You are now logged out.</h1>
    </header>
    <section id="blah">
        <button onclick="document.location='index.html'">Continue</button>
    </section>
    <footer>
        <p>Site by Abdelrahman Abdalla</p>
    </footer>
</body>
</html>

