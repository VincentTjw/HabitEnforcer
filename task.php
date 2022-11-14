<html>
    <head>
        <title></title>
        <link rel="stylesheet" type="text/css" href="task.css" /> 
        <meta charset="utf-8" />
    </head>
    <body>
    <div class="createTask">
    <form action="task.php" method="post">
        <p>Tâche à ajouter: <input type="text" name="tache" /></p>
<select name="difficultyTask" id="difficultyTask">
    <option value="">--Difficulté--</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
</select>
<p> Couleur: </p>
<input type="color" id="color" name="colorTask" value="#ff0000">
<select name="periodicityTask" id="periodicityTask">
    <option value="">--Périodicité--</option>
    <option value="Journalière">Journalière</option>
    <option value="Hebdomadaire">Hebdomadaire</option>
</select>
        <input type="submit" value="Ajouter">
        </form>
        </div>
<?php
class Task
{
    public $content;
    public $difficulty;
    public $color;
    public $periodicity;

    function __construct($content,$difficulty,$color,$periodicity) {
        $this->content = $content;
        $this->difficulty = $difficulty;
        $this->color = $color;
        $this->periodicity = $periodicity;
    }
    public function createTask() {
    $host = 'localhost';
    $db   = 'habitenforcer';
    $user = 'Esteban';
    $pass = 'Ynov';
    $dsn = "mysql:host=$host;dbname=$db";
         if($this->content == "" ||  $this->difficulty == "" && $this->color == "" || $this->periodicity == "" ){
        echo ("Please complete every field ");
        }else{
    try {
     $pdo = new \PDO($dsn, $user, $pass);
     $request = $pdo -> prepare('INSERT INTO `task` (Name,Difficulties,Color,Periodicity) VALUES (:name,:difficulties,:color,:periodicity)');
    $request->execute(array(
    'name' => $this->content,
    'difficulties' => $this->difficulty,
    'color' => $this->color,
    'periodicity' => $this->periodicity,
    ));
    } catch (\PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    }
}
}
$newTask = new Task($_POST["tache"],$_POST["difficultyTask"],$_POST["colorTask"],$_POST["periodicityTask"]);
$newTask->createTask();
?>
</body>
</html>