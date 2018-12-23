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
            case "changeproject":
                include '../changeproject.php';
                break;
            case "addprojectform":
                saveNewProject($path);
                printMessage("38", "saveNewProject word aangeroepen.");
                break;
            case "changeprojectform":
                changeProject($path);
                printMessage("38", "changeProject word aangeroepen.");
                break;
            case "selectprojectform":
                include '../selectprojectinfo.php';
                printMessage("38", "changeProject word aangeroepen.");
                break;
            default:
                break;
        }
        
        
    }

function infoRequest($idName,$path){
    $projectList=array();
    $path = '../'.$path;
    printMessage('bestand controle: ',$path);
    if(file_exists($path)){
        printMessage('58 bestand gevonden: ',$path);
        $projectfile= fopen($path,"r");
        $status= fstat($projectfile);
        $filesize = $status[7];
        if(filesize($path)>0){
            $projectList = json_decode(fread($projectfile, $filesize),true);
            fclose($projectfile);
        }
    }else{printMessage('bestand niet gevonden: ',$path);}
    $alt='';
    $src="";
    $leftBodyContent ='';
    foreach($projectList as $key =>$value){
        printMessage('54', $idName);
        printMessage('55', $key);
        if($key == $idName){
            $alt=$value['sitename'];
            $src=$value['imagelarge'];
            $leftBodyContent ="<h2>Doel</h2><br /><p>".$value['purpose']."</p><h2>CMS</h2><ul>";
            $cmsnamelist = cmslist();        
            foreach($cmsnamelist as $keyname=>$keyvalue){
                if(array_key_exists($keyname, $value)  && $value[$keyname] == 'on'){
                    $leftBodyContent .= "<li>".$keyvalue."</li>";
                }
            }
            $leftBodyContent .="</ul><h2>Tools</h2><ul>";
            $toolsnamelist = toolslist();        
            foreach($toolsnamelist as $keyname=>$keyvalue){
                if(array_key_exists($keyname, $value) && $value[$keyname] == 'on'){
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
    $sitename = $newproject['sitename'];
    $sitename = str_replace(".", "_", str_replace(" ", "_", $sitename));
    $savedProjects = readProjectFormResult($path);
    $savedProjects[$sitename] = $newproject;
    printMessage("115", "saveNewProject is uitgevoerd.");
    saveProjectFormResult($path, $savedProjects);
}
function changeProject($path){
    
    $changeproject = $_POST;
    removeFormItems($_POST);
    removeFormItems($changeproject);
    $passwd = hash("sha256",$changeproject['pwd']);
    $pwcheck = "7bd651dbebf50a13a699f5c994b78d9444815eb5890d639243fda810d161d03c";
    if($passwd == $pwcheck){
        $sideid = $changeproject['request'];
        $Projectslist = readProjectFormResult($path);
        if(array_key_exists($sideid, $Projectslist)){
            foreach($Projectslist[$sideid] as $keyname=>$keyvalue){
                if(array_key_exists($keyname, $changeproject)){
                    $Projectslist[$sideid][$keyname]=$changeproject[$keyname];
                }else{
                    $Projectslist[$sideid][$keyname]='';
                }
            }
        }
        printMessage("115", "changeProject is uitgevoerd.");
        saveProjectFormResult($path, $Projectslist);
    }else{
        echo "U bent niet bevoegd om gegevens aan te passen.";
    }
}
function removeFormItems($array){
        unset($array['pwd']);
        unset($array['submit']);    
}
function saveProjectFormResult($path, $data){
    $projectfile = fopen($path,'w');
    $content = json_encode($data);
    fwrite($projectfile,$content);
    fclose($projectfile);
}
function readProjectFormResult($path){
    $result=array();
    $contenttext='';
    if(file_exists($path)){
        $projectfile= fopen($path,"r");
        $status= fstat($projectfile);
        $filesize = $status[7];
        if(filesize($path)>0){
            $contenttext = fread($projectfile, $filesize);
            $result = json_decode($contenttext, true);
        }
        fclose($projectfile);
    }
    return $result;
}
function selectprojectform(){
    $projectname = $_POST['request'];
    $path="../projectinfo.txt";
    $result=array();
    $contenttext='';
    if(file_exists($path)){
        $projectfile= fopen($path,"r");
        $status= fstat($projectfile);
        $filesize = $status[7];
        if(filesize($path)>0){
            $contenttext = fread($projectfile, $filesize);
            $result = json_decode($contenttext, true);
        }
        fclose($projectfile);
    }
    $result = $result[$projectname];
    $result['sideid'] = $projectname;
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
   // print_r($rownum.": <pre> ".print_r($message,true)."</pre>");
}