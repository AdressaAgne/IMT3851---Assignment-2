<?php

class Category{
    private $id,
            $name,
            $description;
    
    /**
     * Category
     * @private
     * @param integer $id                    
     * @param string  $name                  
     * @param string  [$description = false]
     */
    public function __construct($id, $name, $description = false){
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }
    
    /**
     * Get Category ID
     * @return integer
     */
    public function get_id(){
        return $this->id;
    }
    
    /**
     * Get Category Name
     * @return string
     */
    public function get_name(){
        return $this->name;
    }
    
    /**
     * Get Category Description
     * @return string is False if empty
     */
    public function get_description(){
        return $this->description;
    }
    
}