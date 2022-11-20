<?php
session_start();
$refus = $_POST["refus"];


try{
    echo $refus;
    require 'Config.php';
    $pdo = new PDO(Config::$url, Config::$user, Config::$password); 
    $request = $pdo -> prepare('SELECT Group_Invitation FROM `user` WHERE ID = :id');
    $request->execute(array(
        'id' => $_SESSION['ID'],
    ));
    $search = $request->fetch();
    $list = explode(" ", $search['Group_Invitation']);
    unset($list[$refus]);
    $new = implode(" ", $list);
    $request = $pdo -> prepare('UPDATE `user` SET Group_Invitation = :ID_inv WHERE ID = :id');
    $request->execute(array(
        'id' => $_SESSION['ID'],
        'ID_inv' => $new
    ));

    header('Location: ./Group.php'); 
}
catch (PDOException $e){
    echo "Erreur :" . $e->getMessage();
}
