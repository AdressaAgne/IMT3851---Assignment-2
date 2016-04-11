<?php

class Account extends App{
    private $id,
            $name, 
            $sirname, 
            $mail,
            $rank;
    
    /**
     * Account
     * @private
     * @param integer $id   UUID
     * @param string  $name Users name
     * @param string  $mail Users Mail
     * @param integer $rank Used for premitions
     */
    public function __construct($id){
        $row = parent::$sql->select('account WHERE uuid = :id', ['id' => $id])[0];
        $this->id = $id;
        $this->name = $row['name'];
        $this->mail = $row['mail'];
        $this->rank = $row['rank'];
        $this->sirname = $row['surname'];
    }
    
    /**
     * get_id()
     * @return integer User UUID
     */
    public function get_id(){
        return $this->id;
    }
    
    /**
     * Users Name
     * @return string
     */
    public function get_name(){
        return strip_tags($this->name);
    }
    
    /**
     * Users Sirname
     * @return string
     */
    public function get_sirname(){
        return strip_tags($this->sirname);
    }
    
    /**
     * Users Mail
     * @return string
     */
    public function get_mail(){
        return strip_tags($this->mail);
    }
    
    /**
     * Premitions Rank
     * @return integer
     */
    public function get_rank($string = false){
        $rank = [
            '0' => 'Member',
            '1' => 'Member',
            '2' => 'Member',
            '3' => 'Moderator',
            '4' => 'Admin'
        ];
        return !$string ? $this->rank : $rank[$this->rank];
    }
    
    /**
     * Magic Method for echo($account)
     * @private
     * @return string Users name
     */
    public function __toString(){
        return strip_tags($this->name . " " .  $this->sirname);
    }
}