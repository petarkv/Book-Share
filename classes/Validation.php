<?php

class Validation 
{
    private $_passed = false,
            $_errors = array(),
            $_db = NULL;
    
    public function __construct()
    {
        $this->_db = Db::getInstance();        
    }    
    
    public function check($source, $items = array()) 
    {
        foreach ($items AS $item => $rules) 
        {
            foreach ($rules as $rule => $rule_value) 
            {
                
                $value = trim($source[$item]);
                $item = escape($item);
                
                if ($rule === 'required' && empty($value)) 
                {
                    $this->addError("{$item} required");
                }elseif (empty($value))
                {
                    
                }else 
                {
                    switch ($rule) 
                    {
                        case 'min':
                            if (strlen($value) < $rule_value) 
                            {
                            $this->addError("{$item} must be minimum of {$rule_value} characters");
                            }
                            break;
                            
                        case 'max':
                            if (strlen($value) > $rule_value) 
                            {
                                $this->addError("{$item} must be maximun of {$rule_value} characters");
                            }
                            break;
                            
                        case 'matches':
                            if ($value != $source[$rule_value]) 
                            {
                                $this->addError("{$rule_value} must match with {$item} ");
                            }
                            break;                        
                            
                        case 'unique':
                            $check = $this->_db->get($rule_value, array($item,'=',$value));
                            if ($check->count()) 
                            {
                                $this->addError("{$item} already exist.");
                            }
                            break;                           
                            
                        case 'existuser':
                            $check = $this->_db->get($rule_value, array($item,'=',$value));
                            if ($check->count()===0)
                            {
                                $this->addError("{$item}  don\'t exists");
                            }
                            break;
                            
                        case 'existpass':
                            $check = $this->_db->get($rule_value, array($item,'=',$value));
                            if ($check->count()===0)
                            {
                                $this->addError("{$item} Wrong Password");
                            }
                            break;
                    }
                }
            }
        }
        if (empty($this->_errors)) 
        {
            $this->_passed = TRUE;
        }
        
        return $this;
    }
    
    private function addError($error) 
    {
        $this->_errors[] = $error;
    }
   
    public function errors() 
    {
        return $this->_errors;
    } 
    
    public function passed() 
    {
        return $this->_passed;
    }
}
?>
