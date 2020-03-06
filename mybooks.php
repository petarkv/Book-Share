<?php include_once 'core/init.php';?>

<head>
  <title>Book Sharing Online || Contact</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/screen.css">
</head>

<?php include 'includes/header.php';?>
<?php include 'includes/menubar/menubar_login.php';?>


<section id="books">
<div id="containerbooks">


<div id="content">
  <div id="left">
    <div id="centered">
	<img src="img/take_book.jpg" alt="Avatar woman">
	<h2><a href="mybooks_form.php">MY BOOKS</a></h2>
	<p>Some text.</p>
	</div>
  </div>
<?php $myId = Session::get('user_id');    

$booksall = DB::getInstance()->query("SELECT borrow.id_request,users.username, users.name,
                                      users.surname, users.address, users.city,users.postal_code,
                                      users.state, users.phone_number,books.cover, books.title,
                                      books.author, books.publisher FROM books JOIN 
                                      borrow ON borrow.book_id =books.book_id JOIN 
                                      users ON borrow.user_id = users.user_id WHERE 
                                      borrow.owner_id = $myId AND borrow.is_requestes = 0");
$books = $booksall->results();
$c= count($books);?>

<div id="right">
     <div id="centered">
		<img src="img/give_book.jpg" alt="Avatar man">
		<h2><a href="myrequestsALL_form.php" style="color: black;">MY REQUESTS</a></h2>
		<p><a href="myrequests_form.php" style="color: black;">You got <?php echo $c; ?> active requests</a></p>
	</div>
  </div>
</div>


</div>
</section>

<?php include 'includes/overall/footer.php';?>



<style>

#content { 
  overflow:auto; 
  width: 100%;
  height: 800px; 
  background: gray; 
} 

#left, #right { 
  width: 45%;
  height: 760px; 
  margin:5px; 
  padding: 1em; 
  background: white; 
} 

#left  { float:left;  }
#right { float:right; } 


#centered p {
    font-size: 25px;
    color: black;
    margin-left: 180px;
    margin-top: 20px;
}

#centered h2{    
    margin-left: 180px;
    margin-top: 20px;
    color: black;
}

/* Style the image inside the centered container, if needed */
#centered img {
  width: 250px;
  border-radius: 50%;
  margin-left: 180px;
  margin-top: 200px;
}

</style>