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
                    <label for="Mail">Quel est votre adresse mail ? <br></label>
                    <input type="email" name='Mail'><br>
                    <label for="Name">Quel est le nom du groupe que vous voulez rejoindre ?<br></label>
                    <input type="text" name='Name'><br>
                    <label for="text" name='Mdp'>Quel est le mot de passe ?</label><br>
                    <input type="password" name='Mdp'>
                </div>
                <input type="submit" value='OK'>
            </form>
        </div>



    </div>
</body>

</html>