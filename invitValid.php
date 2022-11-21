<?php  

session_start();
$valid = $_POST["valid"];

try{
    require 'Config.php';
    $pdo = new PDO(Config::$url, Config::$user, Config::$password); 
    $request = $pdo -> prepare('SELECT Group_Invitation FROM `user` WHERE ID = :id');
    $request->execute(array(
        'id' => $_SESSION['ID'],
    ));
    $search = $request->fetch();
    $list = explode(" ", $search['Group_Invitation']);
   
   if ($list != NULL){
    $list = array_diff($list, array($valid));
    $new = implode(" ", $list);
    $request = $pdo -> prepare("UPDATE `user` SET ID_Group = :ID_gr, Group_Invitation = :ID_inv WHERE ID = :id");
    $request->execute(array(
        'id' => $_SESSION['ID'],   
        'ID_gr' => $valid,
        'ID_inv' => $new

    ));
    header('Location: ./main.php');
    exit;
}
}
catch (PDOException $e){
    echo "Erreur :" . $e->getMessage();
}





?>