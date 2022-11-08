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
    <option value="Faible">Faible</option>
    <option value="Moyen">Moyen</option>
    <option value="Fort">Fort</option>
</select>
<select name="colorTask" id="colorTask">
    <option value="">--Couleur--</option>
    <option value="Bleue">Bleue</option>
    <option value="Rouge">Rouge</option>
    <option value="Vert">Vert</option>
    <option value="Violet">Violet</option>
</select>
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
        echo '<div class="task">'.$this->content, $this->difficulty, $this->color, $this->periodicity.'</div>';
    }
}
$newTask = new Task($_POST["tache"],$_POST["difficultyTask"],$_POST["colorTask"],$_POST["periodicityTask"]);
$newTask->createTask();
?>
</body>
</html>