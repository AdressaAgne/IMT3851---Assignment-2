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
                    <form action="" method="post" style="display: inline-block;">
                        <button type="submit" name="submitVoteUp" class="btn"><i class="fa fa-thumbs-up"></i> <?= $newsPage->get_votes()['up'] ?></button>
                    </form>
                    <form action="" method="post" style="display: inline-block;">    
                        <button type="submit" name="submitVoteDown" class="btn"><i class="fa fa-thumbs-down"></i> <?= $newsPage->get_votes()['down'] ?></button>
                    </form>
                    <?php if($newsPage->get_authorUUID() === $app::$user->get_uuid()){ ?>
                        <a href="/delete/<?= $newsPage->get_permalink() ?>" class="right danger"><i class="fa fa-trash"></i> Delete</a>
                        <a href="/edit/<?= $newsPage->get_permalink() ?>" class="right"><i class="fa fa-pencil"></i> Edit</a>
                    <?php } ?>
                        
                </div>
            </div>
            <div class="col col--2-of-4 col--centered article__container"><?= $Parsedown->text($newsPage->get_article()) ?></div>
        </div>
    </article>
<?php } else { ?>
    <article>
        <div class="hero">
            <div class="col col--3-of-4 col--centered">
                <div class="hero__content col col--2-of-4 col--centered">
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