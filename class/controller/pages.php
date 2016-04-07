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
        
        // Add Pages            Path        Page Title      Page Header text                File                $_GET
        $this->addPage(new Page("/",        "Home Page",    'Welcome',                      'index.php'));
        $this->addPage(new Page("/news",    "Browser News",    'Browse news',               'index.php',        ['news']));
        
        // Add Error Pages
        $this->addError(new Page("404",     "Error 404",    'Error 404, page not found',    'error/404.php'));
        $this->addError(new Page("403",     "Error 403",    'Error 404, access denyed',     'error/404.php'));
        
    }
    
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
        $this->pages[$item->url] = $item;
    }
    /**
     * Add Error page
     * @param object Page $item
     */
    public function addError(Page $item){
        $this->error[$item->url] = $item;
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
     * Foreach on Obj Pages
     * @return object Page
     */
    public function getIterator(){
        return new ArrayIterator($this->pages);
    }
    
}
$pages = new Pages();
$app->setPage($pages->setPages());