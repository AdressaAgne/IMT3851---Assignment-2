<article class="row" style="background-image: url(<?= $newsPage->get_ImageSource() ?>);">
    <h1><a href="/news/<?= $newsPage->get_permalink() ?>"><?= $newsPage->get_title()?></a></h1>
    <p><?= $newsPage->get_preview() ?></p>
</article>