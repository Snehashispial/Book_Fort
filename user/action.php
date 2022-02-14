<?php
require 'connection.php';

 if(isset($_POST['action'])){
   $sql="SELECT * from books where category !='' ";

if(isset($_POST['category'])){

	$category=implode("','",$_POST['category']);
	$sql .="AND category IN('".$category."')";
}
if(isset($_POST['author'])){

	$author=implode("','",$_POST['author']);
	$sql .="AND author IN('".$author."')";
}
$result= $db->query($sql);
$output='';

if($result->num_rows>0){
	while($row=$result->fetch_assoc()){
		$output .='<div class="col-md-3 mb-2">
                    		<div class="card-deck">
                    			<div class="card border-secondary">
                    				<img src="'.$row['img'].'" >
                    				<div class="card-img-overlay">
                    					<h6 style="margin-top: 175px;" class="text-light bg-info text-center rounded p-1">'.$row['name_of_book'].'</h6>
                    				</div>
                    				<div class="card-body" >
                    					<h4 class="card-title taxt-danger">Price: '.number_format($row['price']). '/-</h4>

                    					<p>
                    						Book Id: '. $row['book_id'].'<br>
                    						Author Name: '. $row['author'].'<br>
                    						Category: '. $row['category'].'<br>
                    						Isbn Number: '. $row['isbn'].'<br>
                    					</p>
                    					<a href="#" class="btn btn-success btn-block">Add to Wish List</a>


                    				</div>
                    			</div>
                    		
                    	</div>

			</div>';
	}
}
else{
	$output = "<h3>No Products Found!</h3>";
}
echo $output;
}





if (isset($_POST['pid'])) {
	  $pid = $_POST['pid'];
	  $pname = $_POST['pname'];
	  $pauthor = $_POST['pauthor'];
	  $pprice = $_POST['pprice'];
	  $pcategory = $_POST['pcategory'];
	  $pisbn = $_POST['pisbn'];
	  $pimg = $_POST['pimg'];
	  
	  $stmt = $db->prepare('SELECT book_id FROM cart_1 WHERE book_id=?');
	  $stmt->bind_param('s',$pid);
	  $stmt->execute();
	  $res = $stmt->get_result();
	  $r = $res->fetch_assoc();
	  $code = $r['book_id'] ?? '';

	  if (!$code) {
	    $query = $db->prepare('INSERT INTO cart_1 (book_id,name_of_book,author,price,category,isbn,img) VALUES (?,?,?,?,?,?,?)');
	    $query->bind_param('ississs',$pid,$pname,$pauthor,$pprice,$pcategory,$pisbn,$pimg);
	    $query->execute();

	    echo '<div class="alert alert-success alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Item added to your wishlist!</strong>
						</div>';
	  } else {
	    echo '<div class="alert alert-danger alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Item already added to your wishlist!</strong>
						</div>';
	  }
	}

	// Get no.of items available in the cart table
	if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
	  $stmt = $db->prepare('SELECT * FROM cart_1');
	  $stmt->execute();
	  $stmt->store_result();
	  $rows = $stmt->num_rows;

	  echo $rows;
	}
?>