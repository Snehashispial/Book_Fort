<?php

include "connection.php";
include "navbar.php";
$users="";


?>
<!DOCTYPE html>
<html>
<head>
  <title>Books</title>
  <style type="text/css">
    .srch
    {
      padding-left:1100px ;
    }
  </style>

</head>
<body>
    <div class="srch">
      <form class="navbar-form" method="post" name="form1">
        
          <input class="form-control" type="text" name="username" placeholder="Search username ..." > 
          <button style="background-color: #6db6b9e6;" type="submit" name="submit" class="btn btn-success"> &nbsp;
            


                 <SPAN class="glyphicon glyphicon-search">
                  

                 </SPAN>
                 
   

                 
                </button> 
                <button class="btn btn-success" style="background-color: #6db6b9e6;" name="all" type="submit" >View All</button>            
        
      </form>
    </div>
         

   

  <?php
if(isset($_POST['submit']))
{
   $result=mysqli_query ($db, "SELECT * from user_reg where username ='$_POST[username] ';");


   if(mysqli_num_rows($result)==0)
   {
     echo "Sorry! No user found in this name. Try searching again.";


   }
   else
   {
echo "<table class='table table-bordered table-hover'>";
      echo "<tr style='background-color: #6db6b9e6;'>";
      echo "<th>";  echo "First Name";  echo "</th>";
      echo "<th>";  echo "Last Name";  echo "</th>";
      echo "<th>";  echo "Email";  echo "</th>";
      echo "<th>";  echo "Gender";  echo "</th>";
      echo "<th>";  echo "Country";  echo "</th>";
      echo "<th>";  echo "Username";  echo "</th>";
      echo "<th>";  echo "Password";  echo "</th>";
    echo "</tr>";
  while($row=mysqli_fetch_assoc($result))
      {
        echo "<tr>";
        echo "<td>"; echo $row['first']; echo "</td>";
        echo "<td>"; echo $row['last']; echo "</td>";
        echo "<td>"; echo $row['email']; echo "</td>";
        echo "<td>"; echo $row['gender']; echo "</td>";
        echo "<td>"; echo $row['country']; echo "</td>";
        echo "<td>"; echo $row['username']; echo "</td>";
        echo "<td>"; echo $row['password']; echo "</td>";

        echo "</tr>";
      }
    echo "</table>";
   }
}


if(isset($_POST['all']))
{
   $result=mysqli_query($db, "SELECT * from user_reg ;");
   
   $users=mysqli_num_rows($result);


   if(mysqli_num_rows($result)==0)
   {
     echo "Sorry! No user found in this name. Try searching again.";


   }
   else
   {
      
      print "<h3 class='text-success'>"."&nbsp". "&nbsp". "&nbsp".  "Total Users"."&nbsp". $users . "</h3>";

echo "<table class='table table-bordered table-hover'>";
      echo "<tr style='background-color: #6db6b9e6;'>";
      echo "<th>";  echo "First Name";  echo "</th>";
      echo "<th>";  echo "Last Name";  echo "</th>";
      echo "<th>";  echo "Email";  echo "</th>";
      echo "<th>";  echo "Gender";  echo "</th>";
      echo "<th>";  echo "Country";  echo "</th>";
      echo "<th>";  echo "Username";  echo "</th>";
      echo "<th>";  echo "Password";  echo "</th>";
    echo "</tr>";
  while($row=mysqli_fetch_assoc($result))
      {
        echo "<tr>";
        echo "<td>"; echo $row['first']; echo "</td>";
        echo "<td>"; echo $row['last']; echo "</td>";
        echo "<td>"; echo $row['email']; echo "</td>";
        echo "<td>"; echo $row['gender']; echo "</td>";
        echo "<td>"; echo $row['country']; echo "</td>";
        echo "<td>"; echo $row['username']; echo "</td>";
        echo "<td>"; echo $row['password']; echo "</td>";

        echo "</tr>";
      }
    echo "</table>";
   }
}


  ?>

</body>
</html>