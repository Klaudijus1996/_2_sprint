<?php
$get_edit_request = $_GET['upd-projects-btn'];
$sql = "SELECT project_name, deadline FROM esybes_ir_rysiai.projects WHERE projectid=$get_edit_request";
    if (isset($get_edit_request)) {
        $result = mysqli_query($conn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $projectID = $row['projectid'];
                $projectName = $row['project_name'];
                $projectDeadline = $row['deadline'];
                echo "
                <form class='upd-form' action='' method='post'>
                    Name: <input type='text' name='upd-pname' value='$projectName'/>
                    Last Name: <input type='text' name='upd-dl' value='$projectDeadline'/>
                    <input class='done base-btn' type='submit' value='Done'/>
                    <input type='hidden' name='upd-project' value='$get_edit_request'>
                    <a class='back base-btn' href='admin_projects.php'>Back</a>
                </form>
                ";
            }
            $upd_project_name = $_POST['upd-pname'];
            $upd_deadline = $_POST['upd-dl'];
            $get_done_request = $_POST['upd-project'];                
            if (isset($get_done_request)) {
                if (!empty($upd_project_name) || !check_symbols($upd_project_name)) {
                    $update_project = "UPDATE projects SET project_name='$upd_project_name', deadline='$upd_deadline' WHERE ProjectID=$get_done_request";
                    if (mysqli_query($conn, $update_project)) {
                    echo "Project data updated succesfully.";
                    ob_end_flush();
                    header("Location: admin_projects.php");
                
                    } else {
                        echo "Error updating record: " . mysqli_error($conn);
                    }
                } else {
                    echo "<h4 style='color: #8F1F14'>ERROR: Invalid information provided!</h4>";
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