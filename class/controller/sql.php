<?php

class SQLMethods extends App{
    
    /**
     * PDO Select
     * @param  string $sql SQL Request
     * @param  array  $arr is false if not etered
     * @return array  sql    
     */
    public function select($sql, $arr = false){
        // Prepare sql statement
        $query = parent::$pdo->_db->prepare($sql);
        
        if($arr !== false){
            // Add values to query
            parent::$pdo->arrayBinder($query, $arr);
        }
        try{
            $query->execute();
        } catch (PDOExeption $e){
            $this->error($e);
        }
        
        return $query->fetch();
        
    }
    public function delete(){
        
    }
    
    public function update(){
        
    }
    
    public function insert(){
        
    }
    
}

$app->setSQL(new SQLMethods());