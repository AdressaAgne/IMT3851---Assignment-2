<article>
    <p>We have <?= count($pages) ?> pages</p>
    <ul>
        <?php foreach($pages as $page){
            echo '<li> <a href="'.$page->url.'">' .$page->title . '</a></li>';
        } ?>
    </ul>
</article>