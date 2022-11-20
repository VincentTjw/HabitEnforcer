<?php  

session_start();
$valid = $_POST["valid"];
$val = (int)$valid;
try{
    echo $val;
    require 'Config.php';
    $pdo = new PDO(Config::$url, Config::$user, Config::$password); 
    $request = $pdo -> prepare("UPDATE `user` SET Group_Invitation = :ID_inv, ID_Group = ID_gr WHERE ID = :id");
    $request->execute(array(
        'id' => $_SESSION['ID'],
        'ID_inv' => "",
        'ID_gr' => $val
    ));
    header('Location: ./main.php');
}
catch (PDOException $e){
    echo "Erreur :" . $e->getMessage();
}





?>