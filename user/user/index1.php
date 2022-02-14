<?php
require 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	 <meta charset="utf-8">
	 <meta name="author" content="Pial Ghosh">
	 <meta http-equiv="X-UA-Compatible" content="IE=edge">
	 <meta name="viewport" content="width=device-width,initial-scale=1, shrink-to-fit=no">
	<title>User Panel</title>

	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

	<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
    <a class="navbar-brand" href="index.php"><i class="fas fa-book-reader"></i>&nbsp;&nbsp;Book Fort</a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav ml-auto">
     
     
     
    </ul>
  </div>
</nav>
	



	<div class="container-fluid">
		
		<div class="row">
		<div class="col-lg-3">
			<h5>Book Category</h5>
			<hr>
			<h6 class="text-info">Select Category</h6>
			<ul class="list-group">
				<?php
                    $sql="SELECT DISTINCT category from books order by category";
                    $result=$db->query($sql);
                    while($row=$result->fetch_assoc()){
                      
				?>
				<li class="list-group-item">
					<div class="form-check">
                      <label class="form-check-label">
                      	<input type="checkbox" class="form-check-input product_check" value="<?= $row['category']; ?>" id="category"><?= $row['category'];?>

                      </label>
					</div>


				</li>
			<?php } ?>

			</ul>

     <h6 class="text-info">Choose Author</h6>
     <ul class="list-group">
				<?php
                    $sql="SELECT DISTINCT author from books order by author";
                    $result=$db->query($sql);
                    while($row=$result->fetch_assoc()){
                      
				?>
				<li class="list-group-item">
					<div class="form-check">
                      <label class="form-check-label">
                      	<input type="checkbox" class="form-check-input product_check" value="<?= $row['author']; ?>" id="author"><?= $row['author'];?>

                      </label>
					</div>


				</li>
			<?php } ?>

			</ul>




		</div>
		<div class="col-lg-9">
			<h5 class="text-center" id="textChange">All Books List</h5>
			<hr>
			<div class="text-center">
				<img src="images/loader.gif" id="loader" width="200" style="display: none;">
				
			</div>
			<div class="row" id="result">
				<?php
				  $sql="SELECT * from books";
                    $result=$db->query($sql);
                    while($row=$result->fetch_assoc()){ 
                    	?>
                    	<div class="col-md-3 mb-2">
                    		<div class="card-deck">
                    			<div class="card border-secondary">
                    				<img src="<?= $row['img']; ?>" class="card-img-top" >
                    				<div class="card-img-overlay">
                    					<h6 style="margin-top: 175px;" class="text-light bg-info text-center rounded p-1"><?=$row['name_of_book']; ?></h6>

                                      <a href="review.php" class="btn btn-success" >&nbsp;&nbsp;REVIEW</a><br><br>
                    				</div>
                    				<div class="card-body" >
                    					<h4 class="card-title taxt-danger">Price: <?=number_format($row['price']); ?>/-</h4>

                    					<p>
                    						Book Id: <?= $row['book_id']; ?><br>
                    						Author Name: <?= $row['author']; ?><br>
                    						Category: <?= $row['category']; ?><br>
                    						Isbn Number: <?= $row['isbn']; ?><br>

       
             					</p>
           
                    					
                    				</div>
                    				
          </div>
        </div>
    </div>

		<?php } ?>
		</div>

			
		</div>
		

	</div>
</div>




<script type="text/javascript">
	$(document).ready(function(){

		$(".product_check").click(function(){
			$("#loader").show();
			var action= 'data';
			var category=get_filter_text('category');
			var author=get_filter_text('author');

			$.ajax({
				url: 'action.php',
				method: 'POST',
				data:{action:action,category:category,author:author},
				success:function(response){
					
					$("#result").html(response);
					$("#loader").hide();
					$("#textChange").text("Filtered Books");

				}
			});
         });


		function get_filter_text(text_id){
			var filterData= [];
			$('#'+text_id+':checked').each(function(){
             filterData.push($(this).val());
			});
			return filterData;
		}
    });

</script>


  <!---<script type="text/javascript">
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
      var pimg = $form.find(".pimg").val();

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
          pimg: pimg
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
  </script>-->

</body>
</html>