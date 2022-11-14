<html>
    <head>
        <title></title>
        <link rel="stylesheet" type="text/css" href="task.css" /> 
        <meta charset="utf-8" />
    </head>
    <body>
        <div id="task-form">
  <h2 class="header">Crée une nouvelle tâche </h2>
  <div>
  <form action="task.php" method="post">
        <p>Tâche à ajouter: <input type="text" name="tache" /></p>
    <label>
<p> Difficulté: <select name="difficultyTask" id="difficultyTask"></p>
    <option value=""></option>
    <option value="1">1 (Facile)</option>
    <option value="2">2 (Moyen)</option>
    <option value="3">3 (Difficile)</option>
</select>
</label>
<label>
<p>Périodicité: <select name="periodicityTask" id="periodicityTask"></p>
    <option value=""></option>
    <option value="Journalière">Journalière</option>
    <option value="Hebdomadaire">Hebdomadaire</option>
</select>
</label>
<p> Couleur: <input type="color" id="colorTask" name="colorTask" value="#E564E7"> </p>
      <button type="submit">Créer</button>
    </form>
  </div>
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
         if($this->content == "" ||  $this->difficulty == "" || $this->color == "" || $this->periodicity == "" ){
            echo '<div class="error-task">' ,'<p>Merci de compléter tout les champs !<p/>' ,'</div>';
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