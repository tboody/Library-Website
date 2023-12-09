<?php
include("db.php");
session_start();
$accountholder = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reserved Books</title>
    <link rel="stylesheet" type="text/css" href="main.css">
    <style>

        .reserved-books-container {
            margin: 50px auto; /* Centers the table horizontally */
            width: 80%; /* Adjust width as needed */
        }
        .back-to-home {
            display: block;
            width: 300px; /* Adjust width as needed */
            margin: 10px auto; /* Centers the button horizontally and positions it at the bottom */
            padding: 8px;
            background-color: #333; /* Black color */
            color: white;
            text-align: center;
            text-decoration: none;
            border: none;
            border-radius: 5px;
        }

        .back-to-home:hover {
            background-color: #555; /* Darker shade for hover */
        }
    </style>
</head>
<body>
    <header>
        <h1>All Your Reserved Books</h1>
    </header>

    <div class="reserved-books-container">
        <?php
        $display = "SELECT * FROM reservations WHERE username = '$accountholder'";
        $result = mysqli_query($db, $display);

        echo '<table border="1" bgcolor="white">'."\n";
        echo "<th>ISBN</th>";
        echo "<th>User Name</th>";
        echo "<th>Date</th>";
        echo "<th>Option</th>";
        while ($row = mysqli_fetch_row($result)) {
            $ISBN = htmlentities($row[1]);
            echo "<tr><td>";
            echo htmlentities($row[1]);
            echo "</td><td>";
            echo htmlentities($row[0]);
            echo "</td><td>";
            echo htmlentities($row[2]);
            echo "</td><td>";
        ?>
            <form method="post" action="viewreg.php">
                <button type="submit" name="unreservebook" value="<?php echo $ISBN ?>">Unreserve</button>
            </form>
            </td></tr>
        <?php
        }
        echo "</table>";

        if (isset($_POST['unreservebook'])) {
            $ISBN = $_POST['unreservebook'];
            $delete = "DELETE FROM reservations WHERE ISBN = '$ISBN'";
            $unreserve = "UPDATE books SET reserved = 'N' WHERE ISBN = '$ISBN'";
            mysqli_query($db, $delete);
            mysqli_query($db, $unreserve);
            // header("Location: viewreg.php");
        }
        ?>
    </div>

    <!-- Back to Home Page link -->
    <a href="http://localhost/webdev/lib/login_homepage.php" class="back-to-home">
        <button type="button">Back to Home Page</button>
    </a>
</body>
</html>
