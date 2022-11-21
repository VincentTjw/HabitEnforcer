<html>
    <head>
        <title></title>
        <link rel="stylesheet" type="text/css" href="./css/task.css" /> 
        <meta charset="utf-8" />
    </head>
    <body>
    <form action="main.php" method="post">
        <div id="home">
        <button type="submit">Home</button>
        </div>
</form>
        <div id="task-form">
  <h2 class="header">Crée une nouvelle tâche </h2>
  <div>
  <form action="task.php" method="post">
        <p>Tâche à ajouter: <input type="text" name="tache" /></p>
    <label>
<p> Difficulté: <select name="difficultyTask" id="difficultyTask"></p>
    <option value=""></option>
    <option value="1">Kitty (Facile)</option>
    <option value="2">Kat (Moyen)</option>
    <option value="3">Kitue (Difficile)</option>
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
session_start();
class Task
{
    public $content;
    public $difficulty;
    public $color;
    public $periodicity;
    public $complete;
    public $timeValidation;

    function __construct($content,$difficulty,$color,$periodicity,$complete,$timeValidation) {
        $this->content = $content;
        $this->difficulty = $difficulty;
        $this->color = $color;
        $this->periodicity = $periodicity;
        $this->complete = $complete;
        $this->timeValidation = $timeValidation; 
    }
    public function createTask() {
         if($this->content == "" ||  $this->difficulty == "" || $this->color == "" || $this->periodicity == "" ){
            echo '<div class="error-task">' ,'<p>Merci de compléter tout les champs !<p/>' ,'</div>';
        }else{
    try {
        require 'Config.php';
     $pdo = new PDO(Config::$url, Config::$user, Config::$password);
     $request = $pdo -> prepare('INSERT INTO `task` (Name,Difficulties,Color,Periodicity,complete,ID_User,timeValidation) VALUES (:name,:difficulties,:color,:periodicity,:complete,:ID_User,:timeValidation)');
    $request->execute(array(
    'name' => $this->content,
    'difficulties' => $this->difficulty,
    'color' => $this->color,
    'periodicity' => $this->periodicity,
    'complete' => $this->complete,
    'ID_User' => $_SESSION['ID'],
    'timeValidation' => $this->timeValidation
    ));
    header('Location: main.php');
    exit;
    } catch (\PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    }
}
}
$newTask = new Task($_POST["tache"],$_POST["difficultyTask"],$_POST["colorTask"],$_POST["periodicityTask"],0,date("Y/m/d"));
$newTask->createTask();
?>
</body>
</html>