<?php

require_once 'core/init.php';
include_once 'includes/overall/header.php';


if (Input::exists()) 
{                 
    $validate = new Validation();
    $validation = $validate->check($_POST,array(
    'username' => array('required'=> TRUE, 'existuser' => 'users'),
    'password' => array('required'=> TRUE, 'existpass' => 'users')            
    ));
        
    if ($validation->passed()) 
    {
    $user = new User();
                       
    $login = $user->login(Input::get('username'), Input::get('password'));
            
    if ($login) 
    {
        $id = $user->getUserId();
        Session::put('user_id', $id);
        $name = $user->getUserName();
        Session::put('user_name', $name);                
        Redirect::to('index.php');
                                     
    }else 
    {
        echo "FAILED";
    }           
    }else 
    {
        foreach ($validation->errors() as $error) 
        {
        echo $error, '<br/>';
        }         
           
    }
}
include_once 'includes/overall/footer.php';
?>