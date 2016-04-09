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
        
        // Add Pages            Path, Page Title, Page Header text, File, isVisible, icon,  $_GET
        $this->addPage(new Page("/", "Recent", 'Recent News','index.php', 
                                ['isVisible' => true,'icon' => 'clock-o']));
        
        $this->addPage(new Page("/hot", "Popular", 'Popular News','index.php', 
                                ['isVisible' => true, 'icon' => 'line-chart']));
        
        $this->addPage(new Page("/news", "News Item", 'News item', 'newsItem.php', 
                                ['isVisible' => false, 'icon' => 'fire', 'get' => ['news']]));
         
        // User Authentication
        if(!isset($_SESSION['uuid'])){
            $this->addPage(new Page("/register", "Register", 'Register', 'registrate.php', 
                                   ['isVisible' => true, 'icon' => 'user-plus', 'right' => true]));
       
            $this->addPage(new Page("/login", "Login", 'Login', 'login.php', 
                                   ['isVisible' => true, 'icon' => 'user', 'right' => true, 'var' => true, 'get' => ['ridirect']]));
        }
        if(isset($_SESSION['uuid'])){
            
            $this->addPage(new Page("/add", "Add News", 'Add News','index.php', 
                                ['isVisible' => true, 'icon' => 'plus']));
            
            if(parent::$user->get_rank() >= 3){
                $this->addPage(new Page("/admin", "Admin", 'Admin','index.php', 
                                ['isVisible' => true, 'icon' => 'bolt']));
            }
            
            $this->addPage(new Page("/logout", "Logout", 'Profile', 'logout.php', 
                                    ['isVisible' => true, 'icon' => 'sign-out', 'right' => true]));
            
            $this->addPage(new Page("/profile", parent::$user !== null ? parent::$user->get_name() : "" , 'Profile', 'profile.php', 
                                    ['isVisible' => true, 'icon' => 'user', 'right' => true]));
        }
        
        // Add Error Pages
        $this->addError(new Page("404", "Error 404", 'Error 404, page not found', 'error/404.php', 
                                 ['isVisible' => false, 'icon' => 'times']));
        $this->addError(new Page("403", "Error 403", 'Error 404, access denyed', 'error/404.php', 
                                 ['isVisible' => false, 'icon' => 'times']));
        
    }
    /**
     * Sett current page
     * @return object Page
     */
    function setPages(){
        $key = explode(parent::$config['get_devider'], $_SERVER['REQUEST_URI']);
        array_shift($key);
        $key[0] = "/{$key[0]}";
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