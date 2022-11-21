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
  <form action="AddtaskAction.php" method="post">
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
</body>
</html>