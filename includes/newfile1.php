<?php include_once '../core/init.php';?>
<table style="width: 50%" border= "1">
<thead>
  <tr>
  	<th>IMAGINE</th>
    <th>TITLE</th>
    <th>AUTHOR</th>
    <th>PUBLISHER</th>
    <th>DESCRIPTION</th>
    <th>UPLODAED</th>
    <th>MODIFIED</th>
    <th>BORROW</th>
  </tr>
  </thead>
<?php 

$id = Session::get('user_id');
echo $id;
$bookss = DB::getInstance()->query("SELECT * FROM books WHERE user_id = $id ");
//print_r($books);
$books = $bookss->results();
$pag = new Pagination();
$data = $books;

$numbers = $pag->Paginate($data, 4);
$books = $pag->fetchResult();
foreach ($books as $book)
{
    
    ?>
<tr>
    <td id="rowbook"><?php echo '<img src="'. $book->cover.'"width="100px" height="100px"/>'?></td>
    <td id="rowbook"><?php echo $book->title ?></td>
    <td id="rowbook"><?php echo $book->author ?></td>
    <td id="rowbook"><?php echo $book->publisher ?></td>
    <td id="rowbook"><?php echo $book->about_book ?></td>
    <td id="rowbook"><?php echo $book->date_upload ?></td>
    <td id="rowbook"><?php echo $book->date_modified ?></td>
    <td id="rowbook"><?php if ($book->is_borrowed == 0) 
    {
        echo 'AVAILABLE';
    }else 
    {
        echo 'NOT AVAILABLE';
    }
    ?>
    </td>
    
</tr>
<?php 
}
?>
</table>
    
<div class="pagination">    
<?php 

foreach ($numbers as $num)
{
    echo '<a href="newfile1.php?page='.$num.'">'.$num.'</a>';
}
?>
</div>