<?php
  session_start();

  include('database.inc.php');
  include('function.inc.php');

  $msg = "";
  $email="";
  $password1 = "";
  $password2 = "";

  if(isset($_POST['submit'])){
      $email=htmlspecialchars($_POST['email']);
      $password1=htmlspecialchars($_POST['password1']);
      $password2=htmlspecialchars($_POST['password2']);
      
      $sql="select * from user where email='$email'";
      $res=mysqli_query($con,$sql);
      if(mysqli_num_rows($res) > 0){
          $row=mysqli_fetch_assoc($res);
          if($password1 == $password2){
            $sql1 = "update user set Password = '$password1' where email = '$email'";
            $res1=mysqli_query($con,$sql1);
            redirect('UserLogin.php');
          }
          else{
            $msg="Passwords don't match";
          }
           
      }
      else{
        $msg = "Check Email again";
      }
      
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>User | Reset Password</title>
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
              </div>
              <p class="login-card-description">Reset Password</p>
              <form method="POST">
                  <div class="form-group">
                    <label for="email" class="sr-only">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" required value=<?php echo $email ?>>
                  </div>
                  <div class="form-group mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password1" id="password" class="form-control" placeholder="*****" required>
                  </div>
                  <div class="form-group mb-4">
                    <label for="password" class="sr-only">Re-enter Password</label>
                    <input type="password" name="password2" id="password" class="form-control" placeholder="*****" required>
                  </div>
                  <input type="submit" class="btn btn-block login-btn mb-4" value="RESET" name="submit"/>
                </form>
                <div style="color:red "><?php echo $msg?></div>
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
