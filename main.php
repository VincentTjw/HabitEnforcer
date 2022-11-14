<html>
    <head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="task.css" /> 
        <meta charset="utf-8" />
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
                echo '<div class="task">'.$row['Name'].'<br>', $row['Difficulties']. '<br>', $row['Color']. '<br>', $row['Periodicity'].'</div>';
            }
              }catch (\PDOException $e) {
               echo "Connection failed: " . $e->getMessage();
           }
           }
}
$displayInfo = new displayData();
$displayInfo->displayTask();
    ?>
    </body>
    </html>