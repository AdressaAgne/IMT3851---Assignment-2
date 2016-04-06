<?php

class sql extends App{
    
    public function select($sql, $arr = false){
        // Prepare sql statement
        $query = $this->pdo->_db->prepare($sql);
        
        if($arr !== false){
            // Add values to query
            $this->pdo->arrayBinder($query, $arr);
        }
        $query->execute();
        
        return $query->fetch();
        
    }
    public function delete(){
        
    }
    
    public function update(){
        
    }
    
    public function insert(){
        
    }
    
}