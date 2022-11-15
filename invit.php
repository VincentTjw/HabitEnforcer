<?php  

$invit = $_POST["Invit"];
try{
    require 'Config.php';
    $pdo = new PDO(Config::$url, Config::$user, Config::$password); 
    $request = $pdo -> prepare('UPDATE `user` SET Group_Invitation = :ID WHERE ID = :invit');
    $request->execute(array(
        'invit' => $invit,
        'ID' => $_SESSION['ID_Group']
    ));
    $req = $pdo -> prepare('SELECT Pseudo FROM `user` WHERE ID = :invit');
    $req->fetch(); 
    echo $req;
}
catch (PDOException $e){
    echo "Erreur :" . $e->getMessage();
}



header('Location: ./Group.php');

?>