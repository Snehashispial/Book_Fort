<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="author" content="Snehashis Ghosh">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>User Panel</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
</head>

<body>
  <!-- Navbar start -->
  <nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <a class="navbar-brand" href="index.php"><i class="fas fa-mobile-alt"></i>&nbsp;&nbsp;Book Fort</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">






      <ul class="navbar-nav ml-auto">
       
       <li class="nav-item">
          <a class="nav-link" href="index.php"><i class="fas fa-money-check-alt mr-2"></i>Logout</a>
        </li> 
       
        <li class="nav-item">
          <a class="nav-link" href="index1.php"><i class="fas fa-money-check-alt mr-2"></i>Books</a>
        </li> 

         <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fas fa-money-check-alt mr-2"></i>Wishlist</a>
        </li>  

        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span></a>
        </li>
      </ul>
      
    </div>
  </nav>
  <!-- Navbar end -->

  <!-- Displaying Products Start -->
  <div class="container">
    <div id="message"></div>
    <div class="row mt-2 pb-3">
      <?php
  			include 'connection.php';
  			$stmt = $db->prepare('SELECT * FROM books');
  			$stmt->execute();
  			$result = $stmt->get_result();
  			while ($row = $result->fetch_assoc()):
  		?>
      <div class="col-sm-6 col-md-4 col-lg-3 mb-2">
        <div class="card-deck">
          <div class="card p-2 border-secondary mb-2">
            <img src="<?= $row['img'] ?>" class="card-img-top" height="250">
           
             <div class="card-body p-1" >
              <h4 class="card-title text-center text-info"><?= $row['name_of_book'] ?></h4>
              <h5 class="card-text text-center text-danger"><i class="fas fa-rupee-sign"></i>&nbsp;&nbsp;<?= number_format($row['price'],2) ?>/-</h5>

                              <p>
                                Book Id: <?= $row['book_id']; ?><br>
                                Author Name: <?= $row['author']; ?><br>
                                Category: <?= $row['category']; ?><br>
                                Isbn Number: <?= $row['isbn']; ?><br>
                              </p>
                            </div>
            <div class="card-footer p-1">
              <form action="" class="form-submit">
                
                <input type="hidden" class="pid" value="<?= $row['book_id'] ?>">
                <input type="hidden" class="pname" value="<?= $row['name_of_book'] ?>">
                <input type="hidden" class="pauthor" value="<?= $row['author'] ?>">
                 <input type="hidden" class="pprice" value="<?= $row['price'] ?>">
                 <input type="hidden" class="pcategory" value="<?= $row['category'] ?>">
                 <input type="hidden" class="pisbn" value="<?= $row['isbn'] ?>">
                <input type="hidden" class="pimage" value="<?= $row['img'] ?>">
                
                <button class="btn btn-info btn-block addItemBtn"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Add to
                  Wish List</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
  </div>
  <!-- Displaying Products End -->

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

  <script type="text/javascript">
  $(document).ready(function() {

    // Send product details in the server
    $(".addItemBtn").click(function(e) {
      e.preventDefault();
      var $form = $(this).closest(".form-submit");
      var pid = $form.find(".pid").val();
      var pname = $form.find(".pname").val();
      var pauthor = $form.find(".pauthor").val();
      var pprice = $form.find(".pprice").val();
      var pcategory = $form.find(".pcategory").val();
      var pisbn = $form.find(".pisbn").val();
      var pimage = $form.find(".pimage").val();

      $.ajax({
        url: 'action2.php',
        method: 'post',
        data: {
         pid: pid,
          pname: pname,
          pauthor: pauthor,
          pprice: pprice,
          pcategory: pcategory,
          pisbn: pisbn,
          pimage: pimage
        },
        success: function(response) {
          $("#message").html(response);
          window.scrollTo(0, 0);
          load_cart_item_number();
        }
      });
    });

    // Load total no.of items added in the cart and display in the navbar
    load_cart_item_number();

    function load_cart_item_number() {
      $.ajax({
        url: 'action2.php',
        method: 'get',
        data: {
          cartItem: "cart_item"
        },
        success: function(response) {
          $("#cart-item").html(response);
        }
      });
    }
  });
  </script>
</body>

</html>
