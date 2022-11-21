<?php
require_once 'Task.php';
require_once 'BDD_Manager.php';
$bdd = new BDD_Manager();
$DateLastTask = $bdd->getUserByID($_SESSION['ID'])['DateLastTask'];
// var_dump($DateLastTask);
if (!($DateLastTask == date("Y/m/d"))){
    $newTask = new Task($_POST["tache"],$_POST["difficultyTask"],$_POST["colorTask"],$_POST["periodicityTask"],0,date("Y/m/d"));
    $newTask->createTask();
    $bdd->pdo->query("UPDATE `user` SET `DateLastTask` = '" . date("Y/m/d") . "' WHERE `ID` = " . $_SESSION['ID']);
}
header('Location: main.php');
exit;
?>