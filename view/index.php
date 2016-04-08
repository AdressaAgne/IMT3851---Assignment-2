
<div class="row">
   <?php foreach($news as $key => $newsPage){
        include($app->newsContainer($newsPage->get_style()));
    } ?>
</div>