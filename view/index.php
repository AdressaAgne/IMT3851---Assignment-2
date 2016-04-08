

<div class="col col--4-of-4">
    <?php $newsPage = $news->get_first();
        include($app->newsContainer('header'));
    ?>
</div>
<div class="col col--3-of-4 col--centered">
    <div class="col col--1-of-3">
   <?php 
        $counter = 1;
        foreach($news as $key => $newsPage){
            if($counter == 2){
                 include($app->newsContainer($newsPage->get_style()));
            }

            $counter = $counter == 4 ? 2 : $counter += 1;
    } ?>
    </div>

    <div class="col col--1-of-3">
   <?php 
        $counter = 1;
        foreach($news as $key => $newsPage){
            if($counter == 3){
                 include($app->newsContainer($newsPage->get_style()));
            }

            $counter = $counter == 4 ? 2 : $counter += 1;
    } ?>
    </div>

    <div class="col col--1-of-3">
   <?php 
        $counter = 1;
        foreach($news as $key => $newsPage){
            if($counter == 4){
                 include($app->newsContainer($newsPage->get_style()));
            }

            $counter = $counter == 4 ? 2 : $counter += 1;
    } ?>
    </div>
</div>