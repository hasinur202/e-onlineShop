<?php
	include 'inc/header.php';
 ?>

<?php
 		if(!isset($_GET['catId']) || $_GET['catId'] == NULL){
 			echo "<script>window.location = '404.php'; </script>";
 		}else{
 			$id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['catId']);

 			$getProduct = $pd->getProductByCatId($id);
 		}
 	?>


 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
			<?php
	      		if($getProduct){
	      			$value = $getProduct->fetch_assoc();
	      	?>
    		<h3>Latest from <?php echo $value['catName']; ?></h3>
    		</div>
    		<div class="clear"></div>
    	</div>

    	
	      <div class="section group">
	      	<?php

				while ($result = $getProduct->fetch_assoc()) {
    		?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proId=<?php echo $result['productId'];?>"><img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					 <h2><?php echo $result['productName']; ?></h2>
					 <p><?php echo $fm->textShorten($result['body'], 50); ?></p>
					 <p><span class="price">Tk. <?php echo $result['price']; ?></span></p>
				     <div class="button"><span><a href="details.php?proId=<?php echo $result['productId'];?>" class="details">Details</a></span></div>
				
				
				<!-- <div class="grid_1_of_4 images_1_of_4" style="margin-left:0">
					 <a href="preview-3.php"><img src="images/new-pic1.jpg" alt="" /></a>
					 <h2>Lorem Ipsum is simply </h2>
					 <p><span class="price">$403.66</span></p>
				    
				     <div class="button"><span><a href="preview.php" class="details">Details</a></span></div>
				-->
			</div> 
				<?php }}else{
					header("Location: 404.php");
				} ?>	
			</div>
	
    </div>
 </div>

 <?php
	include 'inc/footer.php';
 ?>