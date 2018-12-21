<section class="container">
    <h2>Projecten overzicht</h2>
   <div class="clearfix" >
      <!-- get infofrom projectinfo.txt to create next blocksm-->
      <?php
      include_once 'module/project.php';
      //$projectList = reorderprojects();
        $path = 'projectinfo.txt';
        if(!file_exists($path)){
            $path="../".$path;
        }
        if(file_exists($path)){
            $projectfile= fopen($path,"r");
            $status= fstat($projectfile);
            $filesize = $status[7];
            if(filesize($path)>0){
                $projectList = json_decode(fread($projectfile, $filesize),true);
                fclose($projectfile);
            }
        }
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
        $projectList = $orderedList;
      foreach($projectList as $projectname=>$projectitems){
          $url=$projectitems['url'];
          $imagesmall=$projectitems['imagesmall'];
          $sitename=$projectitems['sitename'];
          $projectid=$projectname;
          $projectbuildblock='<div class="modal-group m-2 float-left projectitem">
        <a href="'.$url.'" target="_blanck">
            <img src="'.$imagesmall.'" alt="'.$sitename.'">
        </a><br />
        <a href="home.php" data-toggle="modal"  onclick="selectblock(\''.$projectid.'\');">Info</a>
    </div>';
          echo $projectbuildblock;
      }
      ?>

   </div>
</section>
