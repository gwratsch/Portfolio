<section class="container">
    <h2>Projecten overzicht</h2>
   <div class="clearfix" >
      <!-- get infofrom projectinfo.txt to create next blocksm-->
      <?php
      include_once 'module/project.php';
      $projectList = reorderprojects();
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
