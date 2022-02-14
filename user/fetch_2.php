
<?php

//fetch.php

$connect = new PDO('mysql:host=localhost;dbname=book_fort', 'root', '');

$query = "
SELECT * FROM books ORDER BY book_id DESC
";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$output = '';
foreach($result as $row)
{
 $rating = count_rating($row['book_id'], $connect);
 $color = '';
 $output .= '
 <h3 class="text-primary">'.$row['name_of_book'].'</h3>
 <ul class="list-inline" data-rating="'.$rating.'" title="Average Rating - '.$rating.'">
 ';
 
 for($count=1; $count<=5; $count++)
 {
  if($count <= $rating)
  {
   $color = 'color:#ffcc00;';
  }
  else
  {
   $color = 'color:#ccc;';
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
echo $output;

function count_rating($business_id, $connect)
{
 $output = 0;
 $query = "SELECT AVG(rating) as rating FROM rating WHERE business_id = '".$business_id."'";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $total_row = $statement->rowCount();
 if($total_row > 0)
 {
  foreach($result as $row)
  {
   $output = round($row["rating"]);
  }
 }
 return $output;
}


?>