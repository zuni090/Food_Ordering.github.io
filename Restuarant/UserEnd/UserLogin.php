<?php
  session_start();
  include('database.inc.php');
  include('function.inc.php');
  $msg = $id = $email = $password = "";

  if(isset($_POST['submit'])){
      $email=htmlspecialchars($_POST['email']);
      $password=htmlspecialchars($_POST['password']);
      $sql="select * from user where email='$email' and password='$password'";
      $res=mysqli_query($con,$sql);
      if(mysqli_num_rows($res)>0){
          $row=mysqli_fetch_assoc($res);
          $id = $row["ID"];
          $_SESSION['IS_LOGIN']=$id;
          $_SESSION['ADMIN_USER']=$row['Name'];
          if($row['status'] == 0){
            $msg="User Status Blocked";
          }
          else{
            //echo $id;
            redirect('UserIndex.php');
          }
          
      }

      else{
        $msg="Please enter valid login details";
      }
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>User | Login</title>
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="LoginAssets/css/login.css">
</head>
<body>
  <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
      <div class="card login-card">
        <div class="row no-gutters">
          <div class="col-md-5">
            <img src="LoginAssets/images/login.jpg" alt="login" class="login-card-img">
          </div>
          <div class="col-md-7">
            <div class="card-body">
              <div class="brand-wrapper">
              <p class="login-card-description">Welcome to our Online Food Ordering Site!</p>
              </div>
              <p class="login-card-description">Sign into your account</p>
              <form method="POST">
                  <div class="form-group">
                    <label for="email" class="sr-only">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" required value=<?php echo $email ?>>
                  </div>
                  <div class="form-group mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                  </div>
                  <input type="submit" class="btn btn-block login-btn mb-4" value="SIGN IN" name="submit"/>
                </form>
                <div style="color:red "><?php echo $msg?></div>
                <a href="verification.php" class="forgot-password-link">Forgot password?</a>
                <p class="login-card-footer-text">Don't have an account? <a href="UserRegister.php" class="text-reset">Register here</a></p>
                <nav class="login-card-footer-nav">
                </nav>
            </div>
           
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
