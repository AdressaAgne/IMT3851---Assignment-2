<?php $newsPage = $news->get_news($_GET['news']); ?>
<div class="col col--4-of-4">
<article>
    <div style="background-image: url(<?= $newsPage->get_ImageSource() ?>); width: 100%; height: 100px;"></div>
    <h1><?= $newsPage->get_title() ?></h1>  
    <p><?= $newsPage->get_article() ?></p>
</article>
</div>