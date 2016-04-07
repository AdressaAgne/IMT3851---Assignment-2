<?php

/**
*
* © Agne Ødegaard 2016
*
*/

class App{
    static $ini_file = "data/config.ini";
    public $config,
           $pdo,
           $sql,
           $page,
           $account;
    
    function __construct(){
        if(!isset($_SESSION)) session_start();
        
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
     * Obj sql
     * @param object sql $sql
     */
    public function setSQL(sql $sql){
        $this->sql = $sql;
    }
    
    /**
     * @return object Page
     */
    public function getPage(){
        return $this->page;
    }
    
    /**
     * Set the sites current page
     * @param object Page $page
     */
    public function setPage(Page $page){
        $this->page = $page;
    }
    
    /**
     * Menu
     * @return string file url
     */
    public function get_menu(){
        return $this->config['view_folder']."main/menu.php";
    }
    
    /**
     * Footer
     * @return string file url
     */
    public function get_footer(){
        return $this->config['view_folder']."main/footer.php";
    }
    
    
}
$app = new App();

// PDO and sql Functions
include("pdo.php");
include("controller/sql.php");

// Account Controller
include("controller/account.php");
include("controller/accounts.php");

// News Controller
include("controller/newsPage.php");
include("controller/news.php");

// Page files
include("controller/page.php");
include("controller/pages.php");


// Debug info
if(isset($_GET['debug'])){
    highlight_string("<?php\n\$data =\n" . var_export($app, true) . ";\n?>");
}
