<?php
include ("header.php");


if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id']) && $_GET['id']>0){
	$type=($_GET['type']);
	$id=($_GET['id']);
    
    if($type == 'setCart'){
        
    }

}
?>
<!-- jannati bnda hai bhai tu , adha ghnta zaya hogya isk chakr mein -->
<!-- stackoverflow -->

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

<!-- for alert of item added to cart -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



<div class="breadcrumb-area gray-bg">
            <div class="container">
                <div class="breadcrumb-content">
                    <ul>
                        <li><a href="UserIndex.php">Shop Here</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="shop-page-area pt-100 pb-100">
            <div class="container">
                <div class="row flex-row-reverse">
                    <div class="col-lg-9">
                        
                        <?php
                        

                        
                            $cat_id=0;
                            $product_sql="select * from dish where status=1";
                            if(isset($_GET['cat_id']) && $_GET['cat_id']>0){
                                $cat_id=htmlspecialchars($_GET['cat_id']);
                                $product_sql.=" and category_id='$cat_id' ";
                            }
                            $product_sql.=" order by dish desc";
                            $product_res=mysqli_query($con,$product_sql);
                            $product_count=mysqli_num_rows($product_res);
                        ?>

                        <div class="grid-list-product-wrapper">
                        
                            <div class="product-grid product-view pb-20">
                            
                                <?php if($product_count>0){?>
                                    <div class="row">
                                        <?php while($product_row=mysqli_fetch_assoc($product_res)){?>
                                        <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                                            <div class="product-wrapper">
                                                <div class="product-img helo">
                                                    <a href="javascript:void(0)">
                                                        <img src="<?php echo SITE_DISH_IMAGE.$product_row['Image']?>" alt="">
                                                    </a>
                                                </div>
                                                <div class="product-content"  id="dish_detail">
                                                    <h4>
                                                        <a href="javascript:void(0)"><?php echo $product_row['Dish']?> </a>
                                                    </h4>
                                                <!-- // -->
                                                <?php 
                                               
                                                $dish_attr_res = mysqli_query($con,"select * from dish_detail where status=1 and dish_id='".$product_row['ID']. "' order by price asc ");
                                                $temp = mysqli_fetch_assoc(mysqli_query($con,"select id from dish_detail where id in (select dish_detail_id from cart)"));
                                                ?>

                                                <div class="product-price-wrapper">
                                                    <?php
                                                    while($dish_attr_row=mysqli_fetch_assoc($dish_attr_res)){
                                                        echo "<input type='radio' class='radio_style' name= 'radio_".$product_row['ID']."' 
                                                        id= 'radio_".$product_row['ID']."'value='".$dish_attr_row['ID']."'
                                                        
                                                        '/>";
                                                       echo $dish_attr_row['attribute'];
                                                       echo "&nbsp - Rs: ";
                                                       echo $dish_attr_row['Price'];                                               
                                                       echo "/-<br>";

                                                       
   
                                                    }
                                                    ?> 
                                                </div>
                                                <!-- ////// -->
                                                <div class="product-price-wrapper" >
                                                    <select class="a" id="qty<?php echo $product_row['ID']?>">
                                                        <option value="1">Quantity</option>
                                                        <?php
                                                        for($i=1;$i<=10;$i++){
                                                            echo "<option>$i</option>";
                                                        }
                                                        ?>
                                                       
                                                      </select>
                                                      <a href="?id=<?php echo $product_row['ID']?>&type=setCart" ><i class="fa fa-cart-plus kch_bhi" aria-hidden="true" onclick="addToCart('<?php echo $product_row['ID'] ?>','add')" ></i></a>


                                                </div>
                                                    <!-- ////// -->
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>        
                                    </div>
                                <?php } else{ 
                                    echo "No dish found";   
                                }?>
                            </div>
                            
                        </div>
                    </div>
                    <?php
                    $cat_res=mysqli_query($con,"select * from category where status=1 order by order_number desc")
                    ?>
                    <div class="col-lg-3">
                        <div class="shop-sidebar-wrapper gray-bg-7 shop-sidebar-mrg">
                            <div class="shop-widget">
                                <h4 class="shop-sidebar-title">Shop By Categories</h4>
                                <div class="shop-catigory">
                                    
                                    <ul id="faq" class="category_list">
                                    <li><a href="UserIndex.php">Show All</a></li>
                                        <?php 
                                        while($cat_row=mysqli_fetch_assoc($cat_res)){
                                            $class="selected";
                                            if($cat_id == $cat_row['ID']){
                                                $class="active";
                                            }
                                            echo "<li> <a $class href='UserIndex.php?cat_id=".$cat_row['ID']."'/>".$cat_row['category']."</li>";

                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<style>
.product-price-wrapper .radio_style{

width: 16px;
    height: 12px;
    margin-right: 5px; 
    cursor:pointer;
}

.kch_bhi{
    font-size:25px;
    margin-left:130px;
    cursor:pointer;
}
.a{
    width:80px;
}

.helo{
    border-radius:6px;
}
</style>


<script>

function addToCart(id,type){
var qty=jQuery('#qty'+id).val();
var attr=jQuery('input[name="radio_'+id+'"]:checked').val();

// alert(qty);
// alert(attr);

jQuery.ajax(
    {
        url:'manageCart.php',
        type:'post',
        data:({qty:qty , attr:attr,type:type}),
        success:function(result){
            //Hello sweet JS wale bhai
            swal("Item Added to Cart!", "Press OK to continue!", "success");
        }
    }
);

}

</script>


