<?php

/**
*
* © Agne Ødegaard 2016
*
*/

class App{
    static $ini_file = "data/config.ini";
    static $config,
           $pdo,
           $sql,
           $page,
           $account;
    
    function __construct(){
        if(!isset($_SESSION)) session_start();
        
        self::$config = parse_ini_file(self::$ini_file);
    }
    /**
     * Database PDO
     * @param object database $pdo
     */
    public function setPDO(Database $pdo){
        self::$pdo = $pdo;
    }
     /**
     * Obj sql
     * @param object sql $sql
     */
    public function setSQL(SQLMethods $sql){
        self::$sql = $sql;
    }
    
    /**
     * @return object Page
     */
    public function getPage(){
        return self::$page;
    }
    
    /**
     * Set the sites current page
     * @param object Page $page
     */
    public function setPage(Page $page){
        self::$page = $page;
    }
    
    /**
     * Menu
     * @return string file url
     */
    public function get_menu(){
        return self::$config['view_folder']."main/menu.php";
    }
    
    /**
     * Footer
     * @return string file url
     */
    public function get_footer(){
        return self::$config['view_folder']."main/footer.php";
    }
    
    public function error($e){
        echo $e;
    }
    
    public function newsContainer($container){
        return self::$config['view_folder']."news/$container.php";
    }
    
    
}
$app = new App();

// PDO and sql Functions
include("pdo.php");
include("controller/SQLMethods.php");

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
