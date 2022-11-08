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



$pdo = new PDO("mysql:host=localhost;dbname=habitenforcer", "VincentYnov", "Ynov");

$searchID = $pdo -> prepare('SELECT ID from `group` where `Name`=:name ');
$searchID = $searchID ->execute(array(
    'name'=>$name
)); 
echo $searchID;
if ($searchID =! NULL){

$request = $pdo -> prepare('UPDATE `user` set ID_Group=:searchID where Email =:Mail');
$request->execute(array(
    'searchID' => $searchID,
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


