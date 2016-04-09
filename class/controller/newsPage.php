<?php

// a news post
class NewsPage extends App{
    private $id,
            $title,
            $article,
            $preview,
            $author,
            $image,
            $style,
            $category;
    
    /**
     * News Article Page
     * @private
     * @param integer $id      Article UUID
     * @param string  $title   Article Title
     * @param string  $article Article Text
     * @param string  $preview Article Preview Text
     * @param integer $author  Author UUID
     * @param string  $image   Article Header Image source
     * @param integer $style   How to display the news on frontpage
     */
    public function __construct($id, $title, $article, $preview, $author, $image, $style){
        parent::__construct();
        
        $this->id = $id;
        $this->title = $title;
        $this->article = $article;
        $this->preview = $preview;
        $this->author = $author;
        $this->image = $image;
        $this->style = $style;
    }
    
    /**
     * Article Preview Text
     * @return string
     */
    public function get_preview(){
        return $this->preview;
    }
    
    /**
     * Article Header Image Source URL
     * @return string
     */
    public function get_ImageSource(){
        return $this->image;
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
     * Convert Int to String, Hwo to display the article; Default at 0
     * @return string
     */
    public function get_style(){
        $styles = [
            0 => "1-of-3",
            1 => "1-of-2",
            2 => "header",
            3 => "video"
        ];    
        return $styles[$this->style];
    }
    
    /**
     * Get Permalink
     * @return string Removed all glyphs and spaces
     */
    public function get_permalink(){
        $result = preg_replace("/([^a-zA-Z0-9\\s])/uis", "", strtolower(trim($this->id." ".$this->title)));
        
        return preg_replace("/\s/ui", parent::$config['permalink_space'], $result);
    }
}
