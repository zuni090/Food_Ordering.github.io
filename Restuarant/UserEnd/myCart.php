<?php

include ("header.php");

$temp="";
$address="";

$uid = $_SESSION['IS_LOGIN'];
$sql = "select * from cart where user_id = '$uid'";
$res = mysqli_query($con,$sql);
$res1 = mysqli_query($con,"select * from user where id = '$uid'");

if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id']) && $_GET['id']>0){
	$type=($_GET['type']);
	$id=($_GET['id']);
    

	if($type=='delete'){
		mysqli_query($con,"delete from cart where user_id='$uid'");
		redirect('myCart.php');
	}

    if($type=='deleteSingle'){
		mysqli_query($con,"delete from cart where id = '$id' and user_id='$uid'");
		redirect('myCart.php');
	}

    if($type=='placeOrder'){

        $res = mysqli_query($con,"select * from cart where user_id = '$uid'");
        if(mysqli_num_rows($res) > 0){
            $getTotalPrice = "select sum(d.price*c.quantity) as total , c.quantity   from dish_detail d , cart c where d.id = c.dish_detail_id and c.user_id='$uid';";
            $temp = mysqli_fetch_assoc(mysqli_query($con,$getTotalPrice));
            $totalPrice = $temp['total'];
            $gst=100;
            $delivery_person = "select id from delivery_boy order by rand() limit 1;";
            $delivery = implode(mysqli_fetch_assoc(mysqli_query($con,$delivery_person)));
            $row = mysqli_fetch_assoc($res1);
            $address = $row['Address'];
            $added_on=htmlspecialchars(date('Y-m-d '));
            
            mysqli_query($con,"insert into order_master(user_id,total_price,gst,delivery_boy_id,Payment_address,order_status,added_on) values('$uid','$totalPrice','$gst','$delivery','$address',1,'$added_on')");

            redirect('checkout.php');
        }
        else{
            redirect('myCart.php');
        }
	}
        
}


?>

<div class="cart-main-area pt-95 pb-100">
            <div class="container">
                <h3 class="page-title">Your cart items</h3>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <form method="POST">
                            <div class="table-content table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th width="20">Image</th>
                                            <th width="20">Product </th>
                                            <th width="15">Price</th>
                                            <th width="15">Quantity</th>
                                            <th width="15">Sub Total</th>
                                            <th width="15">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(mysqli_num_rows($res) > 0){

                                            $SQL = "select d.* , dd.*, c.* from dish d,dish_detail dd , cart c where d.id = dd.dish_id and dd.id = c.dish_detail_id and c.user_id = '$uid'";
                                            $product_res=mysqli_query($con,$SQL);
                                
                                            while($row = mysqli_fetch_assoc($res)){
                                                ?>
                                                <?php $product_row = mysqli_fetch_assoc($product_res);?>
                                                <!-- html dalo -->
                                                <tr>
                                                
                                                <td class="product-thumbnail">
                                                <a href="#"><img src="<?php echo SITE_DISH_IMAGE.$product_row['Image']?>" alt="" class="resize_krle"></a>
                                                </td>

                                                <td class="product-name"><a href="#"><?php
                                                echo $product_row['Dish'];
                                                ?></a></td>

                                                <td class="product-price-cart"><span class="amount"><?php  echo $product_row['Price']; ?></span></td>

                                                <td class="product-quantity">
                                                    
                                                    <div class="cart-plus-minus">
                                                    <input class="cart-plus-minus-box" type="text" name="tempVal"  value="<?php                                   
                                                    
                                                    $temp = $product_row['quantity'];
                                                    echo $temp;
                                                    
                                                    
                                                    ?>"
                                                    />     
                                                    <a href="?id=<?php echo $product_row['ID']?>&type=updateQty"><i class="fa fa-pencil"></i></a>                                              
                                            </div>
                                                  

                                                </td>

                                                <td class="product-subtotal"><?php
                                                echo $product_row['Price']*$product_row['quantity'];
                                                
                                                ?></td>

                                                <td class="product-remove">
                                                    

                                                    <a href="?id=<?php echo $product_row['ID']?>&type=deleteSingle" ><i class="fa fa-times"></i></a>                                          
                                                

                                                </td>
                                                </tr>
                                                <!-- html end -->
                                            <?php
                                            }
                                        }  else{ ?><h5>Cart is Empty!<h5><?php }?>

                                        


                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Ending of Cart -->
                        <br>
                         <!-- <div class="row">
                            <span class="col-lg-6 col-md-6">
                            <span class="billing-info">
                                <label for="address">Delivery Address</label>
                                <input type="text" name="address" value="
                                    <?php
                                //   echo $address;
                                        
                                    ?>
                                    "> -->
                                        
                                    </span>
                                    <!-- <br><br>
                                    <input type="submit" value= "Set Address"name="setAddress" class="setkro " href="?id=<?php// echo $_SESSION['IS_LOGIN']?>&type=changeAddress"/> -->
                                    </span> 
                                    </div>
                        </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="cart-shiping-update-wrapper">

                                        <div class="cart-shiping-update ">
                                            <a href="UserIndex.php">Continue Shopping</a>
                                        </div>

                                        <div>
                                            <span class="clear-cart cart-shiping-update ">
                                            <a href="?id=<?php echo $_SESSION['IS_LOGIN']?>&type=placeOrder" class="cart-clear">Place Order</a>
                                            </span>

                                            <span class="clear-cart cart-shiping-update ">
                                            <a href="?id=<?php echo $_SESSION['IS_LOGIN']?>&type=delete" class="cart-clear">Empty Cart</a>
                                            </span>
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
</style>
