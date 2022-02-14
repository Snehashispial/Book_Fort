<?php

//fetch.php

$db = new PDO('mysql:host=localhost;dbname=book_fort', 'root', '');

$query = "
SELECT * FROM books ORDER BY book_id DESC
";
$statement = $db->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$output = '';                                     //we store book data in html format
foreach($result as $row)
{
 $rating = count_rating($row['book_id'], $db);
 $color = '';      //color of star value
 $output .= '                                   
 <h3 class="text-primary">'.$row['name_of_book'].'</h3>
 <ul class="list-inline" data-rating="'.$rating.'" title="Average Rating - '.$rating.'">
 ';
 
 for($count=1; $count<=5; $count++)
 {
  if($count <= $rating)
  {
   $color = 'color:#ffcc00;';                  //show yellow color
  }
  else
  {
   $color = 'color:#ccc;';                     //color property set grey
  }
  $output .= '<li title="'.$count.'" id="'.$row['book_id'].'-'.$count.'" data-index="'.$count.'"  data-business_id="'.$row['book_id'].'" data-rating="'.$rating.'" class="rating" style="cursor:pointer; '.$color.' font-size:16px;">&#9733;</li>';
 }
 $output .= '
 </ul>
 <p>'.$row["category"].'</p>
 <label style="text-danger">'.$row["author"].'</label>
 <hr />
 ';
}
echo $output;                  //sending data to ajax

function count_rating($business_id, $db)
{
 $output = 0;                          //for storing the different rating info
 $query = "SELECT AVG(rating) as rating FROM rating WHERE business_id = '".$business_id."'";   //query of average rating of particular bussiness
 $statement = $db->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $total_row = $statement->rowCount();
 if($total_row > 0)
 {
  foreach($result as $row)
  {
   $output = round($row["rating"]);               //round a floating number with near integer value
  }
 }
 return $output;
}


?>