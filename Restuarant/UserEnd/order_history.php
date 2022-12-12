<?php
include ("header.php");
$uid = $_SESSION['IS_LOGIN'];

$uid = $_SESSION['IS_LOGIN'];
$sql = "select * from order_master where user_id = '$uid'";
$res = mysqli_query($con,$sql);

if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id']) && $_GET['id']>0){
	$type=($_GET['type']);
	$id=($_GET['id']);    
    
}


?>

<div class="cart-main-area pt-95 pb-100">
            <div class="container">
                <h3 class="page-title">ORDER HISTORY</h3>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <form method="POST">
                            <div class="table-content table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Order Date </th>
                                            <th>Address</th>
                                            <th>Total</th>
                                            <th>Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(mysqli_num_rows($res) > 0) {
                                            $i=1;
                                            while($row = mysqli_fetch_assoc($res)){
                                            ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            
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
                                                                $t1 = mysqli_fetch_assoc(mysqli_query($con,"select  d.dish,dd.Price,d.Image from dish_detail dd,dish d where dd.id = '$h1' and dd.dish_id = d.id "));?>
                                                                <!-- <span class="abc">
                                                                <td><img src="<?php //echo SITE_DISH_IMAGE.$t1['Image']?>"/></td>
                                                            </span> -->
                                                                <?php echo ($t1['dish'])?>
                                                                <li width="15%">Quantity : <?php echo $order_detail_row['qty'] ?></li>
                                                                <li width="5%">Price     : Rs.  <?php echo $t1['Price']?>/-</li>                                                                                                
                                                        </ul>
                                                        <?php   $count = $count+1; } } ?>								
                                            </td>                            
                                       </tr>
                
                                        <?php 
                                            $i++;
                                            } }else{?>
                                            <tr>
                                            <td colspan="4">No Data Found</td>
                                            </tr>
                                            <?php  } ?>

                                        


                                        </tr>
                                    </tbody>
                                </table>
                                    </div>
                         
                       
                        </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="cart-shiping-update-wrapper">

                                        <div class="cart-shiping-update ">
                                            <a href="UserIndex.php">BACK TO HOME PAGE</a>
                                        </div>


                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

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
.abc{
    height:50px;
    width:50px;
}
</style>



