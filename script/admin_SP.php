<?php declare(strict_types = 1); include('data.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/main.css">
    <title>Staff and Projects</title>
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
                $sql = "SELECT projects.projectid, GROUP_CONCAT(CONCAT_WS(' ', first_name, last_name)) as fullname, project_name, deadline FROM esybes_ir_rysiai.projects
                left join staff on projects.projectid = staff.projectid
                GROUP BY projects.ProjectID;";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                        echo "
                        <table>
                            <tr>
                                <th>Project ID</th>
                                <th>People assigned to project</th>
                                <th>Project Name</th>
                                <th>Deadline</th>
                                <th>Actions</th>
                            </tr>
                                ";
                    while($row = mysqli_fetch_assoc($result)) {
                        ob_start();
                        $projectID = $row['projectid'];
                        $staffNames = $row['fullname'] != NULL ? $row['fullname'] : "Undecided"; 
                        $projectName = $row['project_name'];
                        $projectDeadline = $row['deadline'];
                        $assign_person_edit = "<form style='width: fit-content; display: inline;' action='' method='get'>
                                                    <input class='edit base-btn' type='submit' value='Edit'>
                                                    <input type='hidden' name='sp_edit' value='$projectID'>
                                                </form>";
                        echo "
                        <tr>
                            <td>$projectID</td>
                            <td>$staffNames</td>
                            <td>$projectName</td>
                            <td>$projectDeadline</td>
                            <td>$assign_person_edit</td>
                        </tr>
                        ";
                    }
                    echo "</table>";
                    $personID = $_GET['sp_edit'];
                    if (isset($personID)) {
                        echo "<h4>Assign projects<h4>";
                        $sql = "SELECT GROUP_CONCAT(CONCAT_WS(' ', first_name, last_name)) as fullname FROM esybes_ir_rysiai.staff
                        GROUP BY staff.staffid;";
                        $result = mysqli_query($conn, $sql);
                        echo "
                            <form action='' method='post'>
                                <label for='names'>Choose a project: </label>
                                <select name='names' id='names'>";
                        while($row = mysqli_fetch_assoc($result)) {
                            $staffNames = $row['fullname'] != NULL ? $row['fullname'] : "Undecided";
                                        echo "<option value='$staffNames'>$staffNames</option>";
                                        if (isset($names)) {
                                        break;
                                        }
                                    }
                                    echo "</select>
                                    <br>
                                    <input type='submit' value='Submit'>
                                    </form>
                                    ";
                                    $names = $_POST['names'];
                                    // echo $names;
                                    // echo $personID;
                                    // echo $lname;
                                    // exit;
                                    // while($row = mysqli_fetch_assoc($result)) {
                                        //     echo "<h1>$names</h1>";
                                        //     echo "<h1>$staffNames</h1>";
                                        // }
                                        // exit;
                                        if (isset($names)) {
                                            $fname = substr($names, 0, stripos($names, ' '));
                                            $lname = substr($names, strlen($fname)+1);
                                    $sql = "UPDATE esybes_ir_rysiai.staff SET ProjectID='$personID' WHERE esybes_ir_rysiai.staff.first_name='$fname' and esybes_ir_rysiai.staff.last_name='$lname'";
                                    if (mysqli_query($conn, $sql)) {
                                        echo "Staff data updated succesfully.";
                                        ob_end_flush();
                                        header("Location: admin_SP.php");
                                    
                                        } else {
                                            echo "Error updating record: " . mysqli_error($conn);
                                        }
                                }
                    }
                } else {
                    echo "ERROR: staff table not found!";
                }
                # Staff Table :: END ::
                mysqli_close($conn);
            ?>
            <?php require_once('logout.php') ?>
        </div>
        <footer>
            &#169; <?php echo date("Y-m-d"); ?>
        </footer>
    </main>
</body>
</html>