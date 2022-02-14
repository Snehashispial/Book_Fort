<?php
  include "connection.php";
  include "header1.php";

  $output="";
  
  if(isset($_POST['q'])){
   $book_id=$_POST['book_id'];
   $sql="Delete from books where book_id='$book_id'";

   if(mysqli_query($db,$sql)){
    $output='<div class="alert alert-success">Books Removed Successfully</div>';
   }
   else
   {
    $output='<div class="alert alert-danger">Error occured try again</div>';
   }

  }

  ?>
  <br>
  <br>
  

<!DOCTYPE html>
<html>
<head>
  <title>Books</title>
  <style type="text/css">
    .srch
    {
      padding-right: 1300px ;
    }
  </style>

</head>
<body>
    <div class="srch">
      <form class="navbar-form" method="post" name="form1">
        
          <input class="form-control" type="text" name="book_id" placeholder="Enter Book Id..." aria-label="Search"> 
          <button style="background-color: #6db6b9e6;" type="submit" name="q" class="btn btn-success" value="Delete"> &nbsp;
            


                 <SPAN class="glyphicon glyphicon-search">
                  

                 </SPAN>
                 
   

                 
                </button> 
                         
        
      </form>
       <?php echo  $output; ?>
    </div>
  </body>
  </html>













 <!--<div class="container" >
    <div class="row">
      <div class="col-lg-2">
      </div>

      <div class= "col-lg-10">
          <form class="form-inline" method="post">

    <input class="form-control mr-sm-2" name="book_id" type="text" placeholder="Enter Book Id" aria-label="Search">
    <button class="btn btn-success" name="q" type="submit" value="Delete"> &nbsp;&nbsp;
   
  </form>
  <br>
    <?php  $output; ?>
  
        </div>
      </div>
    </div>-->