<?php 

  session_start();

  include('database.inc.php');
  include('function.inc.php');

	$msg="";
	$mobile_num="";

	if(isset($_GET['id']) && $_GET['id']>0){
		$id=htmlspecialchars($_GET['id']);
		$row=mysqli_fetch_assoc(mysqli_query($con,"select * from user where id='$id'"));
		$mobile_num=$row['mobile_num'];
	}

	if(isset($_POST['submit'])){
		  $mobile_num=htmlspecialchars($_POST['mobile_num']);

      $sql = "select * from user where Mobile_num = '$mobile_num'";
      $res = mysqli_query($con,$sql);

      if(mysqli_num_rows($res) == 0){
        
        $msg = "Invalid Number, No Record Found";}
      else{
        redirect('ResetPass.php');
      }
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>User | Verification</title>
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
              <h4 class="login-card-description">Enter your Mobile Number for verification!</h4>
              <form method="POST">
                  <div class="form-group">
                    <label for="email" class="sr-only">Mobile Number</label>
                    <input type="text" name="mobile_num" id="email" class="form-control" placeholder="Mobile Number" required>
                  </div>
                  <input type="submit" class="btn btn-block login-btn mb-4" value="VERIFY" name="submit"/>
                  <div style="color:red"><?php echo $msg; ?></div>
                </div>
                
                </form>

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
