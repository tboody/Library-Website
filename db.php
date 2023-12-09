<?php
    echo "<pre>\n";
    $db = mysqli_connect('localhost', 'root', '', 'Bookdb') 
    or die(mysqli_connect_error());
    ini_set("display_errors", 1);
    error_reporting(-1);    


?>
