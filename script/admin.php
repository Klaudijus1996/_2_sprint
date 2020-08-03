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
<div class="container">
                <?php 
                session_start();
                $_SESSION['post_data'] = $_POST;
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
                                <th>Actions</th>
                            </tr>
                                ";
                    while($row = mysqli_fetch_assoc($result)) {
                        $staffID = $row['staffid'];
                        $staffNames = $row['first_name'];
                        $staffSurnames = $row['last_name'];
                        $staffRole = $row['role'];
                        $staffProject = $row['projectid'];
                        $upd_staff_btn = "<form style='width: fit-content; display: inline;' action='' method='get'>
                                            <input type='submit' value='Edit'>
                                            <input type='hidden' name='upd-staff-btn' value='$staffID'>
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
                
                // echo "First GET: $get_upd_staff<br>";
                // $query = mysqli_query($db_conx, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error(db_conx), E_USER_ERROR);
                
                $get_upd_staff = $_GET['upd-staff-btn'];
                // $sql = "SELECT first_name, last_name, $role, projectid FROM esybes_ir_rysiai.staff WHERE StaffID=$get_upd_staff";
                $sql = isset($get_upd_staff) ? "SELECT first_name, last_name, $role, projectid FROM esybes_ir_rysiai.staff WHERE StaffID=$get_upd_staff" : "SELECT first_name, last_name, $role, projectid FROM esybes_ir_rysiai.staff";
                if (isset($_GET['upd-staff-btn'])) {
                    $result = mysqli_query($conn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            $staffID = $row['staffid'];
                            $staffNames = $row['first_name'];
                            $staffSurnames = $row['last_name'];
                            $staffRole = $row['role'];
                            $staffProject = $row['projectid'];
                            echo "
                            <form action='' method='post'>
                            <input type='text' name='upd-fname' value='$staffNames'/>
                            <input type='text' name='upd-lname' value='$staffSurnames'/>
                            <input type='text' name='upd-role' value='$staffRole'/>
                            <input type='text' name='upd-staffProject' value='$staffProject'/>
                            <input type='submit' name='sub-staff-upd' value='Done'/>
                            <input type='hidden' id='custId' name='klaudas' value='$get_upd_staff'>
                            </form>
                            ";
                        }
                    }
                } else {
                    echo "Error reading stuff: $sql";
                }
                $upd_fname = $_POST['upd-fname'];
                $upd_lname = $_POST['upd-lname'];
                $upd_role = $_POST['upd-role'];
                $upd_staffProject = !empty($_POST['upd-staffProject']) ? $_POST['upd-staffProject'] : "NULL";
                $subStaffUpd = $_POST['sub-staff-upd'];
                // echo "second GET: $get_upd_staff<br>";
                
                if (isset($subStaffUpd)) {
                    $placeholder = $_POST['klaudas'];

                        $update_staff = "UPDATE staff SET first_name='$upd_fname', last_name='$upd_lname', $role='$upd_role', projectid=$upd_staffProject WHERE StaffID=$placeholder";
                        if (mysqli_query($conn, $update_staff)) {
                        echo "Record updated successfully";
                        echo "kazkas yra?: ".$_GET['upd-staff-btn'];

                        // unset($_GET['upd-staff-btn']);
                        // unset($_POST['klaudas']);
                        // unset($_POST['sub-staff-upd']);
                        echo "kazkas yra?: ".$_GET['upd-staff-btn'];
                        // header('Location: index.php');
                    } else {
                        echo "Error updating record: " . mysqli_error($conn);
                    }
                }
                
                
                # Staff Table :: END ::
                mysqli_close($conn);
            ?>
            <?php echo "<a class='add-staff base-btn' href='add_staff.php'>Add Staff</a>"; ?>
            <?php require_once('logout.php') ?>
        </div>
    </div>
</body>
</html>