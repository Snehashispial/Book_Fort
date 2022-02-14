<?php

include "connection.php";
include "navbar.php";

?>
<!DOCTYPE html>
<html>
<head>
	<title>Books</title>
	<style type="text/css">
		.srch
		{
			padding-left: 1000px;
		}
	</style>
</head>
<body>
    <div class="srch">
    	<form class="navbar-form" method="post" name="form1">
    		
    			<input class="form-control" type="text" name="search" placeholder="Search books..." required=" "> 
    			<button style="background-color: #6db6b9e6;" type="submit" name="submit" class="btn btn-success">

                 <SPAN class="glyphicon glyphicon-search">
                 	

                 </SPAN>
                </button>
    	
    		
    	</form>

    </div>

	<h2>List of Books  </h2>
	<?php
if(isset($_POST['submit']))
{
	 $result=mysqli_query($db, "SELECT * from books where b_name like '%$_POST[search]%';") or die(mqsqli_error($db));
   if(mysqli_num_rows($result)==0)
   {
     echo "Sorry! No book found. Try searching again.";

   }
   else
   {
echo "<table class='table table-bordered table-hover'>";
      echo "<tr style='background-color: #6db6b9e6;'>";
      echo "<th>";  echo "ID";  echo "</th>";
      echo "<th>";  echo "Book-Name";  echo "</th>";
      echo "<th>";  echo "Authors-Name";  echo "</th>";
      echo "<th>";  echo "Edition";  echo "</th>";
      echo "<th>";  echo "Type";  echo "</th>";
      echo "<th>";  echo "Publish-Year";  echo "</th>";
      echo "<th>";  echo "ISBN";  echo "</th>";
    echo "</tr>";
  while($row=mysqli_fetch_assoc($result))
			{
				echo "<tr>";
				echo "<td>"; echo $row['b_id']; echo "</td>";
				echo "<td>"; echo $row['b_name']; echo "</td>";
				echo "<td>"; echo $row['authors']; echo "</td>";
				echo "<td>"; echo $row['edition']; echo "</td>";
				echo "<td>"; echo $row['type']; echo "</td>";
				echo "<td>"; echo $row['pub_year']; echo "</td>";
				echo "<td>"; echo $row['Isbn']; echo "</td>";

				echo "</tr>";
			}
		echo "</table>";

   }
}



else
{
	echo "how are you";

}


	?>

</body>
</html>