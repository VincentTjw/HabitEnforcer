<?php
require 'BDD_Manager.php';
session_start();
class displayData
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = new BDD_Manager();
    }

    private function ScoreSort($a, $b)
    {
        if ($a['Score'] == $b['Score']) {
            return 0;
        }
        return ($a['Score'] > $b['Score']) ? -1 : 1;
    }

    public function LogVerif()
    {
        if (empty($_SESSION['ID'])) {
            header('Location: log.php');
            exit;
        } else {
            $data = $this->bdd->pdo->query('SELECT ID_Group FROM user WHERE ID = ' . $_SESSION['ID'])->fetchAll();
            if (!$data[0]['ID_Group']) {
                header('Location: Group.php');
                exit;
            }
        }
    }
    public function displayTask()
    {
        try {
            echo "<div class=\"contant\">";
            $this->displayJour();
            $this->displayHebdo();
            $this->displayScore();
            echo "</div>";
        } catch (\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    private function displayJour()
    {
        echo "<div class=\"taskGroupe jour\"><h1>Journalière</h1>";
        $data = $this->bdd->pdo->query("SELECT * FROM `task` WHERE `Periodicity` =  'Journalière' AND `ID_User` = " . $_SESSION['ID'])->fetchAll();
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
            if ($row['complete'] == 0) {
                echo "<form action=\"taskValide.php\" method=\"post\">";
                echo '<button class="taskButton" type="submit" name="ID" value="'.$row['ID'].'">Validé</button>';
                echo "</form>";
            } else {
                echo '<button class="taskButton" type="submit" disabled>Terminé</button>';
            }
            echo "</div>";
        }
        echo "</div>";
    }

    private function displayHebdo()
    {
        echo "<div class=\"taskGroupe hebdo\"><h1>Hebdomadaire</h1>";
        $data = $this->bdd->pdo->query("SELECT * FROM `task` WHERE `Periodicity` =  'Hebdomadaire' AND `ID_User` = " . $_SESSION['ID'])->fetchAll();
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
            if ($row['complete'] == 0) {
                echo "<form action=\"taskValide.php\" method=\"post\">";
                echo '<button class="taskButton" type="submit" name="ID" value="'.$row['ID'].'">Validé</button>';
                echo "</form>";
            } else {
                echo '<button class="taskButton" type="submit" disabled>Terminé</button>';
            }
            echo "</div>";
        }
        echo "</div>";
    }

    private function displayScore()
    {
        echo "<div class=\"taskGroupe scoreGroup\"><h1>Score</h1><div class=\"showScore\">";
        $data = $this->bdd->pdo->query("SELECT ID_Group FROM `user` WHERE `ID` = " . $_SESSION['ID'])->fetchAll();
        $data = $this->bdd->pdo->query("SELECT Pseudo,Score FROM `user` WHERE `ID_Group` = " . $data[0]['ID_Group'])->fetchAll();
        $scoreTotal = 0;
        foreach ($data as $row) {
            $scoreTotal += $row['Score'];
        }
        if ($scoreTotal <= 0) {
            echo "GAME OVER";
            require_once 'leave.php';
            Leave::GameOver();
        }
        usort($data, array($this, "ScoreSort"));
        echo "<p class=\"scoreTotal\" >Total : $scoreTotal</p>";
        foreach ($data as $row) {
            echo "<hr>";
            if ($row["Score"] > 0) {
                echo "<div class=\"score\" ><p>$row[Pseudo] : </p><p style=\"color:#17D800;font-weight: 700;\">$row[Score]</p></div>";
            } else if ($row["Score"] < 0) {
                echo "<div class=\"score\" ><p>$row[Pseudo] : </p><p style=\"color:#FF0000;font-weight: 700;\">$row[Score]</p></div>";
            } else {
                echo "<div class=\"score\" ><p>$row[Pseudo] : $row[Score]</p></div>";
            }
        }
        echo "</div>";
    }

    public function GetGroupName()
    {
        $data = $this->bdd->pdo->query("SELECT ID_Group FROM `user` WHERE `ID` = " . $_SESSION['ID'])->fetchAll();
        $data = $this->bdd->pdo->query("SELECT Name FROM `group` WHERE `ID` = " . $data[0]['ID_Group'])->fetchAll();
        return $data[0]['Name'];
    }

    public function ActualiseScore(){
        session_start();
        $users = $this->bdd->getUserFromGroup($this->bdd->getUserIDGroupWhereId($_SESSION['ID'])['ID_Group']);
        foreach ($users as $user){
            $tasks = $this->bdd->pdo->query("SELECT `ID` FROM `task` WHERE `ID_User` = " . $user['ID'])->fetchAll();
            foreach ($tasks as $task){
                require_once 'Task.php';
                Task::checkTask($user['ID'],$task['ID']);
            }
        }
    }

    public function TaskButtonStop(){
        session_start();
        $DateLastTask = $this->bdd->getUserById($_SESSION['ID'])['DateLastTask'];
        if ($DateLastTask == date("Y/m/d")){
            echo "disabled";
        }
    }

}

$displayData = new displayData();
$displayData->LogVerif();
$displayData->ActualiseScore();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="css/font.css">
    <title>Document</title>
</head>

<body>
    <div id="fond">
        <div class="pyro">
            <div class="before"></div>
            <div class="after"></div>
        </div>
        <div class="gOvale" id="ovale1"></div>
        <div class="gOvale" id="ovale3"></div>
        <div class="gOvale" id="ovale2"></div>
        <div class="gOvale" id="ovale4"></div>
        <div class="gOvale" id="ovale5"></div>
    </div>
    <div class="header">
        <div id="logOut">
            <form action="logOut.php" method="post">
                <button type="submit">Log Out</button>
            </form>
        </div>
        <div id="addTask">
            <form action="Addtask.php" method="post">
                <button type="submit" <?php $displayData->TaskButtonStop(); ?>>Ajouter une tache</button>
            </form>
        </div>
        <div id="leave">
            <form action="leave.php" method="post">
                <button type="submit">Quitté le groupe</button>
            </form>
        </div>
        <div id="logo">
            <img src="./img/Kittytude_logo.png">
            <h1><?php echo $displayData->GetGroupName(); ?></h1>
            <img src="./img/Kittytude_logo.png">
        </div>
        <div class="invite">
            <div id="show">
                <h1>Invité</h1>
            </div>
            <div id="popup">
                <form action="invite.php" method="post">
                    <label for="email">Email de la personne a invité</label><br>
                    <input type="text" name="email" id="email" placeholder="exemple@e.mail"><br>
                    <button type="submit">Validé</button>
                </form>
            </div>
        </div>
    </div>
    <?php $displayData->displayTask(); ?>
</body>

</html>
<!-- DateLastTask -->