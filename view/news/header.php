<article class="hero" style="background-image: url(<?= $newsPage->get_ImageSource() ?>);">
    <div class="col col--3-of-4 col--centered">
        <div class="hero__content col--3-of-4 col--centered">
            <h1><a href="/news/<?= $newsPage->get_permalink() ?>"><?= $newsPage->get_title()?></a></h1>
            <div class="article__container">
                <?= strip_tags($Parsedown->text(substr($newsPage->get_article(), 0, 100))) ?>
            </div>
        </div>
    </div>
</article>