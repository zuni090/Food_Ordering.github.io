<?php

session_start();
include('Database.inc.php');
include('constant.inc.php');

$id=$_SESSION['IS_LOGIN'];
$attr=htmlspecialchars($_POST['attr']);
$qty=htmlspecialchars($_POST['qty']);
$added_on=htmlspecialchars(date('Y-m-d '));
$type=htmlspecialchars($_POST['type']);

if($type == 'add'){
        
        $check=mysqli_query($con,"select * from cart where user_id = '$id' and dish_detail_id = '$attr'");
        if(mysqli_num_rows($check) > 0){
            $row = mysqli_fetch_assoc($check);
            $cid = $row['ID'];
            mysqli_query($con,"update  cart set quantity = '$qty' where id = '$cid'");
        }
        else{
            mysqli_query($con,"insert into  cart(user_id,dish_detail_id,added_on,quantity) values('$id','$attr','$added_on','$qty')");
        }

}
?>