<ul>
    <?php foreach($pages as $page){
        if($page->isVisible()){
            echo '<li> <a href="'.$page->get_url().'">' .$page->get_title() . '</a></li>';
        }
    } ?>
</ul>