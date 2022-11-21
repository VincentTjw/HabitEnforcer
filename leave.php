<?php
class Leave{

    private $bdd = null;
    private $user = null;

    public static function GameOver(){
        echo " GAME OVER ";
        session_start();
        require_once 'BDD_Manager.php';
        $bdd = new BDD_Manager();
        require_once 'BDD_Manager.php';
        $ID_Group = $bdd->getUserIDGroupWhereId($_SESSION['ID'])[0];
        $allUser = $bdd->getUserFromGroup($ID_Group);
        echo $allUser;
        foreach ($allUser as $user) {
            echo $user;
            new Leave($user['ID']);
        }
        $bdd->DelGroup($ID_Group);
        
    }

    public function __construct(String $ID){
        require_once 'BDD_Manager.php';
        $this->bdd = new BDD_Manager();
        $this->user = $ID;
        $this->leaveGroup();
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

    private function leaveGroup(){
        $this->leave();
        $this->restScore();
        $this->taskClear();
    }
}
session_start();
new Leave($_SESSION['ID']);
header('Location: main.php');
exit;
?>