<?php

class Pages extends App implements Countable, IteratorAggregate{
    private $pages = [],
            $error = [],
            $currentPage;
    
    /**
     * Page setup
     * @private
     */
    function __construct(){
        parent::__construct();
        
        // Add Pages            Path, Page Title, Page Header text, File, isVisible, $_GET
        $this->addPage(new Page("/", "Home Page", 'Welcome','index.php', true));
        $this->addPage(new Page("/news", "Browser News", 'Browse news', 'index.php', true, ['news']));
        $this->addPage(new Page("/random", "Browser Random News", 'Browse news', 'index.php', false));
        
        // Add Error Pages
        $this->addError(new Page("404", "Error 404", 'Error 404, page not found', 'error/404.php', false));
        $this->addError(new Page("403", "Error 403", 'Error 404, access denyed', 'error/404.php', false));
        
    }
    /**
     * Sett current page
     * @return object Page
     */
    function setPages(){
        $key = explode("-", $_SERVER['REQUEST_URI']);

        if(array_key_exists($key[0] , $this->pages)){
            $this->pages[$key[0]]->setVars($key);
            return $this->currentPage = $this->pages[$key[0]];
        } else {
            return $this->currentPage = $this->error['404'];
        }
    }
    /**
     * Add a page
     * @param object Page $item
     */
    public function addPage(Page $item){
        $this->pages[$item->get_url()] = $item;
    }
    /**
     * Add Error page
     * @param object Page $item
     */
    public function addError(Page $item){
        $this->error[$item->get_url()] = $item;
    }
    
    /**
     * function count(Obj Pages)
     * @param object Invisible param
     * @return integer Nunber of pages
     */
    public function count() {
        return count($this->pages);
    }
    
    /**
     * Foreach($pages as $page) on Obj Pages
     * @return object Page
     */
    public function getIterator(){
        return new ArrayIterator($this->pages);
    }
    
}
$pages = new Pages();
$app->setPage($pages->setPages());