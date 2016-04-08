<?php
class AccountController extends App{
    private $uuid,
            $token,
            $timer;
    
    public function __construct(){
        $this->timer = time() + (86400 * 14);
    }
    
    //hashing stuff like password
    protected function hashValue($value, $salt){
        return sha1($salt.$value.$salt);
    }
    
    //Generate a "random" token
    protected function generateToken(){
        return sha1(microtime());
    }
    
    //generating and adding a new token hash for a user
    protected function newToken($uuid){
        $newHash = $this->generateToken();
        $query =  parent::$pdo->_db->prepare("UPDATE account SET cookieHash=:hash WHERE uuid = :uuid");
        $arr = array(
            'uuid' => $uuid,
            'hash' => $newHash
        );
        parent::$pdo->arrayBinder($query, $arr);
        $query->execute();
        
        return $newHash;
    }
    
    // Normal Login
    public function login($username, $password, $remember){
        //fetch Unique Salt for user
        $hashQuery = parent::$pdo->_db->prepare("SELECT salt FROM account WHERE mail = :username");
        $hashArr = array(
            'username' => $username
        );
        parent::$pdo->arrayBinder($hashQuery, $hashArr);
        $hashQuery->execute();
        
        //echo $this->hashValue($password, $hash['salt']);
        //check if user exists
        if ($hashQuery->rowCount() === 1) {
           $hash = $hashQuery->fetch(PDO::FETCH_ASSOC);
            
            //prepare to check if user got right password
            $query =  parent::$pdo->_db->prepare("SELECT * FROM account WHERE mail = :username AND password = :password");
            $arr = array(
                'username' => $username,
                'password' => $this->hashValue($password, $hash['salt'])
            );
            parent::$pdo->arrayBinder($query, $arr);
            $query->execute();
            
            // Do stuff when right userinformation is entered.
            if ($query->rowCount() === 1) {
                $user = $query->fetch(PDO::FETCH_ASSOC);
                $newHash = $this->newToken($user["uuid"]);
                $_SESSION['uuid'] = $user['uuid'];
                $_SESSION['token'] = $newHash;
                
                if($remember){
                    setcookie('uuid', $user["uuid"], $this->timer, "/");
                    setcookie('token',  $newHash, $this->timer, "/");
                    setcookie('remember', true, $this->timer, "/");
                }
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    //complete userlogout
    public function logout() {
		unset($_SESSION['uuid']);
		unset($_SESSION['token']);
		
        setcookie('remember', null, -1, '/');
		setcookie('token', null, -1, '/');
		setcookie('uuid', null, -1, '/');
		
		unset($_COOKIE['remember']);
		unset($_COOKIE['token']);
		unset($_COOKIE['uuid']);
		
		session_destroy();
	}
    
    //login using cookies
    public function loginAdvanced($uuid, $hash){

        $query =  parent::$pdo->_db->prepare("SELECT * FROM account WHERE uuid = :uuid AND cookieHash = :hash");
        $arr = array(
            'uuid' => $uuid,
            'hash' => $hash
        );
        $this->arrayBinder($query, $arr);
        $query->execute();

        if ($query->rowCount() === 1) {
            $user = $query->fetch(PDO::FETCH_ASSOC);
            
            $newHash = $this->newToken($user["uuid"]);
            
            $_SESSION['uuid'] = $user['uuid'];
            $_SESSION['token'] = $newHash;
            
            setcookie('uuid', $user["uuid"], $this->timer, "/");
            setcookie('token', $newHash, $this->timer, "/");
            setcookie('remember', true, $this->timer, "/");
            
            return true;
        } else {
            $_GET['error'] = "You were logged out from another computer.";
        }
    }

    // Create an account
    public function addAccount($password, $mail, $name, $surname, $rank){
        $query =  parent::$pdo->_db->prepare("SELECT * FROM account WHERE mail = :email");
        $arr = array(
            'email' => $mail
        );
        $this->arrayBinder($query, $arr);
        $query->execute();

        if ($query->rowCount() === 1) {
            return false;
        }
        
        $query =  parent::$pdo->_db->prepare("INSERT INTO account (mail, password, salt, name, surname, rank) VALUES(:mail, :password, :salt, :name, :surname, :rank)");
        $salt = $this->generateToken();
        
        $arr = array(
            'password'  => $this->hashValue($password, $salt),
            'mail'      => $mail,
            'salt'      => $salt,
            'name'      => $name,
            'surname'   => $surname,
            'rank'      => $rank
        );
        $this->arrayBinder($query, $arr);
        return $query->execute();
    }
    
    
    // remove a user account
    public function removeAccount($uuid){
        $query =  parent::$pdo->_db->prepare("DELETE from account WHERE uuid = :uuid");
        
        $arr = array(
            'uuid'  => $uuid
        );
        $this->arrayBinderInt($query, $arr);
        return $query->execute();
    }
    
    public function lostPassword($username, $mail){
        //Todo: Send mail to user with link so they can change there password if needed.
    }
}
$account = new AccountController();


