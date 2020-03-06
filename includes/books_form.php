<?php require_once 'core/init.php';?>
<?php if(isset($_GET['submit_btn']))
{
    $id = Input::get('idBook');
    $elementsObj = DB::getInstance()->query("SELECT user_id,book_id FROM books WHERE book_id = $id");
    $elements = $elementsObj->results(); 
    foreach ($elements as $element){
        $user_id =  $element->user_id;
        $book_id = $element->book_id;
        $date = date('Y-m-d H:i:s');
    }
    try
    {
        $user = new User();
        $user->request(array(
            'user_id' => Session::get('user_id'),
            'owner_id' => $user_id,
            'book_id' => $book_id,
            'date' => $date,
            'is_requestes' => 0
        ));
       
    } catch (Exception $e)
    {
        die();
    }
}
?>
 <div class="searchbooks">
 <h1>Find Book For You</h1>
 <form action="books.php" method="get">
 <div class="form-box">
 <input value="<?php echo isset($_GET['keywords']) && $_GET['keywords'] ? $_GET['keywords']: ''?>" type="text" name="keywords" class="search-field" placeholder="Enter Book Title or Author Name" autocomplete="off" required>
 <button class="search-btn" type="submit" name="submit">Search Books</button> 
 </div> 
 </form> 
 </div><br>
 
 <div class="bookgenre">
    <label for="genresearch" >Search Books by Genre</label>
	<select id="genresearch" name="genresearch">
<?php
    
    $query = DB::getInstance()->query("SELECT * FROM genre");
    $genre = $query->results();
    //print_r($genre);
    foreach ($genre as $g){        
        echo "<option value='$g->genre_id'>$g->name</option>";
    }
?>
   
	</select>
</div><br>
 
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
$logUser = Session::get('user_id');
if($_GET)
{
    $myId = Session::get('user_id');
    $keywords = Input::get("keywords");
    $search = DB::getInstance()->query("SELECT * FROM books WHERE (title LIKE '%".$keywords."%' OR author LIKE '%".$keywords."%') AND user_id != $myId");
    $books = $search->results();
  
}else 
    {   
    $booksall = DB::getInstance()->query("SELECT * FROM books WHERE user_id != $logUser");    
    $books = $booksall->results();    
    }
    
    $pag = new Pagination();
    $data = $books;
    
    $numbers = $pag->Paginate($data, 3);
    $books = $pag->fetchResult();
    foreach ($books as $book){
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
        echo '<form type="get"><input  name="idBook" type="hidden" value="'. "$book->book_id " .'">
              <input type="submit" name="submit_btn" value="BORROW"></form>';
    }else {
        echo 'NOT AVAILABLE';
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
    echo '<a href="books.php?page='.($current_page-1).'">&laquo Previous</a>';
}
foreach ($numbers as $num)
{
    
    if($num == $current_page)
    {
        echo '<a class="active">'.$num.'</a>';
    }else
        echo '<a href="books.php?page='.$num.'">'.$num.'</a>';
}
if($current_page<$num)
{
    echo '<a href="books.php?page='.($current_page+1).'">Next &raquo</a>';
}
echo '</div>';
?>