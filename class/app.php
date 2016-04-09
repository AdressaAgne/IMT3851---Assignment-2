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
           $user;
    
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
     * Set the Logged inn user
     * @param object Account $user
     */
    public function setUser(Account $user){
        self::$user = $user;
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
    
    /**
     * Get The right HTML for a news item
     * @param  string  $container
     * @return string php file
     */
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

if (isset($_SESSION['uuid'])){
    $app->setUser(new Account($_SESSION['uuid']));
}

// News Controller
include("controller/newsPage.php");
include("controller/news.php");

// Page files
include("controller/page.php");
include("controller/pages.php");


if($app::$page->get_url() == "/logout"){
   $account->logout();
}

if($app::$page->get_url() == "/register" && isset($_POST['submitRegister'])){
    if($_POST['password_1'] === $_POST['password_2']){
        if($account->addAccount($_POST['password_1'], $_POST['mail_'], $_POST['name_'], $_POST['sirname_'], 0)){
            $account->login($_POST['mail_'], $_POST['password_1'], false);
        } else {
            $error = "Mail already used";
        }
    } else {
        $error = "Passwords most match.";
    }
    
}


if($app::$page->get_url() == "/login" && isset($_POST['submitLogin'])){
    if(!$account->login($_POST['username_'], $_POST['password_'], false)){
        $error = "Wrong Login Information";
    };
}


// Debug info
if(isset($_GET['debug'])){
    highlight_string("<?php\n\$data =\n" . var_export($app, true) . ";\n?>");
}
