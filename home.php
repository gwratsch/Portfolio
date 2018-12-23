<?php
if(array_key_exists("namerequest", $_POST)){
        require_once 'module/project.php';
        if($_POST['namerequest'] == "addproject" || $_POST['namerequest'] == "addhome" || $_POST['namerequest'] == "changeproject" ){
            $idName = $_POST['request'];
            $path="projectinfo.txt";
            infoRequest($idName, $path);
        }
    }
?>
<!DOCTYPE html>
<html lang="nl">
    <?php
    include 'head.php';
    ?>
    <body contenteditable="false">
        <?php
            include 'header.php';
            include 'navigation.php';
            include 'section.php';
            include 'footer.php';
        ?>
    </body>
</html>
