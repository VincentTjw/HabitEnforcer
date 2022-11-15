<?php

$log = true;

if (!empty($_POST['register'])) {
    $log = false;
}

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
    <div class="pyro">
        <div class="before"></div>
        <div class="after"></div>
    </div>
    <div class="contant">
        <div class="center">
            <div class="changeType">
                <form id="typeform" method="post">
                    <button class="typeButton" type="submit" id="logButton">Log in</button>
                    <button class="typeButton" type="submit" name="register" value="register" id="registerButton">Register</button>
                </form>
            </div>
            <div class="log bloc <?php if (!$log) {
                                        echo 'hidden';
                                    } ?>">
                <form action="logAction.php" method="post" class="formcss">
                    <div class="info">
                        <h1>Log in</h1>
                        <input type="hidden" name="type" value="login">
                        <div>
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email">
                        </div><br>
                        <div>
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password">
                        </div>
                        <?php
                        if (!empty($_GET['LogMessage'])) {
                            echo '<h3 class="err">' . $_GET['LogMessage'] . '</h3>';
                        }
                        ?>
                    </div>
                    <div class="button">
                        <button type="submit">Log in</button>
                    </div>
                </form>
            </div>
            <div class="sign bloc <?php if ($log) {
                                        echo 'hidden';
                                    } ?>">
                <form action="logAction.php" method="post" class="formcss">
                    <div class="info">
                        <h1>Sign up</h1>
                        <input type="hidden" name="type" value="signup">
                        <div>
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name">
                        </div><br>
                        <div>
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email">
                        </div><br>
                        <div>
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password">
                        </div>
                        <div>
                            <label for="password">Confirm Password</label>
                            <input type="password" name="confPassword" id="password">
                        </div>
                        <?php
                        if (!empty($_GET['RegisterMessage'])) {
                            echo '<h3 class="err">' . $_GET['RegisterMessage'] . '</h3>';
                        }
                        ?>
                    </div>
                    <div class="button">
                        <button type="submit">Sign up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>

</html>