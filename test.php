<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    session_start();
    echo $_SESSION['ID'];
    require 'Config.php';
    $pdo = new PDO(Config::$url, Config::$user, Config::$password);
    $data = $pdo->query('SELECT ID_Group FROM user WHERE ID = ' . $_SESSION['ID'])->fetchAll();
    foreach ($data as $row) {
        echo "<br>hey<br>";
        foreach ($row as $value) {
            echo "<br>";
            echo $value;
        }
    }
    echo "<br><br><br>";
    echo $data[0]['ID_Group'];
    ?>
</body>
</html>