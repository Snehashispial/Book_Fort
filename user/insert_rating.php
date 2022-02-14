
<?php

//fetch.php

$db = new PDO('mysql:host=localhost;dbname=book_fort', 'root', '');

if(isset($_POST["index"], $_POST["business_id"]))
{
 $query = "
 INSERT INTO rating(business_id, rating) 
 VALUES (:business_id, :rating)
 ";
 $statement = $db->prepare($query);
 $statement->execute(
  array(
   ':business_id'  => $_POST["business_id"],
   ':rating'   => $_POST["index"]
  )
 );
 $result = $statement->fetchAll();
 if(isset($result))
 {
  echo 'done';                                 //sent to ajax request
 }
}


?>
