<?php
include("db.php");
?>
<html>
<head>
    <title>Book Reservation</title>
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="stylesheet" type="text/css" href="your-stylesheet.css">

<body>
    <header class="reservation-header">
        <h1>Book Reservation</h1>
        <hr class="reservation-hr">
        <div id="searchbook">
            <form method="post" action="reservation.php">
                <select name="searchtype">
                    <option value="1">Health</option>
                    <option value="2">Business</option>
                    <option value="3">Biography</option>
                    <option value="4">Technology</option>
                    <option value="5">Travel</option>
                    <option value="6">Self-Help</option>
                    <option value="7">Cookery</option>
                    <option value="8">Fiction</option>
                </select>
                <input type="submit" name="catsearch"><br>
            </form>

            <form method="post" action="reservation.php">
                <input type="text" name="search">
                <input type="submit" name="submit">
            </form>
            
    
        <?php
        session_start();
        $accountholder = $_SESSION['username'];
        
        // Search Query
        if (isset($_POST['submit'])) {
            $find = $_POST['search'];
            $query = "SELECT booktitle, author, reserved, ISBN FROM books WHERE booktitle LIKE '%" . $find . "%' LIMIT 5";
            $result = mysqli_query($db, $query);
            
            echo '<table border="1" bgcolor="white">';
            while ($row = mysqli_fetch_row($result)) {
                $isbn = htmlentities($row[3]);
                $availability = htmlentities($row[2]);
                
                echo "<tr><th>ISBN</th><th>Book Name</th><th>Author</th><th>Availability</th><th>option</th></tr>";
                echo "<tr><td>$isbn</td><td>" . htmlentities($row[0]) . "</td><td>" . htmlentities($row[1]) . "</td><td></td><td>" . htmlentities($row[2]) . "</td><td>$availability</td>";

                
                if ($availability != 'N') {
                    echo '<td><button type="text">Reserved</button></td>';
                } else {
                    echo '<td><form method="post" action="reservation.php"><button type="submit" name="reservebook" value="' . $isbn . '">Reserve</button></form></td>';
                }
                echo "</tr>";
            }
            echo '</table>';
        }
         
        // Reserve Book
        if (isset($_POST['reservebook'])) {
            $isbn = $_POST['reservebook'];
            $reserve = "UPDATE books SET reserved = 'Y' WHERE ISBN = '$isbn'";
            $date = date("d/m/Y");
            $insert = "INSERT INTO reservations (username, ISBN,reservedDate) VALUES ('$accountholder', '$isbn', '$date')";
            mysqli_query($db, $reserve);
            mysqli_query($db, $insert);
            echo '<script type="text/javascript">alert("Reservation successful");</script>';
        }
        
        // Category Search
        if (isset($_POST['catsearch'])) {
            $catid = $_POST['searchtype'];
            $searchcat = "SELECT booktitle, author, reserved, ISBN, categoryID FROM books WHERE categoryID = '$catid' LIMIT 5";
            $result = mysqli_query($db, $searchcat);
            
            echo '<table border="1" bgcolor="white">';
            while ($row = mysqli_fetch_row($result)) {
                $isbn = htmlentities($row[3]);
                $availability = htmlentities($row[2]);
                
                echo "<tr><th>Cat ID</th><th>Book Name</th><th>Author</th><th>Availability</th><th>Action</th></tr>";
                echo "<tr><td>$isbn</td><td>" . htmlentities($row[0]) . "</td><td>" . htmlentities($row[1]) . "</td><td>$availability</td>";
                
                if ($availability == 'N') {
                    echo '<td><form method="post" action="reservation.php"><button type="submit" name="reservebook" value="' . $isbn . '">Reserve</button></form></td>';
                } else {
                    echo '<td><button type="text">Reserved</button></td>';
                }
                echo "</tr>";
            }
            echo '</table>';
        }
        ?>
    </header>
    <section id="blah" class="reserved-books-section">
        <ul>
            <a href="viewreg.php" class="reserved-books-link">
                <div class="links">Reserved Books<br><br></div>
            </a>
        </ul>
    </section>
    <section class="back-home-section">
        <a href="http://localhost/webdev/lib/login_homepage.php"  class="back-home-link"><button class="back-home-button" type="text">Back to Homepage</button></a>
    </section>
    <footer>
        <p>Site by Abdelrahman Abdalla</p>
    </footer>
</body>
</html>
