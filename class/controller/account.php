<?php

class Account extends App{
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
    public function __construct($id){
        $row = parent::$sql->select('account WHERE uuid = :id', ['id' => $id])[0];
        $this->id = $id;
        $this->name = $row['name'];
        $this->mail = $row['mail'];
        $this->rank = $row['rank'];
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