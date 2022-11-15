<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
$name = $_POST["Name"];
$mail = $_POST["Mail"];
$mdp = $_POST["Mdp"];
try{


    require 'Config.php';
$pdo = new PDO(Config::$url, Config::$user, Config::$password);

$req = $pdo -> prepare('SELECT ID from `group` where `Name`= :name ');
$req ->execute(array(
    'name'=>$name
));
$searchID = $req->fetch(); 
        
if ($searchID != NULL){

$request = $pdo -> prepare('UPDATE `user` set ID_Group=:searchID where Email =:Mail');

$request->execute(array(
    'searchID' => $searchID['ID'],
    'Mail' => $mail
));
}
}
catch (PDOException $e){
    echo "Erreur :" . $e->getMessage();

}
?>
</body>
</html>

<?php


