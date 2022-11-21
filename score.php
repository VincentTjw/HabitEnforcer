<?php
class Score
{
    public function setScore($id,$state,$diff){
        try {
            require_once 'Config.php';
            $pdo = new PDO(Config::$url, Config::$user, Config::$password);
            $data = $pdo->query("SELECT Score FROM user WHERE ID = '$id'")->fetch();
            $request = $pdo->prepare("UPDATE user SET Score = :Score WHERE ID = '$id'");
            switch ($diff){
                case 1:
                    $point = 10;
                    break;
                case 2:
                    $point = 20;
                    break;
                case 3:
                    $point = 30;
                    break;
                default:
                    $point = 0;
                    break;
            }
            if ($state == 0){
                $point -= 40;
            }
            $request->execute(array(
                'Score' => $data['Score'] + $point
            ));
        } catch (\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}
