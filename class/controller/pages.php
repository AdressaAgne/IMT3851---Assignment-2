<?php

class Pages extends App{
    private $pages = [],
            $error = [],
            $currentPage;
    
    /**
     * Page setup
     * @private
     */
    function __construct(){
        parent::__construct();
        
        // Add Pages
        $this->addPage(new Page("/","Home Page", 'Welcome', 'index.php'));
        $this->addPage(new Page("/view","Home Page", 'Browse news', 'index.php'));
        
        
        // Add Error Pages
        $this->addError(new Page("404","Error 404",'Error 404, page not found', 'error/404.php'));
        
    }
    
    function setPages(){
        if(array_key_exists($_SERVER['REQUEST_URI'], $this->pages)){
            return $this->currentPage = $this->pages[$_SERVER['REQUEST_URI']];
        } else {
            return $this->currentPage = $this->error['404'];
        }
    }
    /**
     * Add a page
     * @param object Page $item
     */
    public function addPage(Page $item){
        $this->pages[$item->url] = $item;
    }
    /**
     * Add Error page
     * @param object Page $item
     */
    public function addError(Page $item){
        $this->error[$item->url] = $item;
    }
}
$pages = new Pages();
$app->setPage($pages->setPages());