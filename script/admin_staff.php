<?php declare(strict_types = 1); include('data.php');?>
<?php 
if (isset($_POST['klaudas'])) {
    header("Refresh:0");

} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../styles/main.css">
    <link rel="stylesheet" type="text/css" href="../styles/upd_staff_form.css">

    <title>Document</title>
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

                # Staff Table UPD & DEL:: Start ::
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
                                <th>Actions</th>
                            </tr>
                                ";
                    while($row = mysqli_fetch_assoc($result)) {
                        ob_start();
                        $staffID = $row['staffid'];
                        $staffNames = $row['first_name'];
                        $staffSurnames = $row['last_name'];
                        $staffRole = $row['role'];
                        $staffProject = $row['projectid'];
                        $upd_staff_btn = "<form style='width: fit-content; display: inline;' action='' method='get'>
                                            <input class='edit base-btn' type='submit' value='Edit'>
                                            <input type='hidden' name='upd-staff-btn' value='$staffID'>
                                        </form>";
                        $del_staff_btn = "<form style='width: fit-content; display: inline;' action='' method='get'>
                                            <input class='del base-btn' type='submit' value='Del'>
                                            <input type='hidden' name='del-staff-btn' value='$staffID'>
                                        </form>";
                        echo "
                        <tr>
                            <td>$staffID</td>
                            <td>$staffNames</td>
                            <td>$staffSurnames</td>
                            <td>$staffRole</td>
                            <td>$staffProject</td>
                            <td>$upd_staff_btn $del_staff_btn</td>
                        </tr>
                        ";
                    }
                    echo "</table>";
                } else {
                    echo "ERROR: staff table not found!";
                }
                echo "<a class='add-staff base-btn' href='add_staff.php'>Add Staff</a>";
                require_once('logout.php');
                
                include_once('del_staff_data.php');
                include_once('upd_staff_data.php');

                # Staff Table UPD & DEL :: END ::
                ?>
        </div>
        <footer>
            &#169; <?php echo date("Y-m-d");?>
        </footer>
    </main>
</body>
</html>
