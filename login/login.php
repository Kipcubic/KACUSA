<?php
//login.php

include('dbCon.php');

if(isset($_SESSION['type']))
{
  header("location:index.php");
}

$message = '';

if(isset($_POST["login"]))
{
  $query = "
  SELECT * FROM users 
    WHERE user_email = :user_email AND user_active=1
  ";
  $statement = $connect->prepare($query);
  $statement->execute(
    array(
        'user_email'  =>  $_POST["user_email"]
      )
  );
  $count = $statement->rowCount();
  if($count > 0)
  {
    $result = $statement->fetchAll();
    foreach($result as $row)
    {
      if($row['type'] =1)
      {
        if(password_verify($_POST["user_password_hash"], $row["user_password_hash"]))
        {
        
          $_SESSION['type'] = $row['type'];
          $_SESSION['user_id'] = $row['user_id'];
          $_SESSION['first_name'] = $row['first_name'];
          header("location:index.php");
        }
        else
        {
          $message = "<label>Login Failed; Either Wrong Password, Unpaid or Unregistered..</label>";
        }
      }
      else
      {
        $message = "<label>Login Failed; Either Wrong Password, Unpaid or Unregistered...</label>";
      }
    }
  }
  else
  {
    $message = "<label>Login Failed; Either Wrong Password, Unpaid or Unregistered...</label>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="Login KACUSA" content="KACUSA Website Login">
  <meta name="author" content="">
  <title>KACUSA Login</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container">

    <div class="card card-login mx-auto mt-5">
      <img id="profile-img" class="profile-img-card" src="img/kacusa_logo.png" />
      <div class="card-header text-center">Login</div>
      <div class="card-body">
        <form method="post">
          <?php echo $message; ?>
          <div class="form-group">
            <label for="email">Email address</label>
            <input class="form-control" id="user_email" type="email" name="user_email" aria-describedby="email" placeholder="Enter email">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" id="password" type="password" name="user_password_hash" placeholder="Password">
          </div>
          
          <input type="submit" name="login" value="Login" class="btn btn-info">
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="register.php">Register an Account</a>
          <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
