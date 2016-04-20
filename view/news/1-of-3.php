<div class="col__card">
    <article class="card">
        <a href="/news/<?= $newsPage->get_permalink() ?>">
            <div class="card__image" style="background-image: url(<?= $newsPage->get_ImageSource() ?>);">
                <div class="card__image--text"><?= $newsPage->get_title()?></div>
            </div>
        </a>
        <div class="card__content">
            <p>
                <strong class="left"><?= $newsPage->get_cat_name() ?></strong>
                <strong class="right"><?= $newsPage->get_author() ?></strong>
            </p>
            <div class="article__container">
                <?= $Parsedown->text(substr($newsPage->get_article(), 0, 200)) ?>
            </div>
        </div>
        <div class="card__action">
            <a href="/news/<?= $newsPage->get_permalink() ?>"><i class="fa fa-eye"></i> View</a>
            <span class="card__action--right"><i class="fa fa-thumbs-up"></i> <?= $newsPage->get_votes()['up'] ?> (<?= round($newsPage->get_votes()['up'] / $newsPage->get_votes()['total'] * 100, 0) ?>%)</span>
        </div>
    </article>
</div>
