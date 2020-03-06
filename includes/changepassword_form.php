<?php

require_once 'core/init.php';

$user = new User();

if (Input::exists()) 
{
    if (Token::check(Input::get('token'))) 
    {        
        $validate = new Validation();
        $validation = $validate->check($_POST, array(
            'password_current' => array(
                'required' => TRUE,
                'min' => 6
            ),
            'password_new' => array(
                'required' => TRUE,
                'min' => 6
            ),
            'password_new_retype' => array(
                'required' => TRUE,
                'min' => 6,
                'matches' => 'password_new'
            )
            
        ));
        
        if ($validation->passed()) 
        {
            if (Input::get('password_current') === ($user->data()->password)) 
            {
                $user->data()->password;
                $user->update(array(
                    'password' => Input::get('password_new')
                ));
                Session::flash('home', 'You changed Your password');
                Redirect::to('index.php');
            }else 
            {
                echo 'Your current password is wrong';                
            }
                       
            
        }else
        {            
            foreach ($validation->errors() as $error) 
            {
                echo $error;
            }
        }
    }
}

?>

<form action="" method="post" id="" >

	<div class="field">
		<label for="password_current">Current password</label>
			<input type="Password" placeholder="Current password" name="password_current" id="password_current" autocomplete="off">
	</div>
	<div class="field">
		<label for="password_new">New password</label>
			<input type="Password" placeholder="New password" name="password_new" id="password_new" autocomplete="off">
	</div>
	<div class="field">
		<label for="password_new_retype">Retype Password</label>
			<input type="Password" placeholder="Retype Password" name="password_new_retype" id="password_new_retype" autocomplete="off">
	</div>
		<input type="submit" value="Change password" name="change_password">
		<input type="hidden" name="token" value="<?php echo Token::generate();?>">
</form>