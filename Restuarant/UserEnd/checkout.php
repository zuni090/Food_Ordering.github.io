<?php


include ("header.php");
$name = $_SESSION['ADMIN_USER'];
$uid = $_SESSION['IS_LOGIN'];

$invoice = generateRandomString();

$dishes= "" ;
$dish_ID = "";
$dish_price = 0;
$qty = 0;
$price =0;




$idSQL = (mysqli_query($con,"select  id from order_master  where user_id = '$uid' order by id desc limit 1"));
$num = (mysqli_fetch_assoc($idSQL));
$voucher_num = generateRandomString().implode($num);
$id = implode($num);
$sql = "select all d.dish , dd.id , dd.price , c.quantity from dish d , dish_detail dd ,cart c where d.id = dd.dish_id and dd.id = c.dish_detail_id and c.user_id ='$uid'";
$res = mysqli_query($con,$sql);



while($row = mysqli_fetch_assoc($res)){
  ($dishes =  $row['dish']);
  ($dish_ID =  $row['id']);
  ($dish_price =  $row['price']);
  ($qty = $row['quantity']);

    $dish_price *= ($qty);

  $price += ($dish_price);
 

  mysqli_query($con,"insert into order_details(user,order_id,qty,dish_details_id,voucher_id ,Price) values('$uid','$id','$qty','$dish_ID','$voucher_num','$dish_price')");
  mysqli_query($con,"insert into order_history(user_id, dish_details_id ,qty , tot_price) values('$uid','$dish_ID' ,'$qty','$dish_price')");
  mysqli_query($con,"delete from cart where user_id = '$uid' and dish_detail_id = '$dish_ID'");

  
}
mysqli_query($con,"delete from cart where user_id = '$uid'");

?>

<section class="h-100 gradient-custom">

  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-10 col-xl-8">
      <span class="clear-cart cart-shiping-update ">
  <a href="UserIndex.php" class="cart-clear">Back to Home</a>
  <br></span>

        <div class="card" style="border-radius: 10px;">
          <div class="card-header px-4 py-5">
            <h5 class="text-muted mb-0">Thanks for your Order, <span style="color: #a8729a;"><?php echo $name?></span>!</h5>
          </div>
          <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <p class="lead fw-normal mb-0" style="color: #a8729a;">Receipt</p>
              <p class="small text-muted mb-0">Receipt Voucher : <?php 
              $res = mysqli_fetch_assoc(mysqli_query($con,"select voucher_id from order_details where order_id = '$id'"));
              $temp = implode($res);
              echo ($temp);              
              ?></p>
            </div>

            <!-----------------------------------------  -->
            <div class="card shadow-0 border mb-4">
              <div class="card-body">
                <!-- <div class="row"> -->
                <?php 
                $sql = "select all d.dish , dd.id , dd.price , c.quantity from dish d , dish_detail dd ,cart c where d.id = dd.dish_id and dd.id = c.dish_detail_id and c.user_id ='$uid'";
                $res = mysqli_query($con,$sql);
                if(mysqli_num_rows($res) > 0){                 
                  while($row=mysqli_fetch_assoc($res)){?>
                      <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                        <p class="text-muted mb-0"><?php echo $row['dish']?></p>
                      </div>

                      <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                        <p class="text-muted mb-0 small"><?php echo $row['price']?></p>
                      </div>

                      <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                        <p class="text-muted mb-0 small"><?phpecho $row['quantity'] ?></p>
                      </div>

                <?php }
              
              }?>
                </div>
              </div>
            </div>
<!-- ----------------------------- -->

            <div class="d-flex justify-content-between pt-2">
              <p class="fw-bold mb-0">Order Details</p>
              <p class="text-muted mb-0"><span class="fw-bold me-4"><?php echo " Total : "?></span><?php
              $tempPrice = mysqli_fetch_assoc(mysqli_query($con,"select sum(od.price) from order_details od where user =  '$uid' and voucher_id = '$voucher_num'"));

              echo '  '.implode($tempPrice);
              
              ?></p>
            </div>

            <div class="d-flex justify-content-between pt-2">
              <p class="text-muted mb-0">Invoice Number : <?php  echo $invoice?></p>
            </div>

            <div class="d-flex justify-content-between">
              <p class="text-muted mb-0">Invoice Date : <?php  echo htmlspecialchars(date('d-M-Y '))?></p>
              <p class="text-muted mb-0"><span class="fw-bold me-4">Tax Rs.100/- (Per Item Ordered) <br>Cash On delivery</span></p>
            </div>

            <div class="d-flex justify-content-between mb-5">
              <p class="text-muted mb-0">Recepits Voucher :  <?php $res =(mysqli_fetch_assoc(mysqli_query($con,"select voucher_id from order_details where order_id = '$id'")));
               $temp = implode($res);
               echo ($temp);     ?></p>
              <!-- <div>
              <p class="text-muted mb-0"><span class="fw-bold me-4">Delivery Charges</span> Free</p><br></div> -->
              <div><p class="text-muted mb-0"><span class="fw-bold me-4">Delivery Person Name : </span><?php 
              $res = mysqli_fetch_assoc(mysqli_query($con,"select * from delivery_boy where id in (select delivery_boy_id from order_master where user_id = '$uid' order by user_id ) limit 1"));
              echo ($res['Name']);?>
              <br>
              <span class="fw-bold me-4">Contact #  : </span>
              <?php
              echo ($res['Mobile_num']);  
              
              
              ?></p></div>
            </div>
          </div>
          <div class="card-footer border-0 px-4 py-5"
            style="background-color: #a8729a; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
            <h5 class="d-flex align-items-center justify-content-end text-white text-uppercase mb-0">Total
              Payment :  <span class="h2 mb-0 ms-2"> <?php 
              
             

              $total_price = (mysqli_fetch_assoc(mysqli_query($con,"select sum(od.price)+om.gst*count(*) from order_details od , order_master om where user =  '$uid' and voucher_id = '$voucher_num' and od.order_id = om.id ")));

              echo implode($total_price); ?></span></h5>
          </div>
        </div>
      </div>

    </div>

  </div>
  
</section>




<style>
.gradient-custom {
/* fallback for old browsers */
background: #cd9cf2;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to top left, rgba(205, 156, 242, 1), rgba(246, 243, 255, 1));

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to top left, rgba(205, 156, 242, 1), rgba(246, 243, 255, 1))
}
</style>