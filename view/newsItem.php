<?php $newsPage = $news->get_news($_GET['news']); ?>
<article>
    <div class="hero" style="background-image: url(<?= $newsPage->get_ImageSource() ?>);">
        <div class="col col--3-of-4 col--centered">
            <div class="hero__content">
                <h1><a href="/news/<?= $newsPage->get_permalink() ?>"><?= $newsPage->get_title()?></a></h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col--3-of-4 col--centered">
            <p><?= $newsPage->get_article(); ?></p>
        </div>
    </div>
</article>
