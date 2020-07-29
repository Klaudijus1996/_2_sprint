<?php 
    declare(strict_types = 1);
    ob_start();
    require_once('script/data.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/reset.css">
    <title>Document</title>
</head>
<body>
    <main>
        <div class='container'>
        <?php 
            if (isset($_POST['login']) && !empty($_POST['username']) 
            && !empty($_POST['password'])) {
                if ($_POST['username'] == 'name' && 
                $_POST['password'] == 'password') {
                    ob_get_clean();
                    session_start();
                    $_SESSION['valid'] = true;
                    $_SESSION['timeout'] = time();
                    $_SESSION['username'] = 'name';
                    header("Location: script/admin.php"); 
                } else {
                    echo $login_warning;
                }
            } else {
                echo $login_form;
                }
                ?>
        </div>
    </main>
</body>
</html>