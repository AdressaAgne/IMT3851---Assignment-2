<div class="col col--3-of-4 col--centered">
    <ul class="menu">
       <li class="menu__item menu__item--right visible--phone"><a id="burger"><i class="fa fa-bars"></i></a></li>
        <?php foreach($pages as $page){
            if($page->isVisible()){
                echo '<li class="menu__item '.$page->get_alignment() . ($app::$page->get_url() == $page->get_url() ? " menu__item--active" : "") . '"> <a href="'.$page->get_url(). ($page->get_hasMore() ? $app::$page->get_url() : '') .'">' . $page->get_icon() . $page->get_title() . '</a></li>';
            }
        } ?>
    </ul>
</div>