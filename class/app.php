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
           $user,
           $categorys;
    
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
    
    public function createPermalink($id, $title){
        $result = preg_replace("/([^a-zA-Z0-9\\s])/uis", "", strtolower(trim($id." ".$title)));
        
        return preg_replace("/\s/ui", self::$config['permalink_space'], $result);
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
include("controller/category.php");

// Page files
include("controller/page.php");
include("controller/pages.php");

// Markdown Library
include("libs/parsedown.php");
$Parsedown = new Parsedown();

//Logout
if($app::$page->get_url() == "/logout"){
   $account->logout();
}

// Register User
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
// Login
if($app::$page->get_url() == "/login" && isset($_POST['submitLogin'])){
    if(!$account->login($_POST['username_'], $_POST['password_'], false)){
        $error = "Wrong Login Information";
    };
}

// Insert new post
if($app::$page->get_url() == '/add' && isset($_POST['submitAddPost'])){
    if($app::$sql->sql("INSERT INTO news (title, article, author, image, category)
                                VALUES(:title, :article, :author, :image, :category)",
                   ['title'     => $_POST['title_'],
                    'image'     => $_POST['image_'],
                    'author'    => $app::$user->get_uuid(),
                    'category'  => $_POST['category_'],
                    'article'   => $_POST['article_']], false
                   )
    ){
        //insert vote up  
        $id = $app::$sql->select("news ORDER BY timestamp DESC LIMIT 1")['0']['id'];
        $app::$sql->sql("INSERT INTO votes (vote, uuid, news_id) VALUES(1, :uuid, :news_id)", 
                        ['uuid' => $app::$user->get_uuid(),
                         'news_id' => $id], false);   
    }
     
}

// Update post
if($app::$page->get_url() == '/edit' && isset($_POST['submitEditPost'])){
    if($app::$sql->sql("UPDATE news 
                        SET title = :title, article = :article, image = :image, category = :category 
                        WHERE id = :id AND author = :author",
                   ['title'     => $_POST['title_'],
                    'image'     => $_POST['image_'],
                    'author'    => $app::$user->get_uuid(),
                    'id'        => $_POST['id'],
                    'category'  => $_POST['category_'],
                    'article'   => $_POST['article_']], false
                   )
    ){
        header("location: /news/".$app->createPermalink($_POST['id'], $_POST['title_']));
    }
     
}

//User Profile

if($app::$page->get_url('/profile')){
    
    // Update info
    if(isset($_POST['submitUpdateAccountInfo'])){
        
    }
    
    
    //Change Password
    if(isset($_POST['submitChangePassword'])){
        if($_POST['password_new_1'] === $_POST['password_new_2']){
            $info = $account->changePassword($app::$user->get_uuid(), $_POST['password_old'], $_POST['password_new_1']);
            if($info === true){
                $_GET['success'] = "Password Updated";   
            } else {
                $_GET['error'] = $info;
            };
        } else {
            $_GET['error'] = "New passwords does not match!";
        }
    }
    
}


// Vote up/down
if($app::$page->get_url('/news')){
    
    if(isset($_POST['submitVoteUp'])){
        $app::$sql->sql("INSERT INTO votes (vote, uuid, news_id) VALUES(1, :uuid, :news_id)", 
                        ['uuid' => $app::$user->get_uuid(),
                         'news_id' => $news->get_news($_GET['news'])->get_id()], false); 
        $news->get_news($_GET['news'])->increese_vote('up');
    }
    if(isset($_POST['submitVoteDown'])){
        $app::$sql->sql("INSERT INTO votes (vote, uuid, news_id) VALUES(-1, :uuid, :news_id)", 
                        ['uuid' => $app::$user->get_uuid(),
                         'news_id' => $news->get_news($_GET['news'])->get_id()], false);
        $news->get_news($_GET['news'])->increese_vote('down');
    }
    
}
