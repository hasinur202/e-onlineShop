<?php
	include 'inc/header.php';
 ?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Latest from Iphone</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	      	<?php
	      		$getIphone = $pd->getAllIphone();
	      		if($getIphone){
	      			while ($result = $getIphone->fetch_assoc()) {
	      				
	      	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proId=<?php echo $result['productId'];?>"><img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					 <h2><?php echo $result['productName']; ?></h2>
					 <p><?php echo $fm->textShorten($result['body'], 50); ?></p>
					 <p><span class="price">Tk. <?php echo $result['price']; ?></span></p>
				     <div class="button"><span><a href="details.php?proId=<?php echo $result['productId'];?>" class="details">Details</a></span></div>
				</div>
				<?php }} ?>
			</div>

			<div class="content_bottom">
    		<div class="heading">

    		<h3>Latest from Acer</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
	      	<?php
	      		$getAcer = $pd->getAllAcer();
	      		if($getAcer){
	      			while ($value = $getAcer->fetch_assoc()) {
	      				
	      	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proId=<?php echo $value['productId'];?>"><img src="admin/<?php echo $value['image']; ?>" alt="" /></a>
					 <h2><?php echo $value['productName']; ?></h2>
					 <p><?php echo $fm->textShorten($value['body'], 50); ?></p>
					 <p><span class="price">Tk. <?php echo $value['price']; ?></span></p>
				     <div class="button"><span><a href="details.php?proId=<?php echo $value['productId'];?>" class="details">Details</a></span></div>
				</div>
				<?php }} ?>
			</div>
    </div>
 </div>

 <?php
	include 'inc/footer.php';
 ?>