<?php
try {
    require 'Config.php';
    $pdo = new PDO(Config::$url, Config::$user, Config::$password);
    $req = $pdo->prepare("SELECT complete FROM task WHERE ID = ?");
    $req -> execute(array($_POST['check']));
    $res = $req-> fetch();
    if ($res["complete"] == 0){
            $request = $pdo -> prepare("UPDATE task SET complete = :complete WHERE ID = :ID");
            $request->execute(array(
                "ID" => $_POST['check'],
                "complete"=> 1
            ));
        }else{
            $request = $pdo -> prepare("UPDATE task SET complete = :complete WHERE ID = :ID");
            $request->execute(array(
                "ID" => $_POST['check'],
                "complete"=> 0
            ));
    }
    header("Location: main.php");
    exit;


} catch (\PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>