<?php
	include 'inc/header.php';
 ?>

<style>
    .payment{width: 550px; text-align: center; min-height: 200px; border: 1px solid #ddd; margin: 0 auto; padding: 50px; }
    
    .payment h2 { margin-bottom: 30px; border-bottom: 4px solid #008000; }
    .payment span{font-size: 25px; color: green; font-weight: bold; text-align: center;}
    .payment p{ font-size: 20px; text-align: justify; }
    
</style>


 <div class="main">
    <div class="content">
    	<div class="section group">

    	<div class="payment">
            <h2>Success</h2>
            <span>Payment Successfully done....!</span>
            <?php
                $cmrId = Session::get("cmrId");
                $getprice = $ct->payableAmount($cmrId);
                if($getprice){
                    $sum=0;
                    while ($result = $getprice->fetch_assoc()) {
                        $quantity = $result['quantity'];
                        $price = $result['price']*$quantity;
                        $sum = $sum+$price;
                    }
                
            ?>
           <p>Total Payable Amount (Including VAT): Tk. 
            <?php
                $vat = $sum*0.1;
                $total = $sum + $vat;
                echo $total;
            }
            ?> </p>
            <p>Thanks for Purchase. We will contact you ASAP with delivery details. Here is your order details...<a href="orderdetails.php">Visit Here</a></p>

        </div>
        
				
 		</div>
 	</div>
	</div>


<?php
	include 'inc/footer.php';
 ?>
