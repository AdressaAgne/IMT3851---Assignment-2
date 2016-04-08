<div class="col__card">
    <article class="card">
        <a href="/news/<?= $newsPage->get_permalink() ?>">
            <div class="card__image" style="background-image: url(<?= $newsPage->get_ImageSource() ?>);">
                <div class="card__image--text"><?= $newsPage->get_title()?></div>
            </div>
        </a>
        <div class="card__content">
            <p><?= $newsPage->get_preview() ?></p>
        </div>
        <div class="card__action">
            <a href="/news/<?= $newsPage->get_permalink() ?>"><i class="fa fa-eye"></i> View</a>
        </div>
    </article>
</div>
