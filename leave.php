<?php
class Leave{

    private $bdd = null;
    private $user = null;

    public function __construct(){
        session_start();
        require_once 'BDD_Manager.php';
        $this->bdd = new BDD_Manager();
        $this->user = $_SESSION['ID'];
        $this->leave();
        $this->taskClear();
        $this->restScore();
    }

    private function leave(){
        $req = $this->bdd->pdo->prepare('UPDATE `user` SET `ID_Group` = NULL WHERE `user`.`ID` = :id');
        $req->execute(array(
            'id' => $this->user
        ));
    }

    private function restScore(){
        $req = $this->bdd->pdo->prepare('UPDATE `user` SET `Score` = 100 WHERE `user`.`ID` = :id');
        $req->execute(array(
            'id' => $this->user
        ));
    }

    private function taskClear(){
        $req = $this->bdd->pdo->prepare('DELETE FROM `task` WHERE `task`.`ID_User` = :id');
        $req->execute(array(
            'id' => $this->user
        ));
    }
}
new Leave();
header('Location: main.php');
exit;
?>