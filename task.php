<?php
session_start();
class Task
{
    public $content;
    public $difficulty;
    public $color;
    public $periodicity;
    public $complete;
    public $timeValidation;

    function __construct($content, $difficulty, $color, $periodicity, $complete, $timeValidation)
    {
        $this->content = $content;
        $this->difficulty = $difficulty;
        $this->color = $color;
        $this->periodicity = $periodicity;
        $this->complete = $complete;
        $this->timeValidation = $timeValidation;
    }

    public static function Valide($Id)
    {
        require_once 'BDD_Manager.php';
        $bdd = new BDD_Manager();
        $bdd->ValideTask($Id);
    }

    public function createTask()
    {
        if ($this->content == "" ||  $this->difficulty == "" || $this->color == "" || $this->periodicity == "") {
            header('Location: ./Addtask.php');
            exit;
        } else {
            try {
                require_once 'Config.php';
                $pdo = new PDO(Config::$url, Config::$user, Config::$password);
                $request = $pdo->prepare('INSERT INTO `task` (Name,Difficulties,Color,Periodicity,complete,ID_User,timeValidation) VALUES (:name,:difficulties,:color,:periodicity,:complete,:ID_User,:timeValidation)');
                $request->execute(array(
                    'name' => $this->content,
                    'difficulties' => $this->difficulty,
                    'color' => $this->color,
                    'periodicity' => $this->periodicity,
                    'complete' => $this->complete,
                    'ID_User' => $_SESSION['ID'],
                    'timeValidation' => $this->timeValidation
                ));
            } catch (\PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }
    }

    public static function checkTask($id,$idTask)
    {
        try {
            require_once 'Config.php';
            require_once 'score.php';
            $newScore = new Score(); // score instance
            $pdo = new PDO(Config::$url, Config::$user, Config::$password);
            $req = $pdo->prepare("SELECT * FROM task WHERE ID = ?");
            $req->execute(array($idTask));
            $res = $req->fetch();

            $oneDay = date("Y/m/d", strtotime($res['timeValidation']." +1 day"));
            $oneWeek = date("Y/m/d", strtotime($res['timeValidation']." +1 week"));
            $actualDay = date("Y/m/d");

            if (($res['Periodicity'] == "Hebdomadaire" && $actualDay >= $oneWeek) || ($res['Periodicity'] == "Journalière" && $actualDay >= $oneDay)) {
                $newScore->setScore($id,$res['complete'],$res['Difficulties']);
                $request = $pdo->prepare("UPDATE task SET timeValidation = :timeValidation , `complete`='0' WHERE ID = :ID");
                $request->execute(array(
                    "ID" => $idTask,
                    "timeValidation" => $actualDay
                ));
            }
        } catch (\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}
