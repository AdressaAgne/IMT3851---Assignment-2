<?php

class News extends App implements Countable, IteratorAggregate{
    private $news = [];
    
    /**
     * Populate News with NewsPages
     * @private
     */
    public function __construct(){
        //parent::__construct();
        
        $news = parent::$sql->sql("SELECT   n.*, c.name as cat_name, a.name as username,
                                               COUNT(v.news_id) as totalVotes,
                                               SUM(v.vote = 1) as upVotes,
                                               SUM(v.vote = -1) as downVotes
                                               FROM news as n 
                                               LEFT JOIN votes as v ON n.id = v.news_id
                                               LEFT JOIN category as c ON n.category = c.id
                                               INNER JOIN account as a ON n.author = a.uuid
                                               GROUP BY n.id
                                               ORDER BY timestamp DESC");
        foreach($news as $newsPage){
            $this->addNews(new NewsPage($newsPage));
        }
        
        //SELECT news.*, catgory.*  FROM news INNER JOIN category WHERE news.category_id = category.id GROUP BY news.id Order BY timestamp DESC
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
            $this->news = [];
            $news = parent::$sql->sql("SELECT  n.*, c.name as cat_name, a.name as username,
                                               COUNT(v.news_id) as totalVotes,
                                               SUM(v.vote = 1) as upVotes,
                                               SUM(v.vote = -1) as downVotes,
                                               SUM(v.vote) - SUM(v.vote = -1) as score
                                               
                                               FROM news as n
                                               
                                               LEFT JOIN votes as v ON n.id = v.news_id
                                               LEFT JOIN category as c ON n.category = c.id
                                               INNER JOIN account as a ON n.author = a.uuid
                                               
                                               WHERE WEEKOFYEAR(n.timestamp) > WEEKOFYEAR(NOW())-4
                                               GROUP BY n.id
		                                       ORDER BY score DESC");
            foreach($news as $newsPage){
                $this->addNews(new NewsPage($newsPage));
            }
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