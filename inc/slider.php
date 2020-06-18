	<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">
				<div class="listview_1_of_2 images_1_of_2">
				<?php
					$getiphone = $pd->getSingleIphone();
					if($getiphone){
						while ($result = $getiphone->fetch_assoc()) {
				?>
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proId=<?php echo $result['productId'];?>"> <img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?php echo $result['brandName']; ?></h2>
						<p><?php echo $result['productName']; ?></p>
						<div class="button"><span><a href="details.php?proId=<?php echo $result['productId'];?>">Add to cart</a></span></div>
				   </div>
				   <?php }} ?>
			   </div>
				<div class="listview_1_of_2 images_1_of_2">
				<?php
					$getsamsung = $pd->getSingleSamsung();
					if($getsamsung){
						while ($result = $getsamsung->fetch_assoc()) {
				?>
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proId=<?php echo $result['productId'];?>"> <img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?php echo $result['brandName']; ?></h2>
						<p><?php echo $result['productName']; ?></p>
						<div class="button"><span><a href="details.php?proId=<?php echo $result['productId'];?>">Add to cart</a></span></div>
				   </div>
				   <?php }} ?>
			   </div>			
			</div>
			<div class="section group">
				<div class="listview_1_of_2 images_1_of_2">
				<?php
					$getiacer = $pd->getSingleAcer();
					if($getiacer){
						while ($result = $getiacer->fetch_assoc()) {
				?>
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proId=<?php echo $result['productId'];?>"> <img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?php echo $result['brandName']; ?></h2>
						<p><?php echo $result['productName']; ?></p>
						<div class="button"><span><a href="details.php?proId=<?php echo $result['productId'];?>">Add to cart</a></span></div>
				   </div>
				   <?php }} ?>
			   </div>
				<div class="listview_1_of_2 images_1_of_2">
				<?php
					$getcanon = $pd->getSingleCanon();
					if($getcanon){
						while ($result = $getcanon->fetch_assoc()) {
				?>
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proId=<?php echo $result['productId'];?>"> <img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?php echo $result['brandName']; ?></h2>
						<p><?php echo $result['productName']; ?></p>
						<div class="button"><span><a href="details.php?proId=<?php echo $result['productId'];?>">Add to cart</a></span></div>
				   </div>
				   <?php }} ?>
			   </div>			
			</div>

		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<li><img src="images/1.jpg" alt=""/></li>
						<li><img src="images/2.jpg" alt=""/></li>
						<li><img src="images/3.jpg" alt=""/></li>
						<li><img src="images/4.jpg" alt=""/></li>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>