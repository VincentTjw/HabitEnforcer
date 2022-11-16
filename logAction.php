<?php
function getUser($email,$dbd)
{
    $req = $dbd->prepare('SELECT * FROM `user` WHERE Email = :email');
    $req->execute(array(
        'email' => $email
    ));
    return $req->fetch();
}

try {
    if (!empty($_POST['type'])) {
        require 'Config.php';
        session_start();
        $dbd = new PDO(Config::$url, Config::$user, Config::$password);
        switch ($_POST['type']) {
            case 'login':
                if (!(empty($_POST['email']) || empty($_POST['password']))) {
                    $user = getUser($_POST['email'],$dbd);
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
                break;
            case 'signup':
                if (!(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['confPassword']))) {
                    $user = getUser($_POST['email'],$dbd);
                    if ($user) {
                        header('Location: log.php?RegisterMessage=Email already used');
                        exit;
                    } else if ($_POST['password'] != $_POST['confPassword']) {
                        header('Location: log.php?RegisterMessage=Passwords are not the same');
                        exit;
                    } else {
                        $password = password_hash($_POST['password'], null);
                        $req = $dbd->prepare('INSERT INTO user (Pseudo, Email, password) VALUES (:name, :email, :password)');
                        $req->execute(array(
                            'name' => $_POST['name'],
                            'email' => $_POST['email'],
                            'password' => $password
                        ));
                        $user = getUser($_POST['email'],$dbd);
                        $_SESSION['ID'] = $user['ID'];
                        header('Location: main.php');
                        exit;
                    }
                } else {
                    header('Location: log.php?RegisterMessage=Please fill all the fields');
                    exit;
                }
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
?>