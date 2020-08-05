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
    echo $_SERVER['REQUEST_URI'];
    $server = $_SERVER['REQUEST_URI'];
    $test = substr($server, strripos($server, '/')+1);
    echo "<br>$test";
?>
</body>
</html>