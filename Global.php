<?php
class Global_
{
    public static function LogVerif()
    {
        session_start();
        require 'BDD_Manager.php';
        if (empty($_SESSION['ID'])) {
            header('Location: log.php');
            exit;
        } else {
            $bdd = new BDD_Manager();
            $data = $bdd->pdo->query('SELECT ID_Group FROM user WHERE ID = ' . $_SESSION['ID'])->fetchAll();
            if (!$data[0]['ID_Group']) {
                header('Location: Group.php');
                exit;
            }
        }
    }
}
