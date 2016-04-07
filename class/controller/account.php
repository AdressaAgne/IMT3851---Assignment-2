<?php

class Account{
    private $id,
            $name, 
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
    public function __construct($id, $name, $mail, $rank){
        $this->id = $id;
        $this->name = $name;
        $this->mail = $mail;
        $this->rank = $rank;
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
        return $this->name;
    }
    
    /**
     * Users Mail
     * @return string
     */
    public function get_mail(){
        return $this->mail;
    }
    
    /**
     * Premitions Rank
     * @return integer
     */
    public function get_rank(){
        return $this->rank;
    }
    
    /**
     * Magic Method for echo($account)
     * @private
     * @return string Users name
     */
    public function __toString(){
        return $this->name;
    }
}