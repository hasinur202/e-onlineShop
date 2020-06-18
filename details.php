<?php
	include 'inc/header.php';
 ?>

 	<?php
 		if(!isset($_GET['proId']) || $_GET['proId'] == NULL){
 			echo "<script>window.location = '404.php'; </script>";
 		}else{
 			$id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['proId']);
 		}
 	?>

<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $quantity = $_POST['quantity'];
        $addCart = $ct->addToCart($quantity, $id);
    }
?>


<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['compare'])){
        $proId = $_POST['productId'];
 		$addCompare = $pd->insertToCompare($cmrId, $proId);

    }
?>


 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="cont-desc span_1_of_2">	
					<?php
					$getPd = $pd->getSingleProduct($id);
						if($getPd){
							while ($result = $getPd->fetch_assoc()) {
						
					?>

					<div class="grid images_3_of_2">
						<img src="admin/<?php echo $result['image']; ?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result['productName']; ?> </h2>
					<p><?php echo $fm->textShorten($result['body'], 100); ?></p>					
					<div class="price">
						<p>Price: <span><?php echo $result['price']; ?></span></p>
						<p>Category: <span><?php echo $result['catName']; ?></span></p>
						<p>Brand:<span><?php echo $result['brandName']; ?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
						
					</form>	
					
						<span style="color: red; font-size: 18px; ">
							<?php
								if(isset($addCart)){
								echo $addCart;
							} ?>
						</span>
				</div>
				<?php
					if(isset($addCompare)){
						echo $addCompare;
					}
				?>
				<?php
					$custLogin = Session::get('cmrLogin');
					if($custLogin == true){
				?>

				<div class="add-cart">
					<form action="" method="post">
						<input type="hidden" class="buyfield" name="productId" value="<?php echo $result['productId'];?>"/>
						<input type="submit" class="buysubmit" name="compare" value="Add to compare"/>
					</form>	
				</div>
			<?php } ?>


			</div>
			<div class="product-desc">
			<h2>Product Details</h2>
			<p><?php echo $result['body']; ?></p>
	    </div>
	<?php } } ?>
				
	</div>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<?php
						$getAllCategory = $cat->catSelect();
						if($getAllCategory){
							while ($value = $getAllCategory->fetch_assoc()) {
					?>
					<ul>
				      <li><a href="productbycat.php?catId=<?php echo $value['catId'];?>"><?php echo $value['catName'];?></a></li>
    				</ul>
    			<?php } } ?>
 				</div>
 		</div>
 	</div>
	</div>


<?php
	include 'inc/footer.php';
 ?>
