<?php
class BDD_Manager
{
    public $pdo = null;

    public function __construct()
    {
        require_once 'Config.php';
        $this->pdo = new PDO(Config::$url, Config::$user, Config::$password);
    }

    public function getUserByEmail($email)
    {
        $req = $this->pdo->prepare('SELECT * FROM `user` WHERE Email = :email');
        $req->execute(array(
            'email' => $email
        ));
        return $req->fetch();
    }

    public function getUserById($id)
    {
        $req = $this->pdo->query("SELECT * FROM `user` WHERE ID = $id");
        return $req->fetch();
        
    }

    public function getUserIDGroupWhereId($id)
    {
        $req = $this->pdo->prepare('SELECT `ID_Group` FROM `user` WHERE `ID` = :id');
        $req->execute(array(
            'id' => $id,
        ));
        return $req->fetch();
    }

    public function getUserFromGroup($id)
    {
        $req = $this->pdo->prepare('SELECT * FROM `user` WHERE ID_Group = :id');
        $req->execute(array(
            'id' => $id
        ));
        return $req->fetchAll();
    }

    public function DelGroup($id)
    {
        $req = $this->pdo->prepare('DELETE FROM `group` WHERE `group`.`ID` = :id');
        $req->execute(array(
            'id' => $id
        ));
    }

    public function ValideTask($id)
    {
        try {
            $req = $this->pdo->prepare('UPDATE `task` SET `complete` = 1 WHERE `ID` = :id');
            $req->execute(array(
                'id' => $id
            ));
        } catch (PDOException $e) {
            echo "Erreur :" . $e->getMessage();
        }
    }
}
