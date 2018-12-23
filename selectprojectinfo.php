<?php
include_once 'project.php';
$projectinfo = selectprojectform();
$cms=cmslist();
$tools=toolslist();
?>
<form action="home.php" method="post" class="form-horizontal">
    <input type="hidden" name="namerequest" value="changeprojectform">
    <input type="hidden" name="request" value="<?php echo $projectinfo['sideid'];?>">
    <div class="form-group">
    <label>Website naam: </label><input id="sitename" class="form-control" name="sitename" type="text" value="<?php echo $projectinfo['sitename'];?>"><br />
    <label>Url : </label><input id="url" class="form-control" name="url" type="url" value="<?php echo $projectinfo['url'];?>"><br />
    <label>Doel : </label><textarea id="purpose" class="form-control" name="purpose" value=""><?php echo $projectinfo['purpose'];?></textarea><br />
    <label>Image klein : </label><input id="imagesmall" type="text" class="form-control" name="imagesmall" value="<?php echo $projectinfo['imagesmall'];?>"></input><br />
    <label>Image groot : </label><input id="imagelarge" type="text" class="form-control" name="imagelarge" value="<?php echo $projectinfo['imagelarge'];?>"></input><br />
    </div>
    <div class="form-group form-check">
    <h4>CMS : </h4>
    <?php
        foreach ($cms as $key => $value) {
            $objectselected = "";
            if(array_key_exists($key, $projectinfo)){
                $selectStatus = $projectinfo[$key];
                if($selectStatus == 'on'){$objectselected = "checked";}
            }
            echo '<input id="'.$value.'" name="'.$key.'" type="checkbox" '.$objectselected.'><label class="control-label pl-2">'.$value.'</label><br />';
        }
    ?>
    </div>
    <div class="form-group form-check">
    <h4>Tools : </h4>
    <?php
        foreach ($tools as $key => $value) {
            $objectselected = "";
            if(array_key_exists($key, $projectinfo)){
                $selectStatus = $projectinfo[$key];
                if($selectStatus == 'on'){$objectselected = "checked";}
            }
            echo '<input id="'.$value.'" name="'.$key.'" type="checkbox" '.$objectselected.'><label class="control-label pl-2">'.$value.'</label><br />';
        }
    ?>
    </div>Password : </label><input class="form-control" type="password" name="pwd" required></input><br />
    <input name="submit" type="submit">
</form>
