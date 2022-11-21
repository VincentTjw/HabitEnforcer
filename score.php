<?php
class Score
{
    public function setScore(){
        try {
            require_once 'Config.php';
            require_once 'check.php';
            $points = 0;
            $pdo = new PDO(Config::$url, Config::$user, Config::$password);
            $data = $pdo->query("SELECT Score FROM user")->fetch();
            $request = $pdo->prepare("UPDATE user SET Score = :Score");
            echo ($data['Score']);
            if ($res['Difficulties'] == 1){
                $points = 10;
                } elseif ($res['Difficulties'] == 2){
                $points = 20;
                } elseif ($res['Difficulties'] == 3)
                $points = 30;
            $request->execute(array(
                "Score" => $data['Score'] + $points
            ));
        } catch (\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}
