<?php
$faux =0;

$name = strtoupper($_POST["Name"]);
$mdp = $_POST["mdp"];
$mdpverif = $_POST["mdpverif"];
try{
    require 'Config.php';
    $pdo = new PDO(Config::$url, Config::$user, Config::$password);
    
if ($name != NULL){
    $verify = $pdo -> prepare("SELECT * FROM `group` WHERE `Name` = ?");
   $verify -> execute (array ($name));
   $result = $verify -> rowCount();
   var_dump($result);
    if ($result ==1) {
        $same = 1;
        header ('Location: ./Group.php?same='.$same);
        exit;
        ?>
<input type="submit" value='Retour'>
<?php
    }
else {
    if($mdp == $mdpverif){ 

    $request = $pdo -> prepare('INSERT INTO `group` (Name,mdp) VALUES (:name,:mdp)');

    $request->execute(array(
     'name' => $name,
     'mdp' => $mdp
));
header('Location: ./main.php');
exit;
    }
    else{
        $faux = 1;
        header ('Location: ./Group.php?mdpF='.$faux);
        exit;

    }
}   }
}
catch (PDOException $e){
    echo "Erreur :" . $e->getMessage();

}




?>