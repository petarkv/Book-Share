<?php

class User 
{
    
    private $_db,
            $_data,
            $_sessionName,
            $_isLoggedIn;
   
   
    
    public function __construct($user = NULL) 
    {
        $this->_db = DB::getInstance();        
        $this->_sessionName = Config::get('session/session_name');        
        
        if (!$user) 
        {
            if (Session::exists($this->_sessionName)) 
            {
                $user = Session::get($this->_sessionName);
                
                if ($this->find($user)) 
                {
                    $this->_isLoggedIn = TRUE;
                } else 
                {                  
                }
            }
        } else 
        {
            $this->find($user);
        }                
    }
    
    
    public function update($fields = array(), $id = NULL) 
    {
        
        if (!$id && $this->isLoggedIn()) 
        {         
            $id = $this->data()->user_id;
        }
        
        if (!$this->_db->update('users', $id, $fields)) 
        {
            throw new Exception('There was a problem updating');
        }
    }
    
    
    public function create($fields = array()) 
    {
        if ($this->_db->insert('users', $fields)) 
        {
        }else 
        {
            throw new Exception('There was a problem creating an account.');
        }
    }
    
    public function uploadbooks($fields = array()) 
    {
        if ($this->_db->insertbook('books', $fields)) 
        { 
        }else 
        {
            throw new Exception('There was a problem creating an account.');
        }
    }
    
    
    public function uploadgenre($fields = array()) 
    {
        if ($this->_db->insertgenre('book_genre', $fields)) 
        {
        }else 
        {
            throw new Exception('There was a problem creating an account.');
        }
    }
    
    public function request($fields = array())
    {
        if ($this->_db->insertrequest('borrow', $fields))
        {
        }else
        {
            throw new Exception('There was a problem creating an account.');
        }
    } 
    
    
    public function newsletter($fields = array())
    {
        if ($this->_db->insertnewsletter('newsletter', $fields))
        {
            
        }else
        {
            throw new Exception('There was a problem creating an newsletter.');
        }
    }
    
    
    public function contact($fields = array())
    {
        if ($this->_db->insertcontact('contacts', $fields))
        {
            
        }else
        {
            throw new Exception('There was a problem creating an contact.');
        }
    }
    
    
    public function find($user = NULL)
    {
        if ($user) 
        {
            $field = (is_numeric($user)) ? 'user_id' : 'username';
            $data = $this->_db->get('users', array($field, '=', $user));
    
            if ($data->count()) 
            {
                $this->_data = $data->first();
                return  TRUE;
            }
            return FALSE;
        }
    }
 
    public function exists()
    {
     return (empty($this->_data)) ? FALSE : TRUE;
    }
 
 
    public function existsPassword($password) 
    {
     return ($this->data()->password === $password) ? TRUE : FALSE;
    }
 
    
    public function login($username = NULL, $password = NULL)
    {
        $user = $this->find($username);        
        if ($user) 
        {            
         
            if ($this->data()->password === $password) 
            {        
                Session::put($this->_sessionName, $this->data()->user_id);               
                return TRUE;                
            }
        }        
        return FALSE;
    }
    
    
    
    public function logout() 
    {
        Session::delete($this->_sessionName);
    }
    
        
   public function data() 
   {
        return $this->_data;
   }
        
        
    public function isLoggedIn()
    {
        return $this->_isLoggedIn;
    }        
        
    public function getUserId() 
    {
        return $this->data()->user_id;
    }
        
    public function getUserName() 
    {
        return $this->data()->name;
    }
}
?>