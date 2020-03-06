<?php require_once 'core/init.php';?>

<?php include 'includes/head.php';?>

<?php include 'includes/header.php';?>

<?php include 'includes/menubar/menubar_login.php';?>

<section id="books">
<div id="containerbooks">
<table id="table">
	<thead>
  		<tr>
  			<th id="rowbook">IMAGINE</th>
    		<th id="rowbook">TITLE</th>
    		<th id="rowbook">AUTHOR</th>
    		<th id="rowbook">PUBLISHER</th>
    		<th id="rowbook">DESCRIPTION</th>
    		<th id="rowbook">UPLODAED</th>
    		<th id="rowbook">MODIFIED</th>
    		<th id="rowbook">BORROW</th>
  		</tr>
  </thead>
  
<?php

    $myId = Session::get('user_id');    

    $booksall = DB::getInstance()->query("SELECT * FROM books WHERE user_id = $myId");    
    $books = $booksall->results(); 
    
    $pag = new Pagination();
    $data = $books;
    
    $numbers = $pag->Paginate($data, 4);
    $books = $pag->fetchResult();
    
    foreach ($books as $book)
    {
?>

<tr>
    <td id="rowbook"><?php echo '<img src="uploads/'. $book->cover.'"width="100px" height="150px"/>'?></td>
    <td id="rowbook"><?php echo $book->title ?></td>
    <td id="rowbook"><?php echo $book->author ?></td>
    <td id="rowbook"><?php echo $book->publisher ?></td>
    <td id="rowbook"><?php echo $book->about_book ?></td>
    <td id="rowbook"><?php echo $book->date_upload ?></td>
    <td id="rowbook"><?php echo $book->date_modified ?></td>
    <td id="rowbook"><?php if ($book->is_borrowed == 0) {
        echo '<p style="color: blue;">AVAILABLE</p>';
    }else 
    {
        echo '<p style="color: red;">BORROW</p>
              <form type="get"><input  name="idReturned" type="hidden"  value="'. "$book->book_id" .'">
              <input type="submit" name="submit_returned" value="RETURNED"></form>';
    }
    ?></td>
    
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
    echo '<a href="mybooks_form.php?page='.($current_page-1).'">&laquo Previous</a>';
}


foreach ($numbers as $num)
{
    
    if($num == $current_page){
        echo '<a class="active">'.$num.'</a>';
    }else
        
        
        echo '<a href="mybooks_form.php?page='.$num.'">'.$num.'</a>';
}


if($current_page<$num)
{
    echo '<a href="mybooks_form.php?page='.($current_page+1).'">Next &raquo</a>';
}
echo '</div>';
?>
</div>
</section>
<?php if(isset($_GET['submit_returned']))
{
    $id_ret = Input::get('idReturned');
   $user = DB::getInstance();
    $user->query("UPDATE books SET is_borrowed=0 WHERE book_id= $id_ret");
}
?>
<?php include 'includes/overall/footer.php';?>