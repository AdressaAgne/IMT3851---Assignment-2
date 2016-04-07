<?php

class News extends App implements Countable, IteratorAggregate{
    private $news = [];
    
    /**
     * Populate News with NewsPages
     * @private
     */
    public function __construct(){
        $news = $this->sql->select("SELECT * FROM new");
        foreach($news as $newsPage){
            $this->addnews(new NewsPage($newsPage['title'], $newsPage['article'], $newsPage['author'], $newsPage['id']));
        }
    }
    
    /**
     * Add a NewsPage object to $news
     * @param object NewsPage $news
     */
    public function addNews(NewsPage $news){
        $this->news[] = $news;
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