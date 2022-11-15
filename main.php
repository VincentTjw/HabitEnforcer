<?php
    require 'Config.php';
    session_start();
    if (empty($_SESSION['ID'])) {
        header('Location: log.php');
        exit;
    }else{
        $pdo = new PDO(Config::$url, Config::$user, Config::$password);
        $data = $pdo->query('SELECT ID_Group FROM user WHERE ID = ' . $_SESSION['ID'])->fetchAll();
        if (!$data[0]['ID_Group']) {
            header('Location: Group.php');
            exit;
        }
    }
?>

<html>

<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="./css/main.css" />
    <meta charset="utf-8" />
    <?php
    class displayData
    {
        public function displayTask()
        {
            $host = 'localhost';
            $db   = 'habitenforcer';
            $user = 'Esteban';
            $pass = 'Ynov';
            $dsn = "mysql:host=$host;dbname=$db";
            try {
                $pdo = new PDO(Config::$url, Config::$user, Config::$password);
                echo "<div class=\"contant\"><div class=\"taskGroupe jour\"><h1>Journalière</h1>";
                $data = $pdo->query("SELECT * FROM `task` WHERE `Periodicity` =  'Journalière'")->fetchAll();
                foreach ($data as $row) {
                    echo "<div class=\"task\" style=\"border-color: $row[Color]\">";
                    echo "<p class=\"taskName\" >$row[Name]</p>";
                    switch ($row["Difficulties"]) {
                        case 1:
                            echo "<p class=\"taskDifficulty\" >Kitty</p>";
                            break;
                        case 2:
                            echo "<p class=\"taskDifficulty\" >Kat</p>";
                            break;
                        case 3:
                            echo "<p class=\"taskDifficulty\" >Kitue</p>";
                            break;
                    }
                    echo "</div>";
                }
                echo "</div><div class=\"taskGroupe hebdo\"><h1>Hebdomadaire</h1>";
                $data = $pdo->query("SELECT * FROM `task` WHERE `Periodicity` =  'Hebdomadaire'")->fetchAll();
                foreach ($data as $row) {
                    echo "<div class=\"task\" style=\"border-color: $row[Color]\">";
                    echo "<p class=\"taskName\" >$row[Name]</p>";
                    switch ($row["Difficulties"]) {
                        case 1:
                            echo "<p class=\"taskDifficulty\" >Kitty</p>";
                            break;
                        case 2:
                            echo "<p class=\"taskDifficulty\" >Kat</p>";
                            break;
                        case 3:
                            echo "<p class=\"taskDifficulty\" >Kitue</p>";
                            break;
                    }
                    echo "</div>";
                }
                echo "</div></div>";
            } catch (\PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }
    }
    /*class checkTask{
    function __construct($complete) {
        $this->complete = $complete;
    }
    public function checkTask(){
        $host = 'localhost';
        $db   = 'habitenforcer';
        $user = 'Esteban';
        $pass = 'Ynov';
        $dsn = "mysql:host=$host;dbname=$db";
        try {
            $pdo = new \PDO($dsn, $user, $pass);
            $request = $pdo -> prepare('INSERT INTO `task` (complete) VALUES (:complete)');
           $request->execute(array(
           'complete' => $this->complete,
           ));
           } catch (\PDOException $e) {
               echo "Connection failed: " . $e->getMessage();
           }
    }
}*/
    //$checkTask = new checkTask($_POST[""])
    $displayInfo = new displayData();
    $displayInfo->displayTask();
    ?>
    </body>

</html>