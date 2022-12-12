<?php 
include('header.php');


	$msg="";
	$name="";
	$mobile_num="";
	$password1="";
  $password2="";
  $email="";
  $address="";
  $id="";

	if(isset($_GET['id']) && $_GET['id']>0){
		$id=htmlspecialchars($_GET['id']);
		$row=mysqli_fetch_assoc(mysqli_query($con,"select * from user where id='$id'"));
		$name=$row['Name'];
		$email=$row['email'];
		$mobile_num=$row['mobile_num'];
		$password1=$row['Password1'];
    $password2=$row['Password2'];
    $address=$row['address'];
	}

	if(isset($_POST['submit'])){
		$name=htmlspecialchars($_POST['Name']);
		$email=htmlspecialchars($_POST['email']);
		$mobile_num=htmlspecialchars($_POST['mobile_num']);       
		$password1=htmlspecialchars($_POST['password1']);
		$added_on=htmlspecialchars(date('Y-m-d '));
    $address=htmlspecialchars($_POST['address']);
		
		if($id==''){
			$sql="select * from user where email='$email'";
		}else{
			$sql="select * from user where email='$email' and mobile_num='$mobile_num' and id!='$id'";
		}	
		if(mysqli_num_rows(mysqli_query($con,$sql))>0){
			$msg="Email or Mobile Number already Registered";
		}
        else{
			if($id==''){
				mysqli_query($con,"insert into user(Name,Email,mobile_num,Password,added_on,status,address) values('$name','$email','$mobile_num','$password1','$added_on',1,'$address')");
			}
            else{
                mysqli_query($con,"update user set Name = '$name' ,Email = '$email' ,mobile_num = '$mobile_num' ,Password = '$password1' ,  address = '$address' where id = '$id' and status = 1") ;
            }
			redirect('UserIndex.php');
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>User | Profile</title>
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
            <img src="LoginAssets/images/images.jfif" alt="login" class="login-card-img">
          </div>
          <div class="col-md-7">
            <div class="card-body">
              <div class="brand-wrapper">
              <p class="login-card-description">Edit Profile</p>
              </div>              
              <form method="POST">

                 <div class="form-group">
                    <input type="text" name="Name" id="email" class="form-control" placeholder="Name" required value="<?php echo $name?>">
                  </div>

                  <div class="form-group">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" required >
                  </div>
                
                  <div class="form-group">
                    <input type="text" name="mobile_num" id="email" class="form-control" placeholder="03xx-xxxxxxx" required>
                  </div>

                  <div class="form-group">
                    <input type="text" name="address" id="email" class="form-control" placeholder="Address" required>
                  </div>

                  <div class="form-group mb-4">
                    <input type="password" name="password1" id="password" class="form-control" placeholder="****" required>
                  </div>

                  <div class="form-group mb-4">
                    <input type="password" name="password2" id="password" class="form-control" placeholder="Re-enter ****" required>
                  </div>

                  <input type="submit" class="btn btn-block login-btn mb-4" value="Register" name="submit"/>
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
