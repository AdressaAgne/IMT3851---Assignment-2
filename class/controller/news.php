<?php

class News extends App implements Countable, IteratorAggregate{
    private $news = [];
    
    /**
     * Populate News with NewsPages
     * @private
     */
    public function __construct(){
        //parent::__construct();
        
        $news = parent::$sql->select("news ORDER BY timestamp DESC");
        foreach($news as $newsPage){
            $this->addNews(new NewsPage($newsPage['id'], $newsPage['title'], $newsPage['article'], $newsPage['preview'], $newsPage['author'], $newsPage['image'], $newsPage['style']));
        }
    }
    
    /**
     * Add a NewsPage object to $news
     * @param object NewsPage $news
     */
    public function addNews(NewsPage $news){
        $this->news[$news->get_permalink()] = $news;
    }
    
    /**
     * Get a News article
     * @param  string  $permalink The Articles Permalink
     * @return boolean/object Page
     */
    public function get_news($permalink){
        if(array_key_exists($permalink, $this->news)){
            return $this->news[$permalink];
        } else {
            return false;
        }
        
    }
    
    /**
     * Sort news by most Popular
     * @param object Page $page Current Page
     */
    public function sort_by(Page $page){
        if($page->get_url() == '/hot'){
            ksort($this->news);
        }
    }
    
    /**
     * Get the first/latest/Most Popular News Article
     * @return object News
     */
    public function get_first(){
        return array_values($this->news)[0]; 
    }
    
    /**
     * Count all news
     * @return integer
     */
    public function count() {
        return count($this->news);
    }
    
    /**
     * Foreach($news as $newsPage)
     * @return object NewsPage
     */
    public function getIterator(){
        return new ArrayIterator($this->news);
    }
    
}
$news = new News();