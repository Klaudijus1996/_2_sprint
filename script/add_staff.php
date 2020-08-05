<?php declare(strict_types = 1); include('data.php'); include('add_staff_sql.php')?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/staff_form.css">
    <title>Staff Form</title>
</head>
<body>
    <main>
        <div class="navbar">
            <nav>
            <a href="admin_staff.php">Darbuotojai</a>
                <a href="admin_projects.php">Projektai</a>
                <a href="admin_SP.php">Darbuotoju ir projektu lentele</a>
                <p>projektu valdymo sistema</p>
            </nav>
        </div>
        <div class="container">
            <?php 
                echo $add_staff_form;
                if (isset($_POST['addstaff'])) {
                    if (empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['role'])
                        || check_numbers($_POST['fname']) || check_numbers($_POST['lname']) || is_numeric($_POST['role']) || 
                            !check_id($getProjectID) || check_symbols($_POST['fname']) || check_symbols($_POST['lname'])) {
                                
                                    echo "<h4>Invalid information has been added</h4>";
                                
                    } else {
                        if (mysqli_query($conn, $sql)) {
                            echo "Staff member added successfully";
                        } else {
                            echo "Error adding staff: " . mysqli_error($conn);
                        }
                        mysqli_close($conn);
                        header('Location: admin_staff.php');
                    }
                }
            ?>
        </div>
        <footer>
            &#169; <?php echo date("Y-m-d"); ?>
        </footer>
    </main>
</body>
</html>