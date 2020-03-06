<?php

require_once 'core/init.php';

if (Input::exists()) 
{
    if(Token::check(Input::get('token'))) 
    {       
        $validate = new Validation();
        $validation = $validate->check($_POST, array(
            'username' => array(                
                'required' => true,
                'min' => 2,
                'max' => 20,
                'unique' => 'users'
            ),
            'password' => array(
                'required' => true,
                'min' => 6
            ),
            'password_again' => array(
                'required' => true,
                'matches' => 'password'
            ),
            'name' => array(
                'required' => true,
                'min' => 2,
                'max' => 50
            )
            
        ));
        
        if ($validation->passed()) 
        {            
            $user = new User();           
            
            try 
            {
                
                $user->create(array(
                    'name' => Input::get('name'),
                    'surname' => Input::get('surname'),
                    'date_of_birth' => Input::get('date_of_birth'),
                    'address' => Input::get('address'),
                    'postal_code' => Input::get('postal_code'),
                    'city' => Input::get('city'),
                    'state' => Input::get('state'),
                    'email' => Input::get('email'),
                    'phone_number' => Input::get('phone_number'),
                    'gender' => Input::get('gender'),
                    'username' => Input::get('username'),                   
                    'password' => Input::get('password'),                   
                    'admin' => 0   
                ));
                
                Session::flash('home', 'You have been registered and can now log in!');
                header('location: index.php');
                               
            } catch (Exception $e) 
            {
                die();
            }
        } else 
        {            
            foreach ($validation->errors() as $error)
            {
                echo $error, '<br>';
            }
        }
    }
}
?>



<form action="" method="post">

	<div>
		<label for="name" >Name</label>
		<input type="text" name="name" value="<?php echo escape(Input::get('name')); ?>" id="name">
	</div>

	<div>
		<label for="surname" >Surname</label>
		<input type="text" name="surname" value="<?php echo escape(Input::get('surname')); ?>" id="surname">
	</div>

	<div>
		<label for="date_of_birth">Date of Birth</label>
		<input type="date" name="date_of_birth" value="<?php echo escape(Input::get("date_of_birth")); ?> "id="date_of_birth">
	</div>

	<div>
		<label for="address">Address</label>
		<input type="text" name="address" id="address">
	</div>

	<div>
		<label for="postal_code">Postal Code</label>
		<input type="text" name="postal_code" id="postal_code">
	</div>

	<div>
		<label for="city">City</label>
		<input type="text" name="city" id="city">
	</div>

	<div>
		<label for="state">State</label>
		<input type="text" name="state" id="state">
	</div>

	<div>
		<label for="email">E-mail</label>
		<input type="email" name="email" id="email">
	</div>

	<div>
		<label for="phone_number">Phone Number</label>
		<input type="text" name="phone_number" id="phone_number">
	</div>

	<div>
		<label for="gender" >Gender</label>
		<input type="radio" name="gender" value="Male">Male <input type="radio" name="gender" value="Female">Female
	</div>

	<div>
		<label for="username">Username</label>
		<input type="text" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>" autocomplete="off">
	</div>

	<div>
		<label for="password">Choose a password</label>
		<input type="password" name="password" id="password">
	</div>

	<div>
		<label for="password_again">Repeat Password</label>
		<input type="password" name="password_again" id="password_again">
	</div>

	<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

	<input type="submit" value="Register">
</form>