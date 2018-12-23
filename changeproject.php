<?php
include_once 'module/project.php';
$cms=cmslist();
$tools=toolslist();
$projectlist=array();
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
    $sortlist= $orderedList =array();
    foreach ($result as $key => $value) {
        $sortlist[]= array(
            $key=>$value
        );
    }
    krsort($sortlist);
    foreach($sortlist as $key => $value){
        foreach ($value as $projectname => $projectitems) {
            $projectlist[$projectname] = $projectitems;
        }
    }
$buildprojectlist='<ul>';
foreach($projectlist as $projectkey=>$projectinfo){
    $buildprojectlist .= '<li><a href="#" onclick="selectprojext(\''.$projectkey.'\');">'.$projectinfo['sitename'].'</a></li>';
}
$buildprojectlist .='</ul>';
?>
<section>
<h2>Change Project</h2>
<br />
<h3>Select a project</h3>
<?php
echo $buildprojectlist;
?>
<form action="home.php" method="post" class="form-horizontal">

</form>
</section>

