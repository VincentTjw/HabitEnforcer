<?php



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/log.css">
    <title>Document</title>
</head>
<body>
    <div class="center">
        <div class="log bloc">
            <form action="logAction.php" method="post">
                <div>
                <h1>Log in</h1>
                <input type="hidden" name="type" value="login">
                <label for="email">Email</label><br>
                <input type="email" name="email" id="email"><br>
                <label for="password">Password</label><br>
                <input type="password" name="password" id="password"><br>
                <?php
                    if(!empty($_GET['LogMessage'])){
                        echo '<h3>'.$_GET['LogMessage'].'</h3>';
                    }
                ?>
                </div>
                <div class="button">
                    <button type="submit">Log in</button>
                </div>
            </form>
        </div>
        <div class="sign bloc">
            <form action="logAction.php" method="post">
                <div>
                <h1>Sign up</h1>
                <input type="hidden" name="type" value="signup">
                <label for="name">Name</label><br>
                <input type="text" name="name" id="name"><br>
                <label for="email">Email</label><br>
                <input type="email" name="email" id="email"><br>
                <label for="password">Password</label><br>
                <input type="password" name="password" id="password"><br>
                <?php
                    if(!empty($_GET['RegisterMessage'])){
                        echo '<h3>'.$_GET['RegisterMessage'].'</h3>';
                    }
                ?>
                </div>
                <div class="button">
                    <button type="submit">Sign up</button>
                </div>
            </form>
        </div>
    </div>
    <p>
        <?php
            if(password_verify('tesst',password_hash('test',null))){
                echo 'true';
            }else{
                echo 'false';
            }
        ?>
    </p>
</body>
</html>