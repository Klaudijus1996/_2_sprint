<?php declare(strict_types = 1); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hello world!</h1>
    <?php 
        $servername = "localhost";
        $username = "root";
        $password = "mysql";
        $dbname = 'esybes_ir_rysiai';
        $word = 'role';
        
        $conn = mysqli_connect($servername, $username, $password, $dbname); // Create connection
        
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        echo "Connected successfully<br>";

        $sql = "SELECT staffid, first_name, last_name, $word FROM staff";

        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "id: " . $row["staffid"]. " - Name: " . $row["first_name"]. ", " . $row["last_name"].", ".$row[$word]. "<br>";
                // TODO input table data
            }
        } else {
            echo "0 results";
        }

        mysqli_close($conn);

        
    ?>
    <?php require_once('logout.php') ?>
</body>
</html>