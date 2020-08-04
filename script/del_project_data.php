<?php 
    $del_project_request = $_GET['del-projects-btn'];
    if (isset($del_project_request)) {
        $sql = "DELETE FROM projects WHERE projectid = $del_project_request";
        if (mysqli_query($conn, $sql)) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
        mysqli_close($conn);
        ob_end_flush();
        header("Location: admin_projects.php");
    }
?>