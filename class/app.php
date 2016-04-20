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


if(isset($_COOKIE['frontpage']) && $_COOKIE['frontpage'] == 'hot' 
   && $app::$page->get_url() != '/hot'
   && $app::$page->get_url() == '/'){
    header("location: /hot");
}
if(isset($_COOKIE['frontpage']) && $_COOKIE['frontpage'] == 'recent' 
   && $app::$page->get_url() != '/recent'
   && $app::$page->get_url() == '/'){
    header("location: /recent");
}

if(!isset($_COOKIE['frontpage'])
   && $app::$page->get_url() != '/recent'
   && $app::$page->get_url() == '/'){
    header("location: /recent");
}


/**
*
*  This should be an individual file....
*
*
*/

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
        

        $info = $account->editUserInfo($app::$user->get_uuid(), $_POST['name_'], $_POST['surname_'], $_POST['mail_']);
        if($info === true){
            header("location: /profile");
        } else {
            $_GET['error'] = $info;
        };
        
        
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
    
    //Update cookie....
    if(isset($_POST['submitChangeCookie'])){
        //setcookie("frontpage", $_POST['frontPage'], time()+60*60*24*30);
        setcookie("frontpage", $_POST['frontPage'], -1);
        header("location: /profile");
        
    }
    
}

if($app::$page->get_url() == "/admin"){
    
    if(isset($_POST['id'])){
        
        if(isset($_POST['submitDeleteNews'])){
            $app::$sql->sql("DELETE FROM news WHERE id = :id", ['id' => $_POST['id']], false);
        }
        if(isset($_POST['submitDeleteUser'])){
            $app::$sql->sql("DELETE FROM account WHERE uuid = :id", ['id' => $_POST['id']], false);
        }
        if(isset($_POST['submitDeleteCat'])){
            $app::$sql->sql("DELETE FROM category WHERE id = :id", ['id' => $_POST['id']], false);
        }
        header("location: /admin");
    }
    
    if(isset($_POST['submitAddCat'])){
        
        $app::$sql->sql("INSERT INTO category (name) VALUES(:cat_name)", ['cat_name' => $_POST['cat_name_']], false);
        
    }
    
}


// Vote up/down
if($app::$page->get_url('/news')){
    if(isset($_POST['submitVoteUp'])){
        $app::$sql->sql("INSERT INTO votes (vote, uuid, news_id) 
                         SELECT * FROM (SELECT 1, :uuid, :news_id) as tmp
                         WHERE NOT EXISTS(
                            SELECT uuid, news_id FROM votes WHERE uuid = :uuid AND news_id = :news_id
                         ) LIMIT 1", 
                        ['uuid' => $app::$user->get_uuid(),
                         'news_id' => $news->get_news($_GET['news'])->get_id()], false); 
        
        header("location: /news/".$_GET['news']);
    }
    if(isset($_POST['submitVoteDown'])){
        $app::$sql->sql("INSERT INTO votes (vote, uuid, news_id) 
                         SELECT * FROM (SELECT -1, :uuid, :news_id) as tmp
                         WHERE NOT EXISTS(
                            SELECT uuid, news_id FROM votes WHERE uuid = :uuid AND news_id = :news_id
                         ) LIMIT 1", 
                        ['uuid' => $app::$user->get_uuid(),
                         'news_id' => $news->get_news($_GET['news'])->get_id()], false);
        header("location: /news/".$_GET['news']);
        
    }
    
}
