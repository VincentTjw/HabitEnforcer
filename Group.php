<?php
    session_start();
    if (empty($_SESSION['ID'])) {
        header('Location: log.php');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Groupe</title>
    <link rel="stylesheet" href="./css/group.css">
</head>

<body>

    <div class="container">
        <div class='cardMain'>
            <img src="./img/Kittytude_logo.png" alt="KittyLogo">
        </div>
        <div class='cardLeft'>
            <h1>Créer un groupe !</h1>
            <form action="insertGroup.php" method="post">
                <div class='create-group'>
                    <label for="Name">Name</label><br>
                    <input type="text" name='Name' required><br>
                    <label for="mdp"> Quel mot de passe voulez vous donner?</label><br>
                    <input type="password" name='mdp' required> <br>
                    <label for="mdpVerify">Confirmer le mot de passe</label> <br>
                    <input type="password" name='mdpverif' required>
                </div>
                <input type="submit" value='OK'>
            </form>
        </div>
        <div class='cardRight'>
            <h1>Rejoindre un groupe !</h1>
            <form action="joinGroup.php" method="post">
                <div class='join-group'>
                    <label for="Name">Quel est le nom du groupe que vous voulez rejoindre ?<br></label>
                    <input type="text" name='Name'><br>
                    <label for="text" name='Mdp'>Quel est le mot de passe ?</label><br>
                    <input type="password" name='Mdp'> <br>
           
               
                <input type="submit" value='OK'>
            
        </div>
        <div class='cardInvit'>
       <h1> Invitation !</h1>
            <?php
             require 'Config.php';
             $pdo = new PDO(Config::$url, Config::$user, Config::$password);
             $request = $pdo -> prepare('SELECT Group_Invitation FROM `user` WHERE ID = :id');
             $request -> execute(array('id' => $_SESSION['ID']));
             $seq = $request -> fetch();
                if ($seq['Group_Invitation'] != ""){
                    echo "Vous avez une invitation ! <br>";
                    
                }
                else{
                    echo "Vous n'avez pas d'invitation";
                }
          

             $list = explode(" ", $seq['Group_Invitation']);
             for ($i = 0; $i < count($list); $i++) { ?>
                <tr>
                    <td></td>
                    <td>
                <?php
                 $group = $pdo -> prepare('SELECT Name FROM `group` WHERE ID = :id');
                    $group -> execute(array('id' => $list[$i]));
                    $name = $group -> fetch();
                    echo $name['Name'];
                 
                 ?>
                 </td>
                 <td>  
                    <form action="invitValid.php" method = "POST">
               
                    <button type="submit" value="<?php echo $list[$i]; ?>" name = "valid"> Valider </button>
                    </form>
                    
                 </td>
                 <td>
                 <form action="invitRefus.php" method = "POST">
               
               <button type="submit" value="<?php echo $list[$i]; ?>" name = "refus"> Refuser </button>
               </form>
                    <?php
                     "<br>";
                    ?>
                 </td>
                 </tr>
                 <?php
             }
            ?>

</div>
    </div>
</body>

</html>