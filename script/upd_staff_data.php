<?php 
    include_once('data.php');
    $get_upd_staff = $_GET['upd-staff-btn'];
    $sql = isset($get_upd_staff) ? "SELECT first_name, last_name, $role, projectid FROM esybes_ir_rysiai.staff WHERE StaffID=$get_upd_staff" : "SELECT first_name, last_name, $role, projectid FROM esybes_ir_rysiai.staff where staffid=1";
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
                <form class='upd-form' action='' method='post'>
                    Name: <input type='text' name='upd-fname' value='$staffNames'/>
                    Last Name: <input type='text' name='upd-lname' value='$staffSurnames'/>
                    Job Description: <input type='text' name='upd-role' value='$staffRole'/>
                    Assign Project: <input type='text' name='upd-staffProject' value='$staffProject'/>
                    <input class='done base-btn' type='submit' value='Done'/>
                    <input type='hidden' name='upd-staff' value='$get_upd_staff'>
                    <a class='back base-btn' href='admin_staff.php'>Back</a>
                </form>
                ";
            }
            if (isset($_POST['upd-staff'])) {
                $upd_fname = $_POST['upd-fname'];
                $upd_lname = $_POST['upd-lname'];
                $upd_role = $_POST['upd-role'];
                $upd_staffProject = !empty($_POST['upd-staffProject']) ? $_POST['upd-staffProject'] : 'NULL';
                $post_upd_staff = $_POST['upd-staff'];
                if ( (!empty($upd_fname) && check_string($upd_fname))&&!empty($upd_lname) && check_string($upd_lname)) {
                    $update_staff = "UPDATE staff SET first_name='$upd_fname', last_name='$upd_lname', $role='$upd_role', projectid=$upd_staffProject WHERE StaffID=$post_upd_staff";
                    if (mysqli_query($conn, $update_staff)) {
                    echo "Staff data updated succesfully.";
                    ob_end_flush();
                    header("Location: admin_staff.php");
                
                    } else {
                        echo "Error updating record: " . mysqli_error($conn);
                    }
                } else {
                    echo "<h4 style='color: #8F1F14'>ERROR: Invalid information provided! You good?</h4>";
                }
            }
        }
    } else {
        echo "
        </div>
        <footer>
        &#169;  ".date('Y-m-d')."
        </footer>
        ";
        exit;
        echo "Error reading stuff: $sql";
    }
    mysqli_close($conn);
?>
