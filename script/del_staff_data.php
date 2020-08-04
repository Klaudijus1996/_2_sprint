<?php 
    $get_del_staff = $_GET['del-staff-btn'];


    if (isset($get_del_staff)) {
        $sql = "DELETE FROM staff WHERE staffid = $get_del_staff";
        if (mysqli_query($conn, $sql)) {
            echo "Record deleted successfully";
            header("Location: admin.php");
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
        
        mysqli_close($conn);
    }
?>