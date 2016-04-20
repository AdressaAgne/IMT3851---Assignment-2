<?php 
class Database extends App{
	public $_db;
	
	/**
	 * Database connetion setup
	 * @private
	 */
	public function __construct() {
        parent::__construct();
        $dns = 'mysql:host='.parent::$config['host'].';dbname='.parent::$config['name'];
        $user = parent::$config['username'];
        $password = parent::$config['password'];
        
        try {
            $this->_db = new PDO($dns, $user, $password);
            $this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        } catch (PDOException $e) {
            $this->error("Database: ".$e);
        }
	}
    
	/**
	 * PDO bindValue
	 * @param object &$pdo   PDO
	 * @param array  &$array ['name' => 'value',...] :name will be value
	 * Using htmlspecialchars() instead of strip_tags(), so users can still use :> smileys and <--- arrows.
	 */
	public function arrayBinder(&$pdo, &$array) {
		foreach ($array as $key => $value) {
			$pdo->bindValue(':'.$key, htmlspecialchars($value));
		}
	}
    
    /**
     * Install The Database if it does not exist
     */
    public function installDatabase(){
        
    }
}

$app->setPDO(new Database());