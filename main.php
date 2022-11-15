<html>
    <head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="main.css" /> 
        <meta charset="utf-8" />
        <form action="main.php" method="post">
    <?php
class displayData {
    public function displayTask(){
        $host = 'localhost';
        $db   = 'habitenforcer';
        $user = 'Esteban';
        $pass = 'Ynov';
        $dsn = "mysql:host=$host;dbname=$db";
        try {
            $pdo = new \PDO($dsn, $user, $pass);
            $data = $pdo->query("SELECT * FROM task")->fetchAll();
            foreach ($data as $row) {
                if ($row['Periodicity'] == "Hebdomadaire" && $row['complete'] != 1){
                echo '<div class="task-hebdo">'.$row['Name'].'<br>', $row['Difficulties']. '<br>', '<div class="task-color" style="background-color:'.$row['Color'].';">',  '</div>', '<br>', $row['Periodicity']. '<br>','<button type="submit" name="check'.$row['ID'].'" value=1 />Validé la tâche','</div>';
                }else{
                echo '<div class="task-dayli">'.$row['Name'].'<br>', $row['Difficulties']. '<br>', '<div class="task-color" style="background-color:'.$row['Color'].';">',  '</div>','<br>', $row['Periodicity']. '<br>','<button type="submit" name="check'.$row['ID'].'" value=1 />Validé la tâche','</div>';
                }
            }
              }catch (\PDOException $e) {
               echo "Connection failed: " . $e->getMessage();
           }
           }
}
/*class checkTask{
    function __construct($complete) {
        $this->complete = $complete;
    }
    public function checkTask(){
        $host = 'localhost';
        $db   = 'habitenforcer';
        $user = 'Esteban';
        $pass = 'Ynov';
        $dsn = "mysql:host=$host;dbname=$db";
        try {
            $pdo = new \PDO($dsn, $user, $pass);
            $request = $pdo -> prepare('INSERT INTO `task` (complete) VALUES (:complete)');
           $request->execute(array(
           'complete' => $this->complete,
           ));
           } catch (\PDOException $e) {
               echo "Connection failed: " . $e->getMessage();
           }
    }
}*/
//$checkTask = new checkTask($_POST[""])
$displayInfo = new displayData();
$displayInfo->displayTask();
    ?>
    </form>
    </body>
    </html>