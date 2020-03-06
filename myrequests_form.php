<?php require_once 'core/init.php';?>

<?php include 'includes/head.php';?>

<?php include 'includes/header.php';?>

<?php include 'includes/menubar/menubar_login.php';?>

<section id="books">
<div id="containerbooks">
<table id="table">
	<thead>
  		<tr>
  			<th id="rowbook">USER</th>
  			<th id="rowbook">NAME</th>
  			<th id="rowbook">SURNAME</th>
  			<th id="rowbook">ADDRESS</th>
  			<th id="rowbook">CITY</th>
  			<th id="rowbook">POSTAL CODE</th>
  			<th id="rowbook">STATE</th>
  			<th id="rowbook">PHONE NUMBER</th>
  			<th id="rowbook">IMAGINE</th>
    		<th id="rowbook">TITLE</th>
    		<th id="rowbook">AUTHOR</th>
    		<th id="rowbook">PUBLISHER</th>
    		<th id="rowbook">ACTION</th>
    		
  		</tr>
  </thead>
  
<?php

    $myId = Session::get('user_id');    

    $booksall = DB::getInstance()->query("SELECT borrow.id_request,users.username, users.name,
                                          users.surname, users.address, users.city,users.postal_code,
                                          users.state, users.phone_number,books.cover, books.title,
                                          books.author, books.publisher FROM books JOIN 
                                          borrow ON borrow.book_id =books.book_id JOIN 
                                          users ON borrow.user_id = users.user_id 
                                          WHERE borrow.user_id != $myId AND borrow.owner_id = $myId
                                          AND borrow.is_requestes = 0");    
    $books = $booksall->results();
    $pag = new Pagination();
    $data = $books;
    
    $numbers = $pag->Paginate($data, 3);
    $books = $pag->fetchResult();
    
    foreach ($books as $book)
    {
?>

<tr>
	<td id="rowbook"><?php echo $book->username; ?></td>
	<td id="rowbook"><?php echo $book->name; ?></td>
	<td id="rowbook"><?php echo $book->surname; ?></td>
	<td id="rowbook"><?php echo $book->address; ?></td>
	<td id="rowbook"><?php echo $book->city; ?></td>
	<td id="rowbook"><?php echo $book->postal_code; ?></td>
	<td id="rowbook"><?php echo $book->state; ?></td>
	<td id="rowbook"><?php echo $book->phone_number; ?></td>
    <td id="rowbook"><?php echo '<img src="'. $book->cover.'"width="100px" height="150px"/>'?></td>
    <td id="rowbook"><?php echo $book->title ?></td>
    <td id="rowbook"><?php echo $book->author ?></td>
    <td id="rowbook"><?php echo $book->publisher ?></td>
    <td id="rowbook"><?php echo '<form type="get"><input  name="idRequest" type="hidden"  value="'. "$book->id_request" .'">
                                 <input type="submit" name="submit_accept" value="ACCEPT">  
                                 <input type="submit" name="submit_decline" value="DECLINE"></form>';
        
    
    ?>
   
    </td>
    
  </tr>
<?php 
    }
    ?>  
</table>



<?php 

echo '<div class="pagination">';

if (isset($_GET["page"] ))
{
    $current_page  = $_GET["page"];
}
else
{
    $current_page=1;
};


if($current_page>1)
{
    echo '<a href="myrequests_form.php?page='.($current_page-1).'">&laquo Previous</a>';
}


foreach ($numbers as $num)
{
    
    if($num == $current_page){
        echo '<a class="active">'.$num.'</a>';
    }else
        
        
        echo '<a href="myrequests_form.php?page='.$num.'">'.$num.'</a>';
}


if($current_page<$num)
{
    echo '<a href="myrequests_form.php?page='.($current_page+1).'">Next &raquo</a>';
}
echo '</div>';
?>
<?php
if(isset($_GET['submit_accept']))
{
    $id_req = Input::get('idRequest');
    $user = DB::getInstance()->query("SELECT books.book_id FROM books JOIN borrow ON
                                      borrow.book_id = books.book_id WHERE borrow.id_request =$id_req");
    
    $idbooks = $user->results();
    foreach ($idbooks as $book) {
        $user->query("UPDATE books SET is_borrowed=1 WHERE book_id= $book->book_id");
        $user->query("UPDATE borrow SET is_requestes = 1 WHERE id_request= $id_req");
    }
}
?>
<?php
if(isset($_GET['submit_decline']))
{
    $id_req = Input::get('idRequest');
    $user = DB::getInstance()->query("SELECT books.book_id FROM books JOIN borrow ON
                                      borrow.book_id = books.book_id WHERE borrow.id_request =$id_req");
    
    $idbooks = $user->results();
    foreach ($idbooks as $book) {
       // $user->query("UPDATE books SET is_borrowed=1 WHERE book_id= $book->book_id");
        $user->query("UPDATE borrow SET is_requestes = 2 WHERE id_request= $id_req");
    }
}
?>
</div>
</section>

<?php include 'includes/overall/footer.php';?>