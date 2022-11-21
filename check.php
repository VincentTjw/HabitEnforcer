<?php
class checkTask
{
    public $dataBaseTime;
    public $oneDay;
    public $oneWeek;
    public $actualDay;

    function __construct($dataBaseTime, $oneDay, $oneWeek, $actualDay)
    {
        $this->dataBaseTime = $dataBaseTime;
        $this->$oneDay = $oneDay;
        $this->$oneWeek = $oneWeek;
        $this->$actualDay = $actualDay;
    }
    public function checkTask()
    {
        try {
            require_once 'Config.php';
            require_once 'score.php';
            $newScore = new Score(); // score instance
            $pdo = new PDO(Config::$url, Config::$user, Config::$password);
            $req = $pdo->prepare("SELECT * FROM task WHERE ID = ?");
            $req->execute(array($_POST['check']));
            $res = $req->fetch();
            if ($res['Periodicity'] == "Hebdomadaire" && $actualDay > $oneWeek) {
                $newScore->setScore();
                echo("2");
                $request = $pdo->prepare("UPDATE task SET timeValidation = :timeValidation WHERE ID = :ID");
                $request->execute(array(
                    "ID" => $_POST['check'],
                    "timeValidation" => date("Y/m/d")
                ));
            }
            if ($res['Periodicity'] == "Journalière" && $actualDay > $oneDay) {
                $newScore->setScore();
                $request = $pdo->prepare("UPDATE task SET timeValidation = :timeValidation WHERE ID = :ID");
                $request->execute(array(
                    "ID" => $_POST['check'],
                    "timeValidation" => date("Y/m/d")
                ));
            }
        } catch (\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}
$checkTask = new checkTask($res['timeValidation'], date("Y/m/d", strtotime("$dataBaseTime +1 day")), date("Y/m/d", strtotime("$dataBaseTime +1 week")), date("Y/m/d", strtotime("$dataBaseTime +2 week")));
$checkTask->checkTask();
// header("Location: main.php");
// exit;
