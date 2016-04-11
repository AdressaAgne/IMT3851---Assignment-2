<?php 
$newsPage = $news->get_news($_GET['news']); 

if($newsPage !== false) { ?>
    <article>
        <div class="hero" style="background-image: url(<?= $newsPage->get_ImageSource() ?>);">
            <div class="col col--3-of-4 col--centered">
                <div class="hero__content col col--3-of-4 col--centered">
                    <h1><a href="/news/<?= $newsPage->get_permalink() ?>"><?= $newsPage->get_title()?></a></h1>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col col--3-of-4 col--centered">
                <div class="button--container">
                    <span class="thumb__text">(wip)</span>
                    <a href="" class="btn"><i class="fa fa-thumbs-up"></i> 123</a>
                    <a href="" class="btn"><i class="fa fa-thumbs-down"></i> 321</a>
                </div>
                <p><?= $newsPage->get_article(); ?></p>
            </div>
        </div>
    </article>
<?php } else { ?>
    <article>
        <div class="hero">
            <div class="col col--3-of-4 col--centered">
                <div class="hero__content col col--3-of-4 col--centered">
                    <h1>We're sorry but it seems that the news you are looking for does not exists or has been removed</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col col--3-of-4 col--centered">
                <p><a href="/">Back to recent</a></p>
            </div>
        </div>
    </article>
<?php } ?>