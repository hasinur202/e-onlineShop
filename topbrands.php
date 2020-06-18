<?php
	include 'inc/header.php';
 ?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Acer</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	      	<?php
	      			$getacer = $pd->getAllAcer();
	      			if($getacer){
	      				while ($result = $getacer->fetch_assoc()) {
	      	?>
				<div class="grid_1_of_4 images_1_of_4">
					<a href="details.php?proId=<?php echo $result['productId'];?>"><img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					 <h2><?php echo $result['productName']; ?></h2>
					 <p><span class="price">Tk. <?php echo $result['price']; ?></span></p>
				     <div class="button"><span><a href="details.php?proId=<?php echo $result['productId'];?>" class="details">Details</a></span></div>
				</div>
				<?php } } ?>
			</div>

		<div class="content_bottom">
    		<div class="heading">
    		<h3>Samsung</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
	      	<?php
	      			$getsamsung = $pd->getAllSamsung();
	      			if($getsamsung){
	      				while ($result = $getsamsung->fetch_assoc()) {
	      	?>
				<div class="grid_1_of_4 images_1_of_4">
					<a href="details.php?proId=<?php echo $result['productId'];?>"><img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					 <h2><?php echo $result['productName']; ?></h2>
					 <p><span class="price">Tk. <?php echo $result['price']; ?></span></p>
				     <div class="button"><span><a href="details.php?proId=<?php echo $result['productId'];?>" class="details">Details</a></span></div>
				</div>
				<?php } } ?>
			</div>

	<div class="content_bottom">
    		<div class="heading">
    		<h3>Canon</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
	      	<?php
	      			$getcanon = $pd->getAllCanon();
	      			if($getcanon){
	      				while ($result = $getcanon->fetch_assoc()) {
	      	?>
				<div class="grid_1_of_4 images_1_of_4">
					<a href="details.php?proId=<?php echo $result['productId'];?>"><img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					 <h2><?php echo $result['productName']; ?></h2>
					 <p><span class="price">Tk. <?php echo $result['price']; ?></span></p>
				     <div class="button"><span><a href="details.php?proId=<?php echo $result['productId'];?>" class="details">Details</a></span></div>
				</div>
				<?php } } ?>
			</div>
    </div>
 </div>

 <?php
	include 'inc/footer.php';
 ?>