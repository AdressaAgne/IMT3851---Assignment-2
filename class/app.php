<?php

class App{
    static $ini_file = "data/config.ini";
    public $config,
           $pdo,
           $page;
    
    function __construct(){
        $this->config = parse_ini_file(self::$ini_file);
    }
    /**
     * Database PDO
     * @param object database $pdo
     */
    public function setPDO(Database $pdo){
        $this->pdo = $pdo;
    }
    
    /**
     * @return object Page
     */
    public function getPage(){
        return $this->page;
    }
    
    /**
     * @param object Page $page Set the sites current page
     */
    public function setPage(Page $page){
        $this->page = $page;
    }
    
    /**
     * Menu
     * @return string file url
     */
    public function get_menu(){
        return $this->config['viewFolder']."main/menu.php";
    }
    
    /**
     * Footer
     * @return string file url
     */
    public function get_footer(){
        return $this->config['viewFolder']."main/footer.php";
    }
    
}
$app = new App();

// PDO and sql Functions
include("pdo.php");
include("controller/sql.php");

// Account Controller
include("controller/account.php");

// News Controller
include("controller/news.php");

// Page files
include("controller/page.php");
include("controller/pages.php");