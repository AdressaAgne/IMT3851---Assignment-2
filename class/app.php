<?php

class App{
    protected $ini_file = "data/config.ini";
    public $config;
    public $pdo;
    
    function __construct(){
        $this->config = parse_ini_file($this->ini_file);
    }
    public function setPDO($pdo){
        $this->pdo = $pdo;
    }
}
$app = new App();

require_once("pdo.php");
require_once("controller/sql.php");
require_once("controller/account.php");
require_once("controller/news.php");
require_once("controller/page.php");