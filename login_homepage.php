<!DOCTYPE html>
<?php
session_start();
$accountholder = isset($_SESSION['username']) ? $_SESSION['username'] : null;
?>
<html>
<head>
    <title>The Library</title>
    <link rel="stylesheet" type="text/css" href="main.css">
    
</head>
<body>
    <header>
        <h1>Welcome to the library</h1>
    </header>
    <?php if ($accountholder) : ?>
        <p class="loggedin-message">
            <span class="account-holder"><?php echo ucfirst($accountholder); ?></span>, You have logged in successfully!
        </p>
    <?php endif; ?>
    <section id="blah">
        <ul>
            <a href="login.php">
                <div class="links">login<br><br></div>
            </a>

            <a href="registration.php">
            <div class="links">registration<br><br></div>
             </a>

            <a href="reservation.php">
            <div class="links">reservation<br><br></div>
            </a>

            <a href="logout.php">
            <div class="links">logout<br><br></div>
            </a>

           
        </ul>
    </section>
    <br><br>
    <hr>
    <footer>
        <p>Site by Abdelrahman Abdalla</p>
    </footer>
</body>
</html>
