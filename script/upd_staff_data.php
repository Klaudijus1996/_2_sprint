<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <input type="submit" name="vardenis" value="get">
    </form>
    <form action="" method="post">
        <input type="submit" name="pavardenis" value="post">
    </form>
    <?php 
        echo "GET: ".$_POST['vardenis'];
        echo "<br>POST: ".$_POST['pavardenis'];
    ?>
</body>
</html>
