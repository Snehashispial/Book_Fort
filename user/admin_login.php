<?php

include "connection.php";

?>
<!DOCTYPE html>
<html>
<head>

  <title>Admin Login</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<style type="text/css">

  section
  {
    margin-top: -20px;
  }

.log_img
{
  height: 650px;
  width:1545px;
  margin-top: 0px;
}

}
</style>
  
</head>
<body>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
<div class="navbar-header">
      <a class="navbar-brand active">Online Book World</a>
    </div>

        <ul class="nav navbar-nav">
          <li><a href="index.php">HOME</a></li>
          <li><a href="books.php">BOOKS</a></li>
          
          <li><a href="feedback.php">FEEDBACK</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
           <li><a href="admin_login.php"><span class="glyphicon glyphicon-log-in"> LOGIN</span></a></li>
           <li><a href="admin_login.php"><span class="glyphicon glyphicon-log-out"> LOGOUT</span></a></li>
        </ul>
        </div>
      </nav>
  <!--
<header style="height: 94px;width:1518px;">
  
<div class="logo">
      <h1 style="color: white; font-size: 25px;word-spacing: 10px; line-height: 80px;margin-top: 20px;">Online Book World</h1>
    </div>

      <nav>
        <ul>
          <li><a href="index.html">HOME</a></li>
          <li><a href="">BOOKS</a></li>
          <li><a href="user_login.html">USER-LOGIN</a></li>
          <li><a href="">ADMIN_LOGIN</a></li>
          <li><a href="registration.html">REGISTRATION</a></li>
          <li><a href="">FEEDBACK</a></li>
        </ul>
      </nav>
</header>-->

<section>
  <div class="log_img">
    <br> <br><br>
    <div class="box1" style="margin-top: 20px">
        <h1 style="text-align: center; font-size: 35px;font-family: Lucida Console;">Book Fort</h1>
        <h1 style="text-align: center; font-size: 25px;">Admin Login Form</h1><br>
      <form name="login" action="" method="post">
        <div class="login">
          <input class="form-control" type="text" name="username" placeholder="Username" required=""> <br>
          <input class="form-control" type="password" name="password" placeholder="Password" required=""> <br>
          <input class="btn btn-success" type="submit" name="submit" value="Login" style="color: black; width:70px; height:30px">
        </div>
      </form>
      <p style="color: white; padding-left: 15px;">
        <br><br>
        <a style="color:white;" href="">Forgot password?</a>
      </p>
    </div>
  </div>
</section>

<?php

      if(isset($_POST['submit']))
      {
        $count=0;
        $res=mysqli_query($db,"SELECT * from `admin_reg` WHERE username='$_POST[username] ' && password='$_POST[password]' ;");
        $count=mysqli_num_rows($res);
          if($count==0)
          {
            ?>
          <!--  <script type="text/javascript">
               alert("The username and password doesn't match.");
            </script>
          -->

          <div class="alert alert-warning" style="width:400px; margin-left:580px; background-color: #de1313; color: white">
          <strong>The username and password doesn't match.</strong> 
          </div>
            <?php
          }
          else
          {
            ?>
               <script type="text/javascript">
                 window.location="admin_panel.php";
               </script>
            <?php
          }
        }
        ?>

<footer>
   <?php
  include "foote.php";
  ?>
</footer>


</body>
</html>