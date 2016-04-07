<?php

class Page extends App{
    
    public $url,
           $title,
           $content,
           $header,
           $get;
    
    /**
     * Set values
     * @private
     * @param string $url     Brwoser Url
     * @param string $title   Page Title
     * @param string $header  php file url
     * @param string $content Page header text
     */
    function __construct($url, $title, $header, $content, $vars = false){
        $this->url = $url;
        $this->title = $title;
        $this->header = $header;
        $this->content = $content;
        if($vars !== false) $this->get = $vars;
    }
    
    /**
     * Page $_GET Variables
     * @param array $vars variables
     */
    public function setVars($vars){
        array_shift($vars);
        foreach($vars as $key => $var){
            if(array_key_exists($key, $this->get)){
                 $_GET[$this->get[$key]] = $var;
            }
        }
    }
    
    /**
     * @return string Page title
     */
    public function get_title(){
        return $this->title;
    }
    
    /**
     * @return string page content url
     */
    public function get_content(){
        return $this->content;
    }
}