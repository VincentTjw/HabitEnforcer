<?php


$name = $_POST["Name"];
$mdp = $_POST["mdp"];
try{

    $pdo = new PDO("mysql:host=localhost;dbname=habitenforcer", "VincentYnov", "Ynov");
    
if ($name != NULL){
    $verify = $pdo -> prepare("SELECT * FROM `group` WHERE `Name` = ?");
   $verify -> execute (array ($name));
   $result = $verify -> rowCount();
   var_dump($result);
    if ($result ==1) {
        echo 'Nom du groupe déjà utilisé, veuillez réessayer';
        ?>
        <input type="submit" value ='Retour'>
        <?php
    }
else {
$request = $pdo -> prepare('INSERT INTO `group` (Name,mdp) VALUES (:name,:mdp)');

$request->execute(array(
    'name' => $name,
    'mdp' => $mdp
));
}   
}}
catch (PDOException $e){
    echo "Erreur :" . $e->getMessage();

}


?>