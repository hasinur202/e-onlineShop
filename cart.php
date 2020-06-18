<?php
	include 'inc/header.php';
 ?>


 	<?php
 		if(!isset($_GET['proId']) || $_GET['proId'] == NULL){
 			//echo "<script>window.location = 'cart.php'; </script>";
 		}else{
 			$delProId = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['proId']);

 			$deleteCart = $ct->CartDeleteById($delProId);
 		}
 	?>


<?php
 if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $cartId = $_POST['cartId'];
        $quantity = $_POST['quantity'];
        $quantityUpdate = $ct->updateQuantity($quantity, $cartId);
        if($quantity <= 0){
        	$deleteCart = $ct->CartDeleteById($cartId);
        }
    }
?>
<?php
	if(!isset($_GET['id'])){
		echo "<meta http-equiv='refresh' content='0;URL=?id=live'/>";
	}

?>

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
			    		<?php
			    			if(isset($quantityUpdate)){
			    				echo $quantityUpdate;
			    			}
			    		?>
			    		<?php
			    			if(isset($deleteCart)){
			    				echo $deleteCart;
			    			}
			    		?>
						<table class="tblone">
							<tr>
								<th width="5%">SL</th>
								<th width="20%">Product Name</th>
								<th width="15%">Image</th>
								<th width="20%">Price</th>
								<th width="25%">Quantity</th>
								<th width="25%">Total Price</th>
								<th width="10%">Action</th>
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
								
								<td><img src="admin/<?php echo $result['image']; ?>" alt=""/></td>
								<td>Tk. <?php echo $result['price']; ?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartId" value="<?php echo $result['cartId']; ?>"/>
										<input type="number" name="quantity" value="<?php echo $result['quantity']; ?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<td>
									<?php
										$quantity = $result['quantity'];
										$price = $result['price'];
										$totalprice = $quantity*$price;
										echo $totalprice;
									?>
									</td>
								<td><a onclick="return confirm('Are you sure to Remove!');" href="?proId=<?php echo $result['cartId']; ?>">Remove</a></td>						
							</tr>

						<?php 
							$qty = $qty + $result['quantity'];
							$sum = $totalprice + $sum;
							Session::set("qty", $qty);
							Session::set("sum", $sum);
						}} ?>
							
						</table>
						<?php
							$getData = $ct->checkCartTable();
								if($getData){
						?>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<?php 
									$vat = $sum * 0.1;
									$gtotal = $vat + $sum;
									Session::set("gtotal", $gtotal);

								?>								
								<th>Sub Total : </th>
								<td>TK. <?php echo $sum; ?></td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>TK. <?php echo $vat; ?> (10%)</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td>TK. <?php echo $gtotal; ?> </td>
							</tr>
					   </table>
					<?php }else{
						header("Location: index.php");
					} ?>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>

 <?php
	include 'inc/footer.php';
 ?>
