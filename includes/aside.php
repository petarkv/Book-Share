<aside>
<?php 

if (Session::exists('user_id')) 
{  
} else 
{
    include 'includes/widgets/login.php';
}

?>			
</aside>
