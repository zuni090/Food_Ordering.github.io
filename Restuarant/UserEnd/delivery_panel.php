<?php 

include('header.php');
$uid = $_SESSION['IS_LOGIN'];
$sql = "select * from order_details where user = '$uid'";
$res = mysqli_query($con,$sql);


if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id']) && $_GET['id']>0){
	$type=($_GET['type']);
	$id=($_GET['id']);
    


    if($type=='pending' || $type=='delivered'){
		$status=2;
		if($type=='pending'){
			$status=1;
		}
		mysqli_query($con,"update order_master set order_status ='$status' where id='$id'");
		redirect('delivery_panel.php');
	}


}

?>

<div class="cart-main-area pt-95 pb-100">
            <div class="container">
                <h3 class="page-title">Items Needed to be Delivered</h3>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <form method="POST">
                            <div class="table-content table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th  width="25%">Product Items </th>
                                            <th  width="25%">Price</th>
                                            <th  width="25%">Quantity</th>
                                            <th  width="25%">Order Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(mysqli_num_rows($res) > 0){

                                            $SQL = "select d.* , dd.*, o.*,oo.* from dish d,dish_detail dd , order_details o , order_master oo where d.id = dd.dish_id and dd.id = o.dish_details_id 
                                            and  oo.id = o.order_id and o.user = '$uid';";
                                            $product_res=mysqli_query($con,$SQL);
                                
                                            while($row = mysqli_fetch_assoc($res)){
                                                ?>
                                                <?php $product_row = mysqli_fetch_assoc($product_res);?>
                                                <!-- html dalo -->
                                                <tr>
                                                
                                               <!-- 1 -->
                                                <td class="product-name"><a href="#"><?php
                                                echo $product_row['Dish'];
                                                ?></a>
                                                </td>

                                                <!-- 2 -->
                                                <td class="product-price-cart"><span class="amount"><?php  echo $product_row['Price']; ?></span></td>

                                                <!-- 3 -->
                                                

                                                <!-- 4 -->
                                                <td class="product-subtotal"><?php
                                                echo $product_row['qty'];
                                                
                                                ?></td>

                                                <!-- 5 -->

                                                <td class="product-remove">
                                                    

                                               
                                                    <?php
                                                   $row = mysqli_fetch_assoc(mysqli_query($con,"select * from order_master oo  where user_id = '$uid' order by id"));
                                                    if($product_row['order_status']==1){
                                                    ?>
                                                    <a href="?id=<?php echo $row['ID']?>&type=delivered" ><label class="badge badge-danger hand_cursor">Pending</label></a>
                                                    <?php
                                                    }
                                                    else{
                                                    ?>
                                                   <a href="?id=<?php echo $row['ID']?>&type=pending" ><label class="badge badge-danger hand_cursor">Delivered</label></a>
                                                    <?php
                                                    }
                                                    
                                                    ?>
                                                                                             
                                                </td>
                                                </tr>
                                                <!-- html end -->
                                            <?php
                                           }
                                        } ?>

                                        


                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Ending of Cart -->
                        <br>

                                    
                                    
                                        
                                    </span>
                                    <!-- <br><br>
                                    <input type="submit" value= "Set Address"name="setAddress" class="setkro " href="?id=<?php// echo $_SESSION['IS_LOGIN']?>&type=changeAddress"/> -->
                                    </span> 
                       
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

