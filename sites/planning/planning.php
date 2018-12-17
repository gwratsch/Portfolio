<?php
function buildhtml($path){
    $dataArray= readFormResult('planningonderwerpen.txt');
    $content='<section class="formheadsection"><h2>Onderwerpen</h2><form action="home.php" method="post">';
    $counter = 0;
    foreach($dataArray as $groupname=>$subjects){
        $content .= '<section class="formblock"><h2 onclick="hideDisplayInfo('.'\''.$groupname.'\''.');">'.$groupname.'</h2><div id="'.$groupname.'" style="display:block">';
        $groupcontent = groupContent($subjects, $counter, $path);
        $content .= $groupcontent['content'];
        $counter = $groupcontent['counter'];
        $content .= '</div></section>';
    }
    $content .= '<div class="submit"><input type="submit" name="submit"></div>';
    $content .= '</form></section>';
    return $content;
}
function groupContent($subjects, $counter,$path){
    $contentresult='';
    $settings = readFormResult($path);
    foreach($subjects as $objectname=>$objectinfo){
        $checkObject = "";
        if(array_key_exists($objectname,$settings)){
            $checkObject="checked";
        }
        $row = "objectinfo".$counter++;
        $contentresult .= '<input type="checkbox" name="'.$objectname.'" '.$checkObject.'><label onclick="hideDisplayInfo('.'\''.$row.'\''.');">'.$objectname.'</label><br />';
        $contentresult .= '<p id="'.$row.'" style="display:none">'.$objectinfo->subjectinfo.'</p>';
    }
    $result=array(
        "content"=>$contentresult,
        "counter"=>$counter
    );
   return $result;
}

function saveFormResult($path, $data){
    $planningfile= fopen($path,'w');
    $content = json_encode($data);
    fwrite($planningfile,$content);
    fclose($planningfile);
}
function readFormResult($path){
    $result=array();
    if(file_exists($path)){
        $planningfile= fopen($path,"r");
        $contenttext = fread($planningfile, filesize($path));
        $result = json_decode($contenttext);
    }
    return $result;
}

function buildSubjecthtml($path){
    $dataArray= readFormResult($path);
    $content='<section class="formheadsection"><h2>Onderwerpen</h2><form action="onderwerpen.php" method="post" id="mainformblock">';
    $counter = 0;
    $content .='<input type="button" onclick="includeGroup(\'formsectionblock\');" value="Groep toevoegen"><section id="formsectionblock">'; 
    foreach($dataArray as $groupname=>$subjects){
        $row = $counter++;
        $content .= '<section class="formblock"><h2 onclick="hideDisplayInfo('.'\''.$groupname.'\''.');">'.$groupname.'</h2><div id="'.$groupname.'" style="display:block">';
        $content .= '<div class="namefields groupheader"><label>Groepsnaam</label></div><input type="text" name="objectnaam'.$row.'" value="'.$groupname.'" class="groupheader">';
        $groupcontent = groupsubjectContent($subjects, $counter, $path);
        $content .= $groupcontent['content'];
        $counter = $groupcontent['counter'];
        $content .= '</div><input type="button" onclick="includeSubject('.'\''.$groupname.'\''.');" value="Subject toevoegen"></section>';
    }
    $content .= '</section>';
    $content .= '<div class="submit"><input type="submit" name="submit"></div>';
    $content .= '</form></section>';
    return $content;
}
function groupsubjectContent($subjects, $counter,$path){
    $contentresult='';
    $settings = readFormResult($path);
    foreach($subjects as $subjectname=>$subject){
        $rownum = $counter++;
        $row = $rownum;
        $subjectweek = $subject->subjectweek<>"" ?$subject->subjectweek:" ";
        $subjectinfo = $subject->subjectinfo<>"" ?$subject->subjectinfo:" ";
        $contentresult .= '<fieldset><div class="namefields"><label onclick="hideDisplayInfo('.'\''.$row.'\''.');">Naam</label></div><input type="text" name="subjectnaam'.$row.'" value="'.$subjectname.'"><br />';
        $contentresult .= '<div id="'.$row.'" style="display:none"><div class="namefields"><label >Week nummer</label></div><input type="text" name="subjectweek'.$row.'" value="'.$subjectweek.'"><br />';
        $contentresult .= '<div class="namefields"><label >Extra info</label></div><textarea name="subjectinfo'.$row.'" >'.$subjectinfo.'</textarea><br /></div></fieldset>';
    }
    $result=array(
        "content"=>$contentresult,
        "counter"=>$counter
    );
   return $result;
}
function rebuildPost(){
    $postResult=$_POST;
    $result=array();
    $result1=$result2=$result3=$result4='';
    foreach($postResult as $keyname=>$keyvalue){
        $name = preg_replace('/[0-9]+/', '', $keyname);
        switch ($name) {
            case "objectnaam":
                if($result1<>''){
                    $result1=$result2='';
                }
                $result1 = $keyvalue;
                 $result[$keyvalue]= array();
                break;
            case "subjectnaam":
                if($result2<>''){
                    $result2='';
                }
                $result2 = $keyvalue;
                $result[$result1][$keyvalue] =array();
                break;
            case "subjectweek":
                $result[$result1][$result2]['subjectweek'] = $keyvalue;
                break;
            case "subjectinfo":
                $result[$result1][$result2]['subjectinfo'] = $keyvalue;
                break;
            default:
                break;
        }

    }
return $result;
}
function buildweekpagehtml($path){
    $dataArray= dataweekarray(readFormResult('planningonderwerpen.txt'));
    $weeknum=array();
    foreach($dataArray as $weeknumber=>$value){$weeknum[$weeknumber]=$weeknumber;}
    ksort($weeknum);
    $content='<section class="formheadsection"><h2>Week planning</h2><form action="weekplanning.php" method="post">';
    $counter = 0;
    foreach($weeknum as $weeknumber){
        $content .= '<section class="formblock"><h2 onclick="hideDisplayInfo('.'\''.$weeknumber.'\''.');">Week '.$weeknumber.'</h2><div id="'.$weeknumber.'" style="display:block">';
        $groupcontent = groupweekContent($dataArray[$weeknumber], $counter, $path);
        $content .= $groupcontent['content'];
        $counter = $groupcontent['counter'];
        $content .= '</div></section>';
    }
    $content .= '<div class="submit"><input type="submit" name="submit"></div>';
    $content .= '</form></section>';
    return $content;
}
function groupweekContent($subjects, $counter,$path){
    $contentresult='';
    $settings = readFormResult($path);
    foreach($subjects as $objectname=>$objectinfo){
        $checkObject = "";
        if(array_key_exists($objectname,$settings)){
            $checkObject="checked";
        }
        $row = "objectinfo".$counter++;
        $contentresult .= '<input type="checkbox" name="'.$objectname.'" '.$checkObject.'><label onclick="hideDisplayInfo('.'\''.$row.'\''.');">'.$objectname.'</label><br />';
        $contentresult .= '<p id="'.$row.'" style="display:none">'.$objectinfo->subjectinfo.'</p>';
    }
    $result=array(
        "content"=>$contentresult,
        "counter"=>$counter
    );
   return $result;
}
function dataweekarray($data){
    $dataweek = array();
    foreach ($data as $key => $value) {
        foreach($value as $subjectkey=>$subjectcontent){
            $weeknumber = trim($subjectcontent->subjectweek);
            $dataweek[$weeknumber][$subjectkey]=$subjectcontent;
        }
    }
    return $dataweek;
}