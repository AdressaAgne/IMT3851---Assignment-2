<?php 
class Database extends App{
	public $_db;
	
	/**
	 * Database connetion setup
	 * @private
	 */
	public function __construct() {
        parent::__construct();
        
        try {
            $this->_db = new PDO('mysql:host='.parent::$config['host'].';dbname='.parent::$config['name'], parent::$config['username'], parent::$config['password']);
            $this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        } catch (PDOException $e) {
            die("Error: ".$e);
        }
	}
    
	/**
	 * PDO bindValue
	 * @param object &$pdo   PDO
	 * @param array  &$array ['name' => 'value',...] :name will be value
	 */
	public function arrayBinder(&$pdo, &$array) {
		foreach ($array as $key => $value) {
			$pdo->bindValue(':'.$key,$value);
		}
	}	
}

$app->setPDO(new Database());