<?php
require 'BDD_Manager.php';

class logAction{

    private $bdd;

    public function __construct(){
        $this->bdd = new BDD_Manager();
        try {
            if (!empty($_POST['type'])) {
                session_start();
                switch ($_POST['type']) {
                    case 'login':
                        $this->login();
                        break;
                    case 'signup':
                        $this->register();
                        break;
                    default:
                        header('Location: error_500.html');
                        exit;
                }
            } else {
                header('Location: error_500.html');
                exit;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    private function login(){
        if (!(empty($_POST['email']) || empty($_POST['password']))) {
            $user = $this->bdd->getUserByEmail($_POST['email']);
            if ($user) {
                if (password_verify($_POST['password'], $user['Password'])) {
                    $_SESSION['ID'] = $user['ID'];
                    header('Location: main.php');
                    exit;
                } else {
                    header('Location: log.php?LogMessage=Wrong password');
                    exit;
                }
            } else {
                header('Location: log.php?LogMessage=Wrong email');
                exit;
            }
        } else {
            header('Location: log.php?LogMessage=Please fill all the fields');
            exit;
        }
    }

    private function register(){
        if (!(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['confPassword']))) {
            $user = $this->bdd->getUserByEmail($_POST['email']);
            if ($user) {
                header('Location: log.php?RegisterMessage=Email already used');
                exit;
            } else if ($_POST['password'] != $_POST['confPassword']) {
                header('Location: log.php?RegisterMessage=Passwords are not the same');
                exit;
            } else {
                $password = password_hash($_POST['password'], null);
                $req = $this->bdd->pdo->prepare('INSERT INTO user (Pseudo, Email, password) VALUES (:name, :email, :password)');
                $req->execute(array(
                    'name' => $_POST['name'],
                    'email' => $_POST['email'],
                    'password' => $password
                ));
                $user = $this->bdd->getUserByEmail($_POST['email']);
                $_SESSION['ID'] = $user['ID'];
                header('Location: main.php');
                exit;
            }
        } else {
            header('Location: log.php?RegisterMessage=Please fill all the fields');
            exit;
        }
    }
}

new logAction();
?>