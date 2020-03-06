<?php
require_once 'core/init.php';

$user = new User();
$id = Session::get('user_id');
$userinf = DB::getInstance()->query("SELECT address, postal_code, city, state, phone_number
                                  FROM users WHERE user_id = $id");
$userdetails = $userinf->results();
foreach ($userdetails as $details)  
{
    
    if (Input::exists()) 
    {
        if (Token::check(Input::get('token')));
        
        $validate = new Validation();
        $validation = $validate->check($_POST, array(
            'address' => array(
                'required' => TRUE
            ),
            'postal_code' => array(
                'required' => TRUE
            ),
            'city' => array(
                'required' => TRUE
            ),
            'state' => array(
                'required'=> TRUE
            ),
            'phone_number' => array(
                'required' => TRUE
            )
            
        ));
        
        if ($validation->passed()) 
        {
            try 
            {
                $user->update(array(
                    'address' => Input::get('address'),
                    'postal_code'=>Input::get('postal_code'),
                    'city' => Input::get('city'),
                    'state' => Input::get('state'),
                    'phone_number' => Input::get('phone_number'),
                ));
                
                Session::flash('home', 'You change Your details');
                Redirect::to('index.php');
            } catch (Exception $e) 
            {
                die($e->getMessage());
            }
            
            
        } else 
        {
            foreach ($validation->errors() as $error) 
            {
                echo $error, '<br>';
            }
            
        }
    }
    
    ?>


<form action="" method="post">

<div>
<label for="Address" >Address *</label>
<input type="text" name="address" id="address" value="<?php echo $details->address; ?>">
</div><br>
<div>
<label for="postal_code" >Postal Code *</label>
<input type="text" name="postal_code" id="postal_code" value="<?php echo $details->postal_code; ?>">
</div><br>
<div>
<label for="city" >City *</label>
<input type="text" name="city" id="city" value="<?php echo $details->city; ?>">
</div><br>
<div>
<label for="state" >State *</label>
<input type="text" name="state" id="state" value="<?php echo $details->state; ?>">
</div><br>
<div>
<label for="phone_number" >Phone Number *</label>
<input type="text" name="phone_number" id="phone_number" value="<?php echo $details->phone_number; ?>">
</div><br>
<?php } ?>

<div><p>(*) Required Fields</div>

<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

<input type="submit" name="submitDetails" value="Change">
</form>