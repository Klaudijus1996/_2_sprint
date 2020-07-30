<?php declare(strict_types = 1); include('data.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/main.css">
    <title>Document</title>
</head>
<body>
    <h1>Hello world!</h1>
    <?php 
        $servername = "localhost";
        $username = "root";
        $password = "mysql";
        $dbname = 'esybes_ir_rysiai';

        $conn = mysqli_connect($servername, $username, $password, $dbname); // Create connection
        
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        echo "Connected successfully<br>";
        # Staff Table :: Start ::
        $sql = "SELECT staffid, first_name, last_name, ".'role, '."projectid FROM staff";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
                echo "
                <table>
                    <tr>
                        <th>Staff ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Role</th>
                        <th>Project ID</th>
                    </tr>
                        ";
            while($row = mysqli_fetch_assoc($result)) {
                $staffID = $row['staffid'];
                $staffNames = $row['first_name'];
                $staffSurnames = $row['last_name'];
                $staffRole = $row['role'];
                $staffProject = $row['projectid'];
                echo "
                <tr>
                    <td>$staffID</td>
                    <td>$staffNames</td>
                    <td>$staffSurnames</td>
                    <td>$staffRole</td>
                    <td>$staffProject</td>
                </tr>
                ";
            }
            echo "</table>";
        } else {
            echo "ERROR: staff table not found!";
        }
        # Staff Table :: END ::
        # Projects Table :: START ::
        $sql = "SELECT projectid, project_name, deadline FROM projects";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo "
                <table>
                    <tr>
                        <th>Project ID</th>
                        <th>Project Name</th>
                        <th>Deadline</th>
                    </tr>
                        ";
            while ($row = mysqli_fetch_assoc($result)) {
                $projectID = $row['projectid'];
                $projectName = $row['project_name'];
                $projectDeadline = $row['deadline'];
                echo "
                <tr>
                    <td>$projectID</td>
                    <td>$projectName</td>
                    <td>$projectDeadline</td>
                </tr>
                ";
            }
            echo "</table>";
        } else {
            echo "ERROR: projects table not found!";
        }
        # Projects Table :: END ::
        mysqli_close($conn);

        
    ?>
    <?php require_once('logout.php') ?>
</body>
</html>