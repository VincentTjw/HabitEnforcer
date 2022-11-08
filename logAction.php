<?php
function getUser($email,$dbd)
{
    $req = $dbd->prepare('SELECT * FROM `user` WHERE Email = :email');
    $req->execute(array(
        'email' => $email
    ));
    return $req->fetch();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>you never seen this message</h1>
    <h3>
        <?php
        try {
            if (!empty($_POST['type'])) {
                require 'Config.php';
                $dbd = new PDO(Config::$url, Config::$user, Config::$password);
                switch ($_POST['type']) {
                    case 'login':
                        if (!(empty($_POST['email']) || empty($_POST['password']))) {
                            $user = getUser($_POST['email'],$dbd);
                            if ($user) {
                                if (password_verify($_POST['password'], $user['Password'])) {
                                    $_SESSION['email'] = $user['email'];
                                    header('Location: index.php');
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
                        if (!(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password']))) {
                            $user = getUser($_POST['email'],$dbd);
                            if ($user) {
                                header('Location: log.php?RegisterMessage=Email already used');
                                exit;
                            } else {
                                $password = password_hash($_POST['password'], null);
                                $req = $dbd->prepare('INSERT INTO user (Pseudo, Email, password) VALUES (:name, :email, :password)');
                                $req->execute(array(
                                    'name' => $_POST['name'],
                                    'email' => $_POST['email'],
                                    'password' => $password
                                ));
                                $_SESSION['email'] = $_POST['email'];
                                header('Location: index.php');
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
            echo 'err :';
            echo $e->getMessage();
        }
        ?>
    </h3>
</body>

</html>