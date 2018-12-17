<?php
    include_once 'planning.php';
    $path = 'planningformresult.txt';
    if(array_key_exists('submit', $_POST)){
        if($_POST['submit'] == "Verzenden"){
            saveFormResult($path,$_POST);
            $_POST["submit"] = "verwerkt";
        }
    }
?>
<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=devide-width, initial-scale=1.0">
        <title>Studie planning</title>
        <link rel='stylesheet' href="planning.css">
        <script src="planning.js"></script>
    </head>
    <body id="homepage">
        <header class="headerblock">
            <h1>Leerdoel G. Ratsch</h1>
            <img src="gratsch.jpg" alt="Picture G Ratsch">
        </header>
        <?php 
        include 'navigation.php';
        echo  buildhtml($path); ?>
        <footer></footer>
    </body>
</html>
