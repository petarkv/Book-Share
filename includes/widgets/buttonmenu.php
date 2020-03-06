<?php require_once 'core/init.php';?>

<button onclick="myFunction()" class="dropbtn"><?php echo 'Hello '.Session::get('user_name').' !';?></button>
	<div id="myDropdown" class="dropdown-content">

		<a href="books_upload.php">Upload Books</a>
		<a href="mybooks.php">My Books</a>
		<a href="changepassword.php">Change Password</a>
		<a href="changedetails.php">Change My Details</a>
		<a href="logout.php">Logout</a>
	</div>


<script>

/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() 
{
  document.getElementById("myDropdown").classList.toggle("show");
}



//Close the dropdown if the user clicks outside of it
window.onclick = function(e) 
{	
	if (!e.target.matches('.dropbtn')) 
	  {
  		var myDropdown = document.getElementById("myDropdown");
    	if (myDropdown.classList.contains('show')) 
        {
      		myDropdown.classList.remove('show');
    	}
  	  }
}

</script>