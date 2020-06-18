<?php
    include 'inc/header.php';
 ?>

<style>
   .division{width: 50%; float: left; }
   .tbltwo {
    float: right;
    width: 60%;
    border: 2px solid #5D97C7;
    margin-right: 30px;
    margin-top: 12px;
    background: #F3F3F3;
    font-weight: bold;

}
   .tbltwo tr td{text-align: justify; padding: 5px 5px 5px 10px;}

    .tblone{width: 90%; margin: 0 auto; border: 2px solid #ddd; }
    .tblone tr td{text-align: justify;}
    .back {margin-top: 20px; }
    .back a { width: 160px; text-align: center; border: 1px solid #ddd; margin: 5px auto; padding: 10px;   display: block; font-size: 20px; font-weight: bold; color: #fff; background: #18A15E; border-radius: 11px;
    }
    .back a:hover {color: #FF9800; background: #454545; }
</style>


<?php
        if(isset($_GET['action']) && $_GET['action'] == "order"){
            $cmrId = Session::get('cmrId');
            $insertOrder = $cmr->orderInsert($cmrId);
            $delData = $ct->deleteSessionCart();
            header("Location: success.php");
    } ?>

 <div class="main">
    <div class="content">
        <div class="section group">
            <div class="division">
                <table class="tblone">
                    <tr>
                        <th >No</th>
                        <th >Product</th>
                        <th >Price</th>
                        <th >Quantity</th>
                        <th >Total Price</th>
                       
                    </tr>

                        <?php
                            $getCart = $ct->getProductCart();

                            if($getCart){
                                $i = 0;
                                $sum = 0;
                                $qty = 0;
                                while ($result = $getCart->fetch_assoc()) {
                                    $i++;
                        ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $result['productName']; ?></td>
                        <td>Tk. <?php echo $result['price']; ?></td>
                        <td><?php echo $result['quantity']; ?></td>
                        <td>Tk. 
                            <?php
                                $quantity = $result['quantity'];
                                $price = $result['price'];
                                $totalprice = $quantity*$price;
                                echo $totalprice;
                            ?>
                            </td>
                                     
                    </tr>

                <?php 
                    $qty = $qty + $result['quantity'];
                    $sum = $totalprice + $sum;
                    
                }} ?>
                    
                </table>
                
                <table class="tbltwo">
                    <tr>
                        <?php 
                            $vat = $sum * 0.1;
                            $gtotal = $vat + $sum;

                        ?>                              
                        <td>Sub Total</td>
                         <td>:</td>
                        <td>TK. <?php echo $sum; ?></td>
                    </tr>
                    <tr>
                        <td>VAT</td>
                        <td>:</td>
                        <td>TK. <?php echo $vat; ?> (10%)</td>
                    </tr>
                    <tr>
                        <td>Grand Total</td>
                        <td>:</td>
                        <td>TK. <?php echo $gtotal; ?> </td>
                    </tr>
                    <tr>
                        <td>Quantity</td>
                        <td>:</td>
                        <td><?php echo $qty; ?> </td>
                    </tr>
               </table>


            </div>
            <div class="division">
            <?php
                $id = Session::get("cmrId");
                $getCmr = $cmr->getCustomerProfile($id);
                if($getCmr){
                    while ($result = $getCmr->fetch_assoc()) {          
            ?>
                <table class="tblone">
                    <tr >
                        <td colspan="3"><h2>Customer Profile Details</h2></td>
         
                    </tr>
                    <tr>
                        <td width="20%">Name</td>
                        <td width="5%">:</td>
                        <td><?php echo $result['name']; ?></td>

                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>:</td>
                        <td><?php echo $result['address']; ?></td>

                    </tr>
                    <tr>
                        <td>City</td>
                        <td>:</td>
                        <td><?php echo $result['city']; ?></td>

                    </tr>
                    <tr>
                        <td>Country</td>
                        <td>:</td>
                        <td><?php echo $result['country']; ?></td>

                    </tr>
                    <tr>
                        <td>Zip-Code</td>
                        <td>:</td>
                        <td><?php echo $result['zipcode']; ?></td>

                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>:</td>
                        <td><?php echo $result['phone']; ?></td>

                    </tr>
                    <tr>
                        <td>E-mail</td>
                        <td>:</td>
                        <td><?php echo $result['email']; ?></td>

                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><a href="editCmrProfile.php">Update Details</a></td>

                    </tr>
                </table>
            <?php }} ?>
            </div>
        </div>
            <div class="back">
                <a href="?action=order">Order</a>

            </div>
    </div>
    </div>


<?php
    include 'inc/footer.php';
 ?>
