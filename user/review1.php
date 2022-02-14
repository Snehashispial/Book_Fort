<?php
//index.php
?>
<!DOCTYPE html>
<html>
 <head>
  <title>Rating System</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
  <div class="container" style="width:800px;">
   <h2 align="center">Please rate our book </h2>
   <br />
   <span id="business_list"></span>              <!-- add for star related feature-->
   <br />
   <br />
  </div>
 </body>
</html>

<script>
$(document).ready(function(){
 
 load_business_data();                                //this will print the data to web page
 
 function load_business_data()
 {
  $.ajax({
   url:"fetch1.php",                                   //fetch data from book table action done in fetch1.php page
   method:"POST",
   success:function(data)                              //this function will execute when data fetched from server
   {
    $('#business_list').html(data);                      //this will display all the info in html format
   }
  });
 }
 
 $(document).on('mouseenter', '.rating', function(){                   //when we click a business rating then the code execute
  var index = $(this).data("index");                                     //we can store value of a particular class
  var business_id = $(this).data('business_id');
  remove_background(business_id);
  for(var count = 1; count<=index; count++)
  {
   $('#'+business_id+'-'+count).css('color', '#ffcc00');                      //star color change to yellow
  }
 });
 
 function remove_background(business_id)                                      //star color change to gray
 {
  for(var count = 1; count <= 5; count++)
  {
   $('#'+business_id+'-'+count).css('color', '#ccc');
  }
 }
 
 $(document).on('mouseleave', '.rating', function(){
  var index = $(this).data("index");
  var business_id = $(this).data('business_id');
  var rating = $(this).data("rating");
  remove_background(business_id);                             //all stars to grey
  //alert(rating);
  for(var count = 1; count<=rating; count++)
  {
   $('#'+business_id+'-'+count).css('color', '#ffcc00');
  }
 });
 
 $(document).on('click', '.rating', function(){
  var index = $(this).data("index");
  var business_id = $(this).data('business_id');                     //work for fetching data
  $.ajax({
   url:"insert_rating.php",
   method:"POST",                                                        //send data to server
   data:{index:index, business_id:business_id},
   success:function(data)                                             //server accessed successfully
   {
    if(data == 'done')                                                
    {
     alert("There is some problem in System");
    }
    else
    {
     

      load_business_data();
     alert("You have rate "+index +" out of 5");
    }
   }
  });
  
 });

});
</script>

