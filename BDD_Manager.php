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
}
?>