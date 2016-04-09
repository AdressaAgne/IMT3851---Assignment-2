<?php

class Page extends App{
    
    private $url,
            $title,
            $content,
            $header,
            $visible,
            $icon,
            $right,
            $hasMore,
            $get;
    
    /**
     * Set values
     * @private
     * @param string  $url     Brwoser Url
     * @param string  $title   Page Title
     * @param string  $header  php file url
     * @param string  $content Page header text
     * @param boolean $visible is the page visible
     * @param array   $vars    $_GET names
     */
    function __construct($url, $title, $header, $content, $vars){
        $this->url = $url;
        $this->title = $title;
        $this->header = $header;
        $this->content = $content;
        
        $this->visible = isset($vars['isVisible']) ? $vars['isVisible'] : false;
        $this->get = isset($vars['get']) ? $vars['get'] : false;
        $this->icon = isset($vars['icon']) ? $vars['icon'] : false;
        $this->right = isset($vars['right']) ? $vars['right'] : false;
        $this->hasMore = isset($vars['var']) ? $vars['var'] : false;
    }
    
    /**
     * Set page $_GET variables
     * @param array $vars variables
     */
    public function setVars($vars){
        array_shift($vars);
        if($this->get !== false){
            foreach($vars as $key => $var){
                if(array_key_exists($key, $this->get)){
                    $_GET[$this->get[$key]] = $var;
                }   
            }
        }
    }
    
    /**
     * Page url
     * @return string
     */
    public function get_url(){
        return $this->url;
    }
    
    /**
     * If the page should be to the left or right in the menu
     * @return string
     */
    public function get_alignment(){
        return $this->right ? "menu__item--right" : "";
    }
    
    /**
     * If the link should contain more then just the page, eg. $_Get vars
     * @return boolean
     */
    public function get_hasMore(){
        return $this->hasMore;
    }
    
    /**
     * Get the Page Icon
     * @return string
     */
    public function get_icon(){
        return '<i class="fa fa-'.$this->icon.'"></i> ';
    }
    
    /**
     * get Page title
     * @return string
     */
    public function get_title(){
        return $this->title;
    }
    
    /**
     * Get page content url
     * @return string
     */
    public function get_content(){
        return $this->content;
    }
    
    /**
     * Get Page Header Text
     * @return string
     */
    public function get_header(){
        return $this->header;
    }
    
    /**
     * Is the page visible for the Menu
     * @return boolean
     */
    public function isVisible(){
        return $this->visible;
    }
}