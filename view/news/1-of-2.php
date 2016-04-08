<article class="col col--2-of-4">
    <div style="background-image: url(<?= $newsPage->get_ImageSource() ?>); width: 100%; height: 100px;"></div>
    <h1><a href="/news/<?= $newsPage->get_permalink() ?>"><?= $newsPage->get_title()?></a></h1>
    <p><?= $newsPage->get_preview() ?></p>
</article>