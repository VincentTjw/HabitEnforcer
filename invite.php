<?php
class invite
{
    private $pdo;

    public function __construct()
    {
        session_start();
        require 'Config.php';
        $this->pdo = new PDO(Config::$url, Config::$user, Config::$password);
        $this->InviteUser($_POST['email']);
        header('Location: main.php');
        exit;
    }

    private function GetUserByEmail($email)
    {
        return $this->pdo->query("SELECT * FROM `user` WHERE `Email` = '$email'")->fetchAll()[0];
    }

    private function GetGroupByID($id)
    {
        return $this->pdo->query("SELECT `ID_Group` FROM `user` WHERE `ID` = '$id'")->fetchAll()[0]['ID_Group'];
    }

    private function InviteUser($email)
    {
        $data = $this->GetUserByEmail($email);
        $idGroup = $this->GetGroupByID($_SESSION['ID']);
        if ($data && $idGroup && !in_array($idGroup, explode(' ', $data['Group_Invitation']))) {
                $req = $this->pdo->prepare("UPDATE `user` SET `Group_Invitation` = :Group_Invitation WHERE `Email` = '$email'");
            $req->execute(array(
                'Group_Invitation' => $data['Group_Invitation'] . ' ' . $idGroup
            ));
        }
    }
}
new invite();
?>
