<?php
	session_start();
	require 'connection.php';

	// Add products into the cart table
	if (isset($_POST['pid'])) {
	  $pid = $_POST['pid'];
	  $pname = $_POST['pname'];
	  $pauthor = $_POST['pauthor'];
	  $pprice = $_POST['pprice'];
	  $pcategory = $_POST['pcategory'];
	  $pisbn = $_POST['pisbn'];
	  $pimage = $_POST['pimage'];
	  
	  $stmt = $db->prepare('SELECT book_id FROM cart_1 WHERE book_id=?');
	  $stmt->bind_param('s',$pid);
	  $stmt->execute();
	  $res = $stmt->get_result();
	  $r = $res->fetch_assoc();
	  $code = $r['book_id'] ?? '';

	  if (!$code) {
	    $query = $db->prepare('INSERT INTO cart_1 (book_id,name_of_book,author,price,category,isbn,img) VALUES (?,?,?,?,?,?,?)');
	    $query->bind_param('ississs',$pid,$pname,$pauthor,$pprice,$pcategory,$pisbn,$pimage);
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

	// Get no.of items available in the list table
	if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
	  $stmt = $db->prepare('SELECT * FROM cart_1');
	  $stmt->execute();
	  $stmt->store_result();
	  $rows = $stmt->num_rows;

	  echo $rows;
	}

	// Remove single items from list
	if (isset($_GET['remove'])) {
	  $id = $_GET['remove'];

	  $stmt = $db->prepare('DELETE FROM cart_1 WHERE book_id=?');
	  $stmt->bind_param('i',$id);
	  $stmt->execute();

	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'Book removed from the list!';
	  header('location:cart.php');
	}

		// Remove all items at once from cart
	if (isset($_GET['clear'])) {
	  $stmt = $db->prepare('DELETE FROM cart_1');
	  $stmt->execute();
	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'All Item removed from the list!';
	  header('location:cart.php');
	}

?>







