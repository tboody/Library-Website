<?php 
    include("db.php");
    session_start();
?>

<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <header>
        <h2>Login</h2>
    </header>
    <hr>
    <div id="login">
        <form method="post" action="login.php">
            <div id="container">
                <label for="username"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="username" required>
                
                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>
                
                <button type="submit" name="submitlog">Login</button>
            </div>
        </form>
    </div>
    <hr>
    <section id="blah">
       
        <a href="reservation.php" class="links">Reserve Books</a>
    </section>
    <footer>
        <p>Site by Abdelrahman Abdalla</p>
    </footer>
</body>
</html>

<?php
if (isset($_POST['submitlog'])) {
    $userN = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    

    $query = "SELECT * FROM users WHERE username = '$userN' AND password = '$password'";
    $result = mysqli_query($db, $query);

    if (!$result || mysqli_num_rows($result) == 0) {
        echo "Invalid username or password";
    } else {
        $_SESSION['username'] = $_POST['username'];
        echo "Welcome " . $userN;
        header("location: login_homepage.php");
        exit;
    }
}
?>

