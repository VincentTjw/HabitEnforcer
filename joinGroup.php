<!DOCTYPE html>

    <?php
$name = strtoupper($_POST["Name"]);
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
session_start();
$request = $pdo -> prepare('UPDATE `user` set ID_Group=:searchID where ID =:ID');

$request->execute(array(
    'searchID' => $searchID['ID'],
    'ID' => $_SESSION['ID']
));
}
}
catch (PDOException $e){
    echo "Erreur :" . $e->getMessage();

}

header('Location: ./main.php');
exit;
?>

