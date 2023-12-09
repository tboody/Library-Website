<?php
include("db.php");
?>

<html>
<head>
    <title>registration</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <header>
        <h1>registration page</h1>
    </header>
    <hr>
    <section class="registration-section">
        <form method="post" action="Registration.php" id="registerinfo" class="registration-form">
            <div class="container">
                <h1>register here</h1>
                <span class="error">* required fields</span>
                <label for="username"><b>username</b></label>
                <input type="text" placeholder="Enter Username" name="username" id="username" class="sur"required><span class="error"></span>
                <label for="password"><b>password</b></label>
                <input type="password" placeholder="Enter password" name="password" id="password" pattern=".{6,6}" title="password cannot be longer than 6 characters" required><span class="error"></span>
                <label for="passwordcomfer"><b>repeat password</b></label>
                <input type="password" placeholder="repeat password" name="passwordcomfer" id="passwordcomfer" required><span class="error"></span>
                <label for="firstname"><b>firstname</b></label>
                <input type="text" placeholder="Enter firstname" name="firstname" id="firstname" required><span class="error"></span>
                <label for="surname"><b>surname</b></label>
                <input type="text" placeholder="Enter surname" name="surname" id="surname" required><span class="error"></span>
                <label for="addressline"><b>address line 1</b></label>
                <input type="text" placeholder="Enter address line 1" name="addressline" id="addressline" required><span class="error"></span>
                <label for="addressline2"><b>address line 2</b></label>
                <input type="text" placeholder="Enter address line 2" name="addressline2" id="addressline2" required><span class="error"></span>
                <label for="city"><b>city</b></label>
                <input type="text" placeholder="Enter city" name="city" id="city" required><span class="error"></span>
                <label for="telephone"><b>telephone</b></label>
                <input type="text" placeholder="Enter telephone number" name="telephone" id="telephone" pattern="[0-9]{10}" title="number cannot be longer than 10 characters" required>
                <label for="mobile"><b>mobile</b></label>
                <input type="text" placeholder="Enter mobile number" name="mobile" id="mobile" pattern="[0-9]{10}" title="number cannot be longer than 10 characters" required>
                <button for="submitregister" type="submit" name="submitregister">submit</button>
            </div>
        </form>
    </section>
    <section id="blah">
       
        <a href="login.php" class="links">Login</a>
    </section>

    <?php
    if (isset($_POST['submitregister'])) {
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
        $fname = mysqli_real_escape_string($db, $_POST['firstname']);
        $lname = mysqli_real_escape_string($db, $_POST['surname']);
        $address1 = mysqli_real_escape_string($db, $_POST['addressline']);
        $address2 = mysqli_real_escape_string($db, $_POST['addressline2']);
        $city = mysqli_real_escape_string($db, $_POST['city']);
        $telephone = mysqli_real_escape_string($db, $_POST['telephone']);
        $mobile = mysqli_real_escape_string($db, $_POST['mobile']);
        $passwordcomf = mysqli_real_escape_string($db, $_POST['passwordcomfer']);
        $allusers = "select username from users";
        $checkuser = mysqli_query($db, $allusers);
        $row = 0;
        $count = 0;

        while($everyuser = mysqli_fetch_array($checkuser)) {
            if ($username == htmlentities($everyuser[$row])) {
                $count++;
            }
        }

        if ($count != 0) {
            echo "username in use";
        } else if($password != $passwordcomf) { ?>
            <script type="text/javascript"> alert("password not matching"); </script>
        <?php
        } else {
            $sql = "INSERT INTO users VALUES ('$username', '$password','$fname', '$lname', '$address1', '$address2', '$city', '$telephone', '$mobile' ,'$passwordcomf')";
            mysqli_query($db, $sql);

            if (!mysqli_close($db)) {
                echo "registration unsuccessful";
            } else {
            ?>
                <script type="text/javascript"> alert("registration successful"); </script>
            <?php
            }
        }
       
    }
    ?>
    <hr>
    <footer>
        <p>site by Abdelrahman Abdalla </p>
    </footer>
</body>
</html>

