<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hello!</h1>
    <form action="" method="get">
        <input type="text" name="yeet">
        <input type="text" name="booy">
        <input type="submit" name="kekw" value="submit">
    </form>
<?php 
    $yeet = $_GET['yeet'];
    $booy = $_GET['booy'];
    $kekw = $_GET['kekw'];
    echo "tekstas= ".$yeet.'<br>';
    if (isset($kekw)) {
        if (empty($yeet)||empty($booy)) {
            echo "Tuscias!";
        }
    }
?>
</body>
</html>