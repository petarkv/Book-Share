<?php
class DB 
{
    private static $_instance = NULL;
    private $_pdo,
    $_query,
    $_error = false,
    $_result,
    $_count = 0;
    
    private function __construct() 
    {
        try 
        {
          $this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host') . ';dbname=' . Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));           
        } catch (PDOException $e) 
        {
            die($e->getMessage());
        }        
    }
    
    
    public static  function getInstance() 
    {
        if (isset(self::$_instance)) 
        {            
        } else 
        {
            self::$_instance = new DB();
        }
            return  self::$_instance;
    } 
    
    
    public function query($sql, $params = array()) 
    {
        $this->_error = FALSE;
        if ($this->_query = $this->_pdo->prepare($sql)) 
        {            
            $x = 1;
            if (count($params)) 
            {
                foreach ($params   as $param) 
                {
                    $this->_query->bindValue($x, $param);
                    $x++;
                    
                }
            }
            if ($this->_query->execute()) 
            {               
                $this->_result = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            }else 
            {
                $this->_error = TRUE;
            }
        }
        
        return $this;
    }
    
    
    public  function action($action, $table, $where = array()) 
    {
        if (count($where) === 3) 
        {
            $operators = array('=', '>', '<', '>=', '<=', '<>', '!=');
            
            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];
            
            if (in_array($operator, $operators)) 
            {              
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
                
                if ($this->query($sql, array($value))->error()) 
                {
                    return FALSE;
                }
            }
        } 
        return $this;
    }
    
    
    public function get($table, $where) 
    {
        return $this->action('SELECT *', $table, $where);        
    }
    
    
    
    
    public function delete($table, $where) 
    {
        return $this->action('DELETE', $table, $where);
    }
    
    
    public  function insert($table, $fields = array()) 
    {
        if (count($fields)) 
        {
            $keys = array_keys($fields);
            $values = '';
            $x = 1;
        
            foreach ($fields as $field) 
            {
                $values .= '?';
                if ($x < count($fields)) 
                {
                    $values .= ', ';
                }
                $x++;
            }       
        
            $sql = "INSERT INTO users(`" . implode('`, `', $keys). "`) VALUES ({$values})";      
            if ($this->query($sql, $fields)->error()) 
            {
                return FALSE;
            }        
        }    
        return TRUE;
    }
    
    
    public  function insertbook($table, $fields = array()) 
    {
        if (count($fields)) 
        {
            $keys = array_keys($fields);
            $values = '';
            $x = 1;
        
            foreach ($fields as $field) 
            {
                $values .= '?';
                if ($x < count($fields)) 
                {
                    $values .= ', ';
                }
                    $x++;
            }        
        
            $sql = "INSERT INTO books(`" . implode('`, `', $keys). "`) VALUES ({$values})";        
            if ($this->query($sql, $fields)->error()) 
            {
                return FALSE;
            }
        
        }    
        return TRUE;
    }
    
    
    public  function insertgenre($table, $fields = array()) 
    {
        if (count($fields)) 
        {
            $keys = array_keys($fields);
            $values = '';
            $x = 1;
        
            foreach ($fields as $field) 
            {
                $values .= '?';
                if ($x < count($fields)) 
                {
                    $values .= ', ';
                }
                $x++;
            }     
                
            $sql = "INSERT INTO book_genre(`" . implode('`, `', $keys). "`) VALUES ({$values})";        
            if ($this->query($sql, $fields)->error()) 
            {
                return FALSE;
            }
        
        }
    
        return TRUE;
    }
    public  function insertrequest($table, $fields = array())
    {
        if (count($fields))
        {
            $keys = array_keys($fields);
            $values = '';
            $x = 1;
            
            foreach ($fields as $field)
            {
                $values .= '?';
                if ($x < count($fields))
                {
                    $values .= ', ';
                }
                $x++;
            }
            
            $sql = "INSERT INTO borrow(`" . implode('`, `', $keys). "`) VALUES ({$values})";
            if ($this->query($sql, $fields)->error())
            {
                return FALSE;
            }
            
        }
        return TRUE;
    }
    
    
    public  function insertnewsletter($table, $fields = array())
    {
        if (count($fields))
        {
            $keys = array_keys($fields);
            $values = '';
            $x = 1;
            
            foreach ($fields as $field)
            {
                $values .= '?';
                if ($x < count($fields))
                {
                    $values .= ', ';
                }
                $x++;
            }
            
            $sql = "INSERT INTO newsletter(`" . implode('`, `', $keys). "`) VALUES ({$values})";
            if ($this->query($sql, $fields)->error())
            {
                return FALSE;
            }
            
        }
        return TRUE;
    }
    
    
    public  function insertcontact($table, $fields = array())
    {
        if (count($fields))
        {
            $keys = array_keys($fields);
            $values = '';
            $x = 1;
            
            foreach ($fields as $field)
            {
                $values .= '?';
                if ($x < count($fields))
                {
                    $values .= ', ';
                }
                $x++;
            }
            
            $sql = "INSERT INTO contacts(`" . implode('`, `', $keys). "`) VALUES ({$values})";
            if ($this->query($sql, $fields)->error())
            {
                return FALSE;
            }
            
        }
        return TRUE;
    }   
    
    
    public function update($table, $id, $fields) 
    {
        $set = '';
        $x = 1;
        
        foreach ($fields as $name => $value) 
        {
            $set .= "{$name} = ?";
            if ($x < count($fields)) 
            {
                $set .= ', ';
            }
            $x++;
        }
        
        
        $sql = "UPDATE  {$table} SET {$set}  WHERE user_id = {$id}";        
        if ($this->query($sql, $fields)->error()) 
        {
            return FALSE;
        }
        return TRUE;
    } 
         
        
    
    public function results() 
    {
        return $this->_result; 
    }
    
    
    public function first() 
    {
        return $this->results()[0];
    }
    
    
    public  function error() 
    {
        return  $this->_error;
    }
    
    
    public function count() 
    {
        return $this->_count;
    }
}

?>