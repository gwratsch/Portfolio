<?php
include_once 'module/project.php';
$cms=cmslist();
$tools=toolslist();

?>
<section>
<h2>Add new Project</h2>
<br />
<form action="home.php" method="post" class="form-horizontal">
    <input type="hidden" name="namerequest" value="addprojectform">
    <div class="form-group">
    <label>Website naam: </label><input class="form-control" name="sitename" type="text"><br />
    <label>Url : </label><input class="form-control" name="url" type="url"><br />
    <label>Doel : </label><textarea class="form-control" name="purpose"></textarea><br />
    <label>Image klein : </label><input type="text" class="form-control" name="imagesmall"></input><br />
    <label>Image groot : </label><input type="text" class="form-control" name="imagelarge"></input><br />
    </div>
    <div class="form-group form-check">
    <h4>CMS : </h4>
    <?php
        foreach ($cms as $key => $value) {
            echo '<input name="'.$key.'" type="checkbox"><label class="control-label pl-2">'.$value.'</label><br />';
        }
    ?>
    </div>
    <div class="form-group form-check">
    <h4>Tools : </h4>
    <?php
        foreach ($tools as $key => $value) {
            echo '<input name="'.$key.'" type="checkbox"><label class="control-label pl-2">'.$value.'</label><br />';
        }
    ?>
    </div>
    <input name="submit" type="submit">
</form>
</section>

