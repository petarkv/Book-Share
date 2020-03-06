<?php
if (Input::exists()) {
    if(Token::check(Input::get('token'))) {
       
        $validate = new Validation();
        $validation = $validate->check($_POST, array(
            'title' => array(               
                'required' => true                
            ),
            
            'author' => array(
                'required' => true                
            ), 
            
            'genre' => array(
                'required' => true
                
            ) 
            
        ));
        
        if ($validation->passed()) {
                
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "books_sharing";
            
            try {
                
                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_USE_BUFFERED_QUERY );                    
                    $user_id=Session::get('user_id');
                    $title = Input::get('title');
                    $author = Input::get('author');
                    $publisher = Input::get('publisher');
                    $cover = $_FILES["fileToUpload"]["name"];
                    $about_book = Input::get('about_book');
                    $date_upload = date('Y-m-d H:i:s');
                    $date_modified = date('Y-m-d H:i:s');
                    
                    $target_dir = "uploads/";
                    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                    if($check == TRUE)
                    {
                        echo "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else
                    {
                        echo "File is not an image.";
                        $uploadOk = 0;
                    }
                    if (file_exists($target_file))
                    {
                        echo "Sorry, file already exists.";
                        $uploadOk = 0;
                    }
                    if ($_FILES["fileToUpload"]["size"] > 500000)
                    {
                        echo "Sorry, your file is too large.";
                        $uploadOk = 0;
                    }
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                        && $imageFileType != "gif" )
                    {
                        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        $uploadOk = 0;
                    }
                    if ($uploadOk == 0)
                    {
                        echo "Sorry, your file was not uploaded.";
                    } else
                    {
                        $sql = "INSERT INTO books (user_id, title, author,publisher,cover,about_book,
                        date_upload,date_modified)
                        VALUES ('$user_id', '$title', '$author', '$publisher', '$cover', '$about_book',
                        '$date_upload','$date_modified')";
                        $conn->exec($sql);
                        $last_id = $conn->lastInsertId();
                        
                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
                        {
                            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                        } else
                        {
                            echo "Sorry, there was an error uploading your file.";
                        }
                    }
                                     
            }
            catch(PDOException $e)
            {
                echo $sql . "<br>" . $e->getMessage();
            }
           try {
               
                $generID = Input::get('genre');
                {
                   
                }
            }
            catch(PDOException $e)
            {
                echo $sql . "<br>" . $e->getMessage();
            }
            try {
                $sql2 = "INSERT INTO book_genre (book_id, genre_id)
                VALUES ('$last_id', '$generID')";
                $conn->exec($sql2);
                
            }
            catch(PDOException $e)
            {
                echo $sql . "<br>" . $e->getMessage();
            }
            $conn = null;
           
            
            
        } else {
            //print_r($validation->errors());
            foreach ($validation->errors() as $error){
                echo $error, '<br>';
            }
        }
   }
}
?>


<form action="" method="post" enctype="multipart/form-data">

<div>
<label for="title" >Book Title *</label>
<input type="text" name="title" value="" id="title">
</div><br>

<div>
<label for="author" >Author *</label>
<input type="text" name="author" value="" id="author">
</div><br>

<div>
    <label for="genre" >Genre *</label>
	<select id="cmbGenre" name="genre" >
			<option value=""></option>

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

<div>
<label for="publisher">Publisher</label>
<input type="text" name="publisher" id="publisher">
</div><br>

<div>
<label for="cover">Book Cover</label>
<input type="file" name="fileToUpload">

</div><br>


<div>
<label for="about_book">About Book</label>
<textarea name="about_book" rows="4" cols="40" placeholder="Write Something About Book.."></textarea>
</div><br>

<div><p>(*) Required Fields</div>

<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

<input type="submit" name="submit1" value="Upload Book">
</form>