<?php

class Pages extends App{
    // $pages could be populated with a database table to make it a cms
    private $pages = [
                '/' => [
                    'title' => "Home page",
                    'content' => "index.php"
                ]
            ],
            $error = [
                '404' => [
                    'title' => 'Error 404, page not found',
                    'content' => 'error/404.php'
                ]
            ],
            $currentPage;
    
    function __construct(){
        parent::__construct();
        
        if(array_key_exists($_SERVER['REQUEST_URI'], $this->pages)){
            $this->currentPage = $this->pages[$_SERVER['REQUEST_URI']];
        } else {
            $this->currentPage = $this->error['404'];
        }
    }
    
    public function addPage($path, $arr){
        $this->pages[$path] = $arr;
    }
    
    public function get_title(){
        return $this->currentPage['title'];
    }
    
    public function get_content(){
        include($this->config['viewFolder'].$this->currentPage['content']);
    }
    
    public function get_menu(){
        include($this->config['viewFolder']."main/menu.php");
    }
    
    public function get_footer(){
        include($this->config['viewFolder']."main/footer.php");
    }
    
}

$pages = new Pages();
