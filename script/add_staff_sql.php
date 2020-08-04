<?php 
    $servername = "localhost";
    $username = "root";
    $password = "mysql";
    $dbname = 'esybes_ir_rysiai';

    $conn = mysqli_connect($servername, $username, $password, $dbname); // Create connection
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $getName = $_POST['fname'];
    $getLastName = $_POST['lname'];
    $getRole = $_POST['role'];
    $getProjectID = !empty($_POST['pID']) ? $_POST['pID'] : "NULL";
    $nullis = NULL;
    $sql = "insert into esybes_ir_rysiai.staff (first_name, last_name, role, projectid) values ('$getName', '$getLastName', '$getRole', $getProjectID)";
?>