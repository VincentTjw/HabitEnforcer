<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<div class = "container">
    <h1>Créer un groupe !</h1>
    <form action="insertGroup.php" method= "post">
        <div class = 'create-group'>
            <label for="Name">Name</label><br>
            <input type="text" name ='Name'><br>
            <label for="mdp"> Quel mot de passe voulez vous donner?</label><br>
            <input type="text" name = 'mdp'>
        </div>
        <input type="submit" value='OK'>
    </form>

    <h1>Rejoindre un groupe !</h1>
    <form action="joinGroup.php" method="post">
    <div class = 'join-group'>
        <label for="Mail">Quel est votre adresse mail ? <br></label>
        <input type="email" name = 'Mail'><br>
        <label for="Name">Quel est le nom du groupe que vous voulez rejoindre ?<br></label>
        <input type="text" name ='Name'><br>
        <label for="text" name='Mdp'>Quel est le code ?</label><br>
        <input type="text" name ='Mdp'>
    </div>
    <input type="submit" value ='OK'>
    </form>

</div>
</body>
</html>

