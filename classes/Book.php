<?php 
class Book {
    
   private  $_db;
        
            public function __construct($book = NULL){
                $this->_db = DB::getInstance();
                
            }
            
            public function getAllBooks()
            {
                $stmt= $this->prepare("SELECT * FROM books");
                $stmt->execute();
                $results=$stmt->fetchAll(PDO::FETCH_OBJ);
                return $results;
            }
            
}