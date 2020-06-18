<?php
    include 'inc/header.php';
 ?>

    <?php
        // if(!isset($_GET['details']) || $_GET['details'] == NULL){
        //     // $orderId = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['orderId']);
        //     // $deleteOrder = $cmr->OrderDelete($orderId);
        //     header("Location: details.php");
        // }
    ?> 


 <div class="main">
    <div class="content">
        <div class="section group">

        <div class="order">
            <h2>Compare List</h2>

                <table class="tblone">
                    <tr>
                        <th>SL</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>

                <?php
                    $getCompare = $pd->getCompareProduct($cmrId);

                    if($getCompare){
                        $i = 0;
                        while ($result = $getCompare->fetch_assoc()) {
                            $i++;
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $result['productName']; ?></td>
                        <td>Tk. <?php echo $result['price']; ?></td>
                        <td><img src="admin/<?php echo $result['image']; ?>" alt=""/></td>
                        <td>
                            <a href="details.php?proId=<?php echo $result['productId'];?>">View</a>
                        </td> 
                               
                    </tr>
                <?php }} ?> 
            </table>

        </div>
                    <div class="shopping">
                        <div class="shopleft">
                            <a href="index.php"> <img src="images/shop.png" alt="" /></a>
                        </div>
                        
                    </div>
                
        </div>
    </div>
    </div>


<?php
    include 'inc/footer.php';
 ?>

