 <?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="author" content="Sahil Kumar">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Wish List</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
</head>

<body>
  <nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <!-- Brand -->
    <a class="navbar-brand" href="index.php"><i class="fas fa-mobile-alt"></i>&nbsp;&nbsp;Mobile Store</a>
    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav ml-auto">
       
          <li class="nav-item">
          <a class="nav-link" href="index1.php"><i class="fas fa-money-check-alt mr-2"></i>Books</a>
        </li> 

         <li class="nav-item">
          <a class="nav-link" href=""><i class="fas fa-money-check-alt mr-2"></i>Wishlist</a>
        </li>  
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span></a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div style="display:<?php if (isset($_SESSION['showAlert'])) {
  echo $_SESSION['showAlert'];
} else {
  echo 'none';
} unset($_SESSION['showAlert']); ?>" class="alert alert-success alert-dismissible mt-3">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong><?php if (isset($_SESSION['message'])) {
  echo $_SESSION['message'];
} unset($_SESSION['showAlert']); ?></strong>
        </div>
        <div class="table-responsive mt-2">
          <table class="table table-bordered table-striped text-center">
            <thead>
              <tr>
                <td colspan="7">
                  <h4 class="text-center text-info m-0">Products in your Wish List!</h4>
                </td>
              </tr>
              <tr>
                <th>BOOK ID</th>
                <th>BOOK NAME</th>
                <th>AUTHOR</th>
                <th>Price</th>
                <th>CATEGORY</th>
                <th>ISBN</th>
                  <th>IMAGE</th>
                <th>
                  <a href="action2.php?clear=all" class="badge-danger badge p-1" onclick="return confirm('Are you sure want to clear your list?');"><i class="fas fa-trash"></i>&nbsp;&nbsp;Clear List</a>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php
                include 'connection.php';
                $stmt = $db->prepare('SELECT * FROM cart_1');
                $stmt->execute();
                $result = $stmt->get_result();
                $grand_total = 0;
                while ($row = $result->fetch_assoc()):
              ?>
              <tr>
                <td><?= $row['book_id'] ?></td>
                <input type="hidden" class="pid" value="<?= $row['book_id'] ?>">

                <td><?= $row['name_of_book'] ?></td>
                 <input type="hidden" class="pname" value="<?= $row['name_of_book'] ?>">

                  <td><?= $row['author'] ?></td>
                 <input type="hidden" class="pauthor" value="<?= $row['author'] ?>">

                  <td>
                  <i class="fas fa-dollar-sign"></i>&nbsp;&nbsp;<?= number_format($row['price'],2); ?>
                </td>
                <input type="hidden" class="pprice" value="<?= $row['price'] ?>">

                 <td><?= $row['category'] ?></td>
                 <input type="hidden" class="pcategory" value="<?= $row['category'] ?>">

                  <td><?= $row['isbn'] ?></td>
                 <input type="hidden" class="pisbn" value="<?= $row['isbn'] ?>">

                 <td><img src="<?= $row['img'] ?>" width="90"></td>
            
                <td>
                  <a href="action2.php?remove=<?= $row['book_id'] ?>" class="text-danger lead" onclick="return confirm('Are you sure want to remove this book?');"><i class="fas fa-trash-alt"></i></a>
                </td>
              </tr>
              <?php endwhile; ?>
              <tr>
              	 <td colspan="3">
                  <a href="userwish.php" class="btn btn-success"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Continue
                    Browsing</a>
                </td>
            </tr>
           
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

  <script type="text/javascript">
  $(document).ready(function() {

    // Change the item quantity
    $(".itemQty").on('change', function() {
      var $el = $(this).closest('tr');

      var pid = $el.find(".pid").val();
      var pprice = $el.find(".pprice").val();
      var qty = $el.find(".itemQty").val();
      location.reload(true);
      $.ajax({
        url: 'action.php',
        method: 'post',
        cache: false,
        data: {
          qty: qty,
          pid: pid,
          pprice: pprice
        },
        success: function(response) {
          console.log(response);
        }
      });
    });

    // Load total no.of items added in the cart and display in the navbar
    load_cart_item_number();

    function load_cart_item_number() {
      $.ajax({
        url: 'action.php',
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
