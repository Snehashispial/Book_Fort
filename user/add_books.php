 <?php
  include "header1.php";
  include "connection.php";
   $bookId_error=$bookname_error=$author_error=$price_error=$category_error=$isbn_error=$file_error="";

   $bookId=$bookname=$author=$price=$category=$isbn=$file= $status="";

   if(isset($_POST['submit']))
   {
   	//validate book name
   	if(empty($_POST['name_of_book']))
   	{

      $bookname_error="Please enter book name";

   	}
   	else
   	{
   		$bookname= test_input($_POST["name_of_book"]);
   		$name_pattern= '/^[a-zA-Z ]+$/';
   		if(!preg_match($name_pattern, $bookname))
   		{
   			$bookname_error="Please enter valid book name";
   		}
   	}
   	//validate author name
   	  	if(empty($_POST['author']))
   	{

      $author_error="Please enter author name";

   	}
   	else
   	{
   		$author= test_input($_POST["author"]);
   		$author_pattern= '/^[a-zA-Z ]+$/';
   		if(!preg_match($author_pattern, $author))
   		{
   			$author_error="Please enter valid author name";
   		}
   	}

   	//validate price
   	  	if(empty($_POST['price']))
   	{

      $price_error="Please enter price";

   	}
   	else
   	{
   		$price= test_input($_POST["price"]);
   		$price_pattern= '/^[0-9-a-zA-Z ]+$/';
   		if(!preg_match($price_pattern, $price))
   		{
   			$price_error="Please enter valid price";
   		}
   	}
   	//validate category
   		  	if(empty($_POST['category']))
   	{

      $category_error="Please enter book category";

   	}
   	else
   	{
   		$category= test_input($_POST["category"]);
   		$category_pattern= '/^[a-zA-Z ]+$/';
   		if(!preg_match($category_pattern, $category))
   		{
   			$category_error="Please enter valid category";
   		}
   	}

   	//validate book id

   	 		  	if(empty($_POST['book_id']))
   	{

      $bookId_error="Please enter book id";

   	}
   	else
   	{
   		$bookId= test_input($_POST["book_id"]);
   		$book_pattern= '/^[0-9]+$/';
   		if(!preg_match($book_pattern, $bookId))
   		{
   			$bookId_error="Please enter valid book_id";
   		}
   	}

   	//validate isbn


   	 		  	if(empty($_POST['isbn']))
   	{

      $isbn_error="Please enter isbn number";

   	}
   	else
   	{
   		$isbn= test_input($_POST["isbn"]);
   		$isbn_pattern= '/^[0-9-#-a-zA-Z]+$/';
   		if(!preg_match($isbn_pattern, $isbn))
   		{
   			$isbn_error="Please enter valid isbn";
   		}
   	}

   	//validate book image

   		if(!isset($_FILES['img']))
   	{

      $file_error="Please select a image";

   	}
   	else
   	{
   		$target= "images/";
   		$file_name=$_FILES['img']['name'];
   		$file_type=$_FILES['img']['type'];
   		$file_size=$_FILES['img']['size'];
   		$tmp_name= $_FILES['img']['tmp_name'];
   		$allowed= array('jpg'=>'image/jpg','jpeg'=>'image/jpeg','png'=>'image/png');

   		if(!in_array($file_type, $allowed))
   		{
   			$file_error="Please select jpg/jpeg/png file";
   		}

   		$maxsize=1*1024*1024;
   		if($file_size>$maxsize)
   		{
   			$file_error="File size is greater than 1 MB";
   		}

   		if(in_array($file_type, $allowed) && $file_size<$maxsize && $_FILES['img']['error']===0)
   		{
          $newname= rand().$file_name;
          $target= $target.$newname;
          $file=$target;

          move_uploaded_file($tmp_name, $target);
         

   		}
   
   	}

   	if(empty($bookname_error) && empty($author_error) && empty($price_error) && empty($category_error) && empty($file_error))
   	{
      $sql="INSERT INTO books values('$bookId','$bookname','$author','$price','$category','$isbn','$file')";
      if(mysqli_query($db,$sql))
      {
      	$status= '<div class="alert alert-success">Successfully added book</div>';
      }
      else
      {
       	$status= '<div class="alert alert-success">Error adding books</div>'; 

      }

   	}

   


   }

   function test_input($data){
    $data= trim($data);
    $data= stripslashes($data);
    $data= htmlspecialchars($data);
    return $data;
   }

   ?> 
<div class="container" >
    <div class="row" style="margin-right: 80px">
  
      <div class= "col-lg-12">
      	<div class="row">

      		  <div class= "col-sm-3"> </div>

      		   <div class= "col-sm-5"> 

      		   	<h4 class="text-warning"> Provide below details to add book</h4><br>

      		   	<span><?php echo $status; ?> </span>

          <form class="form" method="post" enctype="multipart/form-data">
          	<div class="form-group">
          		<label for=""> Book Id  </label>
          		<input type="text" name="book_id" value="" class="form-control">
                <span class="text-danger"><?php echo $bookId_error; ?></span>

          	</div>

          		<div class="form-group">
          		<label for=""> Name Of Book  </label>
          		<input type="text" name="name_of_book" value="" class="form-control">
                <span class="text-danger"><?php echo $bookname_error; ?></span>

          	</div>

	                <div class="form-group">
          		<label for=""> Author  </label>
          		<input type="text" name="author" value="" class="form-control">
                <span class="text-danger"><?php echo $author_error; ?></span>

          	</div>

          	  <div class="form-group">
          		<label for=""> Price  </label>
          		<input type="text" name="price" value="" class="form-control">
                <span class="text-danger"><?php echo $price_error; ?></span>

          	</div>

          	<div class="form-group">
          		<label for=""> Category  </label>
          		<input type="text" name="category" value="" class="form-control">
                <span class="text-danger"><?php echo $category_error; ?></span>

          	</div>

          	<div class="form-group">
          		<label for=""> ISBN  </label>
          		<input type="text" name="isbn" value="" class="form-control">
                <span class="text-danger"><?php echo $isbn_error; ?></span>

          	</div>

          	<div class="form-group">
          		<label for=""> Upload Book Image </label>
          		<input type="file" name="img" value="" class="form-control">
                <span class="text-danger"><?php echo $file_error; ?></span>

          	</div>

          	<div class="form-group">
          <input type="submit" name="submit" value="Add Book" class="btn btn-success">
          	</div>





  </form>

      		   </div>

      		     <div class= "col-sm-4"> 


      		   </div>

      		</div>

  
        </div>
      </div>
    </div>