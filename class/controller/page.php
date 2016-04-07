<?php

class Page extends App{
    
    public $url,
           $title,
           $content,
           $header;
    
    /**
     * Set values
     * @private
     * @param string $url     Brwoser Url
     * @param string $title   Page Title
     * @param string $header  php file url
     * @param string $content Page header text
     */
    function __construct($url, $title, $header, $content){
        $this->url = $url;
        $this->title = $title;
        $this->header = $header;
        $this->content = $content;
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