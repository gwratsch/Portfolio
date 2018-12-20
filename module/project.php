<?php
function cmslist(){
    $cms=array(
        "drupal7"=>"Drupal 7",
        "drupal8"=>"Drupal 8",
        "laravel"=>"Laravel",
        "symphony"=>"Symphony"
    );
    return $cms;
}
function toolslist(){
    $tools=array(
        "html"=>"HTML5",
        "css"=>"CSS3",
        "javascript"=>"Javascript",
        "php"=>"PHP",
        "ajax"=>"Ajax",
        "bootstrap"=>"Bootstrap",
        "git"=>"Git"
    );
    return $tools;
}
if(array_key_exists("namerequest", $_POST)){
       // require_once 'modules/project.php';
        $namerequest = $_POST['namerequest'];
        
        $path="projectinfo.txt";
        switch ($namerequest) {
            case "displayblock":
                $idName = $_POST['request'];
                infoRequest($idName,$path);
                break;
            case "addproject":
                include '../addproject.php';
                break;
            case "addhome":
                include '../section.php';
                break;
            case "addprojectform":
                saveNewProject($path);
                printMessage("38", "saveNewProject word aangeroepen.");
                break;
            default:
                break;
        }
        
        
    }

function infoRequest($idName,$path){
    $projectList = readProjectFormResult($path);
    $alt='';
    $src="";
    $leftBodyContent ='';
    printMessage('51', $projectList);
    foreach($projectList as $key =>$value){
        printMessage('54', $idName);
        printMessage('55', $key);
        if($key == $idName){
            $alt=$value['sitename'];
            $src=$value['imagelarge'];
            $leftBodyContent ="<h2>Doel</h2><br /><p>".$value['purpose']."</p><h2>CMS</h2><ul>";
            $cmsnamelist = cmslist();        
            foreach($cmsnamelist as $keyname=>$keyvalue){
                if(array_key_exists($keyname, $value)){
                    $leftBodyContent .= "<li>".$keyvalue."</li>";
                }
            }
            $leftBodyContent .="</ul><h2>Tools</h2><ul>";
            $toolsnamelist = toolslist();        
            foreach($toolsnamelist as $keyname=>$keyvalue){
                if(array_key_exists($keyname, $value)){
                    $leftBodyContent .= "<li>".$keyvalue."</li>";
                }
            }
            $leftBodyContent .="</ul>Url: <a href='".$value["url"]."'>".$value["url"]."</a>";
        }
    } 
    $info = '<div class="modal-header">
                <h2 class="modal-title">'.$alt.'</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                <div class="col-sm-6">
                    <img id="'.$idName.'" class="largeimage" src="'.$src.'" alt="'.$alt.'">
                </div>
                <div class="col-sm-6">
                    '.$leftBodyContent.'
                </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>';
echo $info;
}
function saveNewProject($path){
    $newproject = $_POST;
    //foreach ($_POST as $key => $value) {
    //    $newproject[$key]=$value;
    //}
    $sitename = $newproject['sitename'];
    $sitename = str_replace(".", "_", str_replace(" ", "_", $sitename));
    $savedProjects = readProjectFormResult($path);
    $savedProjects[$sitename] = $newproject;
    printMessage("115", "saveNewProject is uitgevoerd.");
    saveProjectFormResult($path, $savedProjects);
}

function saveProjectFormResult($path, $data){
    $projectfile = fopen($path,'w');
    $content = json_encode($data);
    fwrite($projectfile,$content);
    fclose($projectfile);
}
function readProjectFormResult($path){
    $result=array();
    if(file_exists($path)){
        $projectfile= fopen($path,"r");
        if(filesize($path)>0){
            $contenttext = fread($projectfile, filesize($path));
            $result = json_decode($contenttext, true);
        }
        printMessage('130', $contenttext);
    }
    return $result;
}
function reorderprojects(){
    $path="projectinfo.txt";
    $projectList = readProjectFormResult($path);
    $sortlist= $orderedList =array();
    foreach ($projectList as $key => $value) {
        $sortlist[]= array(
            $key=>$value
        );
    }
    krsort($sortlist);
    foreach($sortlist as $key => $value){
        foreach ($value as $projectname => $projectitems) {
            $orderedList[$projectname] = $projectitems;
        }
    }
    return $orderedList;
}
function printMessage($rownum, $message){
    //print_r("<pre> ".$rownum.": ".print_r($message,true)."</pre>");
}