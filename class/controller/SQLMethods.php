<?php

class SQLMethods extends App{
    
    /**
     * PDO Select
     * @param  string $table SQL Table
     * @param  array  $arr is false if not etered
     * @return array  sql rows   
     */
    public function select($table, $arr = false){
        // Prepare sql statement
        $query = parent::$pdo->_db->prepare("SELECT * FROM $table");
        
        if($arr !== false){
            // Add values to query
            parent::$pdo->arrayBinder($query, $arr);
        }
        try{
            $query->execute();
        } catch (PDOExeption $e){
            $this->error($e);
        }
        
        return $query->fetchAll();
        
    }
    
    public function sql($sql, $arr = false, $fetch = true){
        // Prepare sql statement
        $query = parent::$pdo->_db->prepare($sql);
        
        if($arr !== false){
            // Add values to query
            parent::$pdo->arrayBinder($query, $arr);
        }
        
        if($fetch){
            try{
                $query->execute();
            } catch (PDOExeption $e){
                $this->error($e);
            }
            return $query->fetchAll();
        } else {
            try{
                return $query->execute();
            } catch (PDOExeption $e){
                return $this->error($e);
            }
        }
        
        
    }
    public function delete(){
        
    }
    
    public function update(){
        
    }
    
    public function insert(){
        
    }
    
}

$app->setSQL(new SQLMethods());