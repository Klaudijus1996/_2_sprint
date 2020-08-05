<?php 
    $new_project = $_GET['create_project'];
    $project_id = $_POST['project_id'];
    $project_name = $_POST['project_name'];
    $project_deadline = $_POST['deadline'];
    $new_project_form_submit = $_POST['create_new_project'];
    $clean_current_location = substr($currentFile, 0, stripos($currentFile, '?'));
    if (isset($new_project)) {
        if ($clean_current_location == 'admin_projects.php') {
            echo $create_project_form;
        } else {
            echo $create_project_form_sp;
        }
                if (isset($new_project_form_submit)) {
                    $septyni = 7;
                    $deadline = empty($project_deadline) ? date("Y-m-d") : $project_deadline;
                    if (empty($project_name) || check_symbols($project_name)) {
                        echo "<h4>Please provide a name for a Project</h4>";
                    } else {
                        $sql = "insert into esybes_ir_rysiai.projects (project_name, deadline) values ('$project_name', '$deadline')";
                        if (mysqli_query($conn, $sql)) {
                            echo "Staff member added successfully";
                        } else {
                            echo "Error adding staff: " . mysqli_error($conn);
                            echo "<h4>Please provide a name for a Project</h4>";
                        }
                        mysqli_close($conn);
                        if ($clean_current_location == 'admin_projects.php') {
                        header('Location: admin_projects.php'); 
                        } else {
                            header('Location: admin_SP.php');
                        }
                    }
                }
    }
?>