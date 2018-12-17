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
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Week planning</title>
        <link rel='stylesheet' href="planning.css">
        <script src="planning.js"></script>
    </head>
    <body id="weeklyplanning">
        <header class="headerblock">
            <h1>Week Planning</h1>
            <img src="gratsch.jpg" alt="Picture G Ratsch">
        </header>

        <?php 
        include 'navigation.php';
        echo  buildweekpagehtml($path); ?>
        <footer></footer>
    </body>
</html>
