<?php


$name = $_POST["Name"];
$mdp = $_POST["mdp"];
try{


if ($name != NULL){
$pdo = new PDO("mysql:host=localhost;dbname=habitenforcer", "VincentYnov", "Ynov");

$request = $pdo -> prepare('INSERT INTO `group` (Name,mdp) VALUES (:name,:mdp)');

$request->execute(array(
    'name' => $name,
    'mdp' => $mdp
));
}   
}
catch (PDOException $e){
    echo "Erreur :" . $e->getMessage();

}
?>