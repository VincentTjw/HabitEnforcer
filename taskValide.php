<?php
require_once 'Task.php';
Task::Valide($_POST['ID']);
header('Location: ./main.php');
exit;
?>