<?php 
    $new_project = $_GET['create_project'];
    $project_id = $_POST['project_id'];
    $project_name = $_POST['project_name'];
    $project_deadline = $_POST['deadline'];
    $new_project_form_submit = $_POST['create_new_project'];

    if (isset($new_project)) {
        echo $create_project_form;
        // $new_project_form_submit = $_GET['create_new_project'];
                if (isset($new_project_form_submit)) {
                    if (empty($project_name)) {
                        echo "<h4>Please provide a name for a Project</h4>";
                    } else {
                        $sql = "insert into esybes_ir_rysiai.projects (project_name, deadline) values ('$project_name', '$project_deadline')";
                        if (mysqli_query($conn, $sql)) {
                            echo "Staff member added successfully";
                        } else {
                            echo "Error adding staff: " . mysqli_error($conn);
                            echo "<h4>Please provide a name for a Project</h4>";
                        }
                        mysqli_close($conn);
                        header('Location: admin_projects.php');
                    }
                }
    }
?>