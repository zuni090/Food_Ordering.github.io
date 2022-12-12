<?php 
    session_start();
    include('database.inc.php');
    include('function.inc.php');
    include('constant.inc.php');

    if(!isset($_SESSION['IS_LOGIN_DELIVERY'])){
      redirect('login.php');
    }

$uid = $_SESSION['IS_LOGIN_DELIVERY'];
//echo $uid;
$sql1 = "select * from delivery_boy where id = '$uid'";
$res1 = mysqli_query($con,$sql1);
$DID = mysqli_fetch_assoc($res1);



$res = mysqli_query($con,"select * from order_master where delivery_boy_id = '$uid'");

if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id']) && $_GET['id']>0){
	$type=($_GET['type']);
	$id=($_GET['id']);
    

  if($type=='active' || $type=='deactive'){
		$status=1;
		if($type=='deactive'){
			$status=2;
		}
		mysqli_query($con,"update order_master set order_status ='$status' where id='$id'");
		redirect('delivery_panel.php');
	}

  if($type=='Success' || $type=='pending'){
		$status=0;
		if($type=='Success'){
			$status=1;
		}
    // '0' payment status means success and '1' means pending
		mysqli_query($con,"update order_master set payment_status ='$status' where id='$id'");

		redirect('delivery_panel.php');
	}


}
$x = $_SESSION['Delivery_Name'];
$page_title = 'Delivery Boy | '.($x);
?>
<head>

<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title> <?php  echo $page_title?></title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.css">

  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="assets/css/bootstrap-datepicker.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-menu-wrapper d-flex align-items-stretch justify-content-between">
        <ul class="navbar-nav mr-lg-2 d-none d-lg-flex">
          <li class="nav-item nav-toggler-item">
            <button class="navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
            </button>
          </li>
          
        </ul>
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="index.php"><img src="assets/images/logo.png" alt="logo"/></a>
          <a class="navbar-brand brand-logo-mini" href="index.php"><img src="assets/images/logo.png" alt="logo"/></a>
        </div>
        <ul class="navbar-nav navbar-nav-right">
          
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <span class="nav-profile-name "><?php  echo $_SESSION['Delivery_Name']?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="logout.php">
                <i class="mdi mdi-logout text-primary"></i>
                Logout
              </a>
            </div>
          </li>
          
          <li class="nav-item nav-toggler-item-right d-lg-none">
            <button class="navbar-toggler align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-menu"></span>
            </button>
          </li>
        </ul>
      </div>
    </nav>
</div>
<div class="card">
            <div class="card-body"><br><br><br><br>
              <h2 class="grid_title">Items to be Delivered</h2><br><br>
              <div class="row grid_box">
				
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th width="5%">S.No</th>
                            <th width="20%">Costumer Name and Cell #</th>
							              <th width="10%">Orderd On</th>
                            <th width="15%">Delivery Address</th>
                            <th width="10%">Total Price</th>
                            <th width="30%">Order Details</th>
							              <th width="10%">Payment Status</th>
                        </tr>
                      </thead>
                      <tbody>
						<?php if(mysqli_num_rows($res) > 0) {
							$i=1;
							while($row = mysqli_fetch_assoc($res)){
							?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td>
                                <?php 
                                $x = $row['user_id'];
                                $usersql = mysqli_fetch_assoc(mysqli_query($con,"select * from user where id = '$x'")); ?>
                                <?php echo $usersql['Name']?><br/>
                                <?php echo $usersql['Mobile_num'] ?>
                            </td>

							<td>
								<?php $dateStr = strtotime($row['added_on']);
								echo date('d M, Y',$dateStr); ?>
							</td>

							<td>
                                <?php echo $row['Payment_address'] ?>
                            </td>
                            <td>
                                <?php echo "Rs.".$row['total_price']."/-" ?>
                            </td>

                            <td>
                              <?php 
                                $x = $row['user_id'];
                                $y = $row['ID'];
                                $order_detail_sql = (mysqli_query($con,"select * from order_details where user = '$x' and order_id = '$y'"));
                                     if(mysqli_num_rows($res) > 0) {
                                        $count=1;
                                            while($order_detail_row = mysqli_fetch_assoc($order_detail_sql)){?>
                                                <ul>
                                                    <?php echo $count?>
                                                    <br>
                                                    <?php echo "-----"?>
                                                <li width="5%">Dish Name :
                                                <?php 
                                                $h1 = $order_detail_row['Dish_details_id'];
                                                $t1 = mysqli_fetch_assoc(mysqli_query($con,"select  d.dish,dd.Price from dish_detail dd,dish d where dd.id = '$h1' and dd.dish_id = d.id "));
                                                echo ($t1['dish'])?>
                                                </li>
                                                <li width="15%">Quantity : <?php echo $order_detail_row['qty'] ?></li>
                                                <li width="5%">Price     : Rs.  <?php echo $t1['Price']?>/-</li>  
                                                <li>Order Status : </li>
                                                <?php
                                                if($row['order_status']==1){
                                                ?>
                                                <a href="?id=<?php echo $row['ID']?>&type=deactive"><label class="badge badge-danger hand_cursor cursor_bnale">Pending</label></a>
                                                <?php
                                                }
                                                else if($row['order_status']==2){
                                                ?>
                                                <a href="?id=<?php echo $row['ID']?>&type=active"><label class="badge badge-success hand_cursor cursor_bnale">Delivered</label></a>
                                                <?php
                                                }
                                                
                                                ?>
                                                &nbsp;                                         
                                        </ul>
                                        <?php   $count = $count+1; } } ?>								
							</td>

                            <td>
                            <?php
								if($row['payment_status']==0){
								?>
								<a href="?id=<?php echo $row['ID']?>&type=Success"><label class="badge badge-danger hand_cursor cursor_bnale">Pending</label></a>
								<?php
								}
								else{
								?>
								<a href="?id=<?php echo $row['ID']?>&type=pending"><label class="badge badge-success hand_cursor cursor_bnale">Success</label></a>
								<?php
								}
								
								?>
								&nbsp;

                            </td>
                           
                       </tr>

						<?php 
							$i++;
							} }else{?>
							<tr>
							<td colspan="4">No Data Found</td>
							</tr>
							<?php  } ?>
						
                        
                      </tbody>
                    </table>
                  </div>
				</div>
              </div>
            </div>
          </div>


        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Muhammad Zunique. All rights reserved.</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="assets/js/vendor.bundle.base.js"></script>
  <script src="assets/js/jquery.dataTables.js"></script>
  <script src="assets/js/dataTables.bootstrap4.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="assets/js/Chart.min.js"></script>
  <script src="assets/js/bootstrap-datepicker.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="assets/js/off-canvas.js"></script>
  <script src="assets/js/hoverable-collapse.js"></script>
  <script src="assets/js/template.js"></script>
  <script src="assets/js/settings.js"></script>
  <script src="assets/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="assets/js/data-table.js"></script>
  <!-- End custom js for this page-->
</body>
</html>

<style>
.resize_krle{
height:150px;
width:150px;
margin-left:50px;
border-radius:20px;

}

.setting_krle{
    border:1px solid;
    margin:3px;
    padding:4px;
}

.setkro{

    width:40%;
    cursor: pointer;
    border-radius: 4px;
  background-color: #34eb83;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 15px;
  width: 200px;
  transition: all 0.5s;
  cursor: pointer;

}

.cursor_bnale{
  cursor: pointer;
}


</style>


