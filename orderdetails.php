<?php
    include 'inc/header.php';
 ?>

<style>
   
</style>
<?php
        if(isset($_GET['confirmId'])){
            $cmrId = $_GET['confirmId'];
            $price = $_GET['price'];
            $date = $_GET['date'];
            $shiftConfirm = $cmr->shiftConfirmByCmr($cmrId, $price, $date);
        }
 ?>


    <?php
        if(!isset($_GET['orderId']) || $_GET['orderId'] == NULL){
            //echo "<script>window.location = 'cart.php'; </script>";
        }else{
            $orderId = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['orderId']);
            $deleteOrder = $cmr->OrderDelete($orderId);
        }
    ?>

 <div class="main">
    <div class="content">
        <div class="section group">

        <div class="order">
            <h2>Your Ordered Details</h2>

                <table class="tblone">
                    <tr>
                        <th>SL</th>
                        <th>Product</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>T.Price (10%)</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                        
                    </tr>

                        <?php
                            $cmrId = Session::get('cmrId');
                            $getOrderPro = $cmr->getProductOrder($cmrId);

                            if($getOrderPro){
                                $i = 0;
                                $price = 0;
                                while ($result = $getOrderPro->fetch_assoc()) {
                                    $i++;
                        ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $result['productName']; ?></td>
                        
                        <td><img src="admin/<?php echo $result['image']; ?>" alt=""/></td>
                        <td>Tk. <?php echo $result['price']; ?></td>
                        <td><?php echo $result['quantity']; ?></td>
                        <td>Tk. <?php
                            $quantity = $result['quantity'];
                            $price = $result['price']; 
                            $t_price = $price*$quantity; 
                            $vat = $t_price*0.1;
                            $g_price = $t_price+$vat; 
                            echo $g_price;
                         ?></td>
                        <td><?php echo $fm->formateDate($result['date']); ?></td>
                        <td>
                            <?php 
                                if($result['status'] == 0){
                                    echo "Pending";
                                }elseif($result['status'] == 1){
                                    echo "Shifted";
                                }else{
                                    echo "Ok";
                                }
                            ?>  
                        </td>
                        <?php
                            if($result['status'] == 1){ ?>
                                <td>
                                    <a href="?confirmId=<?php echo $result['cmrId'];?>&price=<?php echo $result['price'];?>&date=<?php echo $result['date'];?>">Confirm</a> 
                                </td>  

                    <?php }elseif($result['status'] == 0){ ?>
                                <td>N/A</td>

                    <?php }else{ ?> 
                                <td>
                                    <a onclick="return confirm('Are you sure to Remove!');" href="?orderId=<?php echo $result['id']; ?>">Remove</a>
                                </td> 
                    <?php }?>                
                    </tr>
                <?php }} ?> 
            </table>

        </div>
                
        </div>
    </div>
    </div>


<?php
    include 'inc/footer.php';
 ?>

