<?php
    $news->sort_by($app::$page);
?>

<div class="col col--4-of-4">
    <?php 
        $newsPage = $news->get_first();
        include($app->newsContainer('header'));
    ?>
</div>
<div class="col col--3-of-4 col--centered">
  <div class="columns">
   <?php 
        $counter = 0;
        foreach($news as $key => $newsPage){
            if($counter > 0){
                 include($app->newsContainer($newsPage->get_style()));
            }
            $counter++;
    } ?>
    </div>
</div>
