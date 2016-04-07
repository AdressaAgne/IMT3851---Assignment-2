<?php

// a news post
class NewsPage extends App{
    private $title,
            $article,
            $author,
            $id,
            $category;
    
    /**
     * News Article Page
     * @private
     * @param string  $title   Article Title
     * @param string  $article Article Text
     * @param integer $author  Author UUID
     * @param integer $id      Article UUID
     */
    public function __construct($title, $article, $author, $id){
        parent::__construct();
        
        $this->title = $title;
        $this->article = $article;
        $this->author = $author;
        $this->id = $id;
    }
    
    /**
     * Get Article Title
     * @return string
     */
    public function get_title(){
        return $this->title;
    }
    
    /**
     * Get Article Text
     * @return string
     */
    public function get_article(){
        return $this->article;
    }
    
    /**
     * Get Article Author UUID
     * @return integer UUID
     */
    public function get_author(){
        return $this->author;
    }
    
    /**
     * Get Article UUID
     * @return integer UUID
     */
    public function get_id(){
        return $this->id;
    }
    
    /**
     * Get Article Category
     * @return array
     */
    public function get_category(){
        return $this->category;
    }
    
    /**
     * Get Permalink
     * @return string Removed all spaces so its URL friendly
     */
    public function get_permalink(){
        return preg_replace("/\s/ui", $this->config['permalink_space'], $this->title);
    }
}
