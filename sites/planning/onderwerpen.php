<?php
    include_once 'planning.php';
    $path = 'planningonderwerpen.txt';
    if(array_key_exists('submit', $_POST)){
        if($_POST['submit'] == "Verzenden"){
            saveFormResult($path, rebuildPost($_POST));
            $_POST["submit"] = "verwerkt";
        }
    }
    //var_dump($_POST);
?>
<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Studie planning</title>
        <link rel='stylesheet' href="planning.css">
        <script src="planning.js"></script>
    </head>
    <body>
        <header class="headerblock">
            <h1>Onderwerpen beheer</h1>
            <img src="gratsch.jpg" alt="Picture G Ratsch">
        </header>
        <?php 
        include 'navigation.php';
        echo  buildSubjecthtml($path); ?>
        <footer></footer>
    </body>
</html>
