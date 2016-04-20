<?php

// a news post
class NewsPage extends App{
    private $id,
            $title,
            $article,
            $preview,
            $authorUUID,
            $author,
            $image,
            $style,
            $category,
            $timestamp,
            $votes = [];
    
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
    public function __construct($row){
        parent::__construct();
        
        $this->id = $row['id'];
        $this->title = $row['title'];
        $this->article = $row['article'];
        $this->preview = $row['preview'];
        $this->authorUUID = $row['author'];
        $this->author = $row['username'];
        $this->image = $row['image'];
        $this->style = $row['style'];
        
        $this->votes['up'] = $row['upVotes'];
        $this->votes['down'] = $row['downVotes'];
        $this->votes['total'] = $row['totalVotes'];
        $this->votes['percent'] = floor($row['upVotes'] / $row['totalVotes'] * 100);
        
        $this->cat = $row['cat_name'];
        $this->catID = $row['category'];
        
        $this->timestamp = $row['timestamp'];
    }
    
    /**
     * Article Votes
     * @return array [up, down, total]
     */
    public function get_votes(){
        return $this->votes;
    }
    
    public function get_categoryID(){
        return $this->catID;
    }
    
    public function get_timestamp(){
        return $this->timestamp;
    }
    
    /**
     * Increes the vote when voting
     * @param string $state
     */
    public function increese_vote($state){
        $this->votes[$state]++;
    }
    
    /**
     * Article Category Name
     * @return string
     */
    public function get_cat_name(){
        return $this->cat;
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
     * Get Article Author Name
     * @return string
     */
    public function get_author(){
        return $this->author;
    }
    
    /**
     * Get Article Author UUID
     * @return integer UUID
     */
    public function get_authorUUID(){
        return $this->authorUUID;
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
       return parent::createPermalink($this->id, $this->title);
    }
}
