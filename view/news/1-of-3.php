<article class="col col--1-of-3">
    <div class="card">
        <a href="/news/<?= $newsPage->get_permalink() ?>">
            <div class="card__image" style="background-image: url(<?= $newsPage->get_ImageSource() ?>);">
                <div class="card__image--text"><?= $newsPage->get_title()?></div>
            </div>
        </a>
        <div class="card__content">
            <p><?= $newsPage->get_preview() ?></p>
        </div>
        <div class="card__action">
            <a href="/news/<?= $newsPage->get_permalink() ?>">View</a>
        </div>
    </div>
</article>