<?php declare(strict_types = 1); include('data.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/main.css">
    <title>Staff</title>
</head>
<body>
    <main>
        <div class="navbar">
            <nav>
                <a href="staff.php">Darbuotojai</a>
                <a href="projects.php">Projektai</a>
                <a href="staff_projects.php">Darbuotoju ir projektu lentele</a>
                <a href="admin_staff.php">Admin</a>
                <a href="admin_projects.php">Admin P</a>
                <a href="admin_SP.php">Admin SP</a>
                <p>projektu valdymo sistema</p>
            </nav>
        </div>
        <div class="container">
                <?php 
                $servername = "localhost";
                $username = "root";
                $password = "mysql";
                $dbname = 'esybes_ir_rysiai';

                $conn = mysqli_connect($servername, $username, $password, $dbname); // Create connection
                
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // echo "Connected successfully<br>";
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
                mysqli_close($conn);
            ?>
            <?php echo "<a class='add-staff base-btn' href='add_staff.php'>Add Staff</a>"; ?>
            <?php require_once('logout.php') ?>
        </div>
        <footer>
            &#169; <?php echo date("Y-m-d"); ?>
        </footer>
    </main>
</body>
</html>