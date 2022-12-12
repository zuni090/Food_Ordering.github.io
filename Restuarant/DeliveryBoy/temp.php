<div class="card">
            <div class="card-body">
              <h2 class="grid_title">Order Master</h2><br><br>
              <div class="row grid_box">
				
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th width="5%">S.No</th>
                            <th width="20%">Name / Cell #</th>
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
                                                <a href="?id=<?php echo $row['ID']?>&type=deactive"><label class="badge badge-danger hand_cursor">Pending</label></a>
                                                <?php
                                                }
                                                else{
                                                ?>
                                                <a href="?id=<?php echo $row['ID']?>&type=active"><label class="badge badge-success hand_cursor">Delivered</label></a>
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
								<a href="?id=<?php echo $row['ID']?>&type=deactive"><label class="badge badge-danger hand_cursor">Pending</label></a>
								<?php
								}
								else{
								?>
								<a href="?id=<?php echo $row['ID']?>&type=active"><label class="badge badge-success hand_cursor">Success</label></a>
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