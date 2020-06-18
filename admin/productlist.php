<?php 
	include 'inc/header.php';
	include 'inc/sidebar.php';
	include "../classes/Product.php";
	include_once "../helpers/Format.php";
?>

<?php
	$fm = new Format();
	$product = new Product();

		if(isset($_GET['delId'])){
            $pid = $_GET['delId'];
			$pdDelete = $product->deleteProduct($pid);
        }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <?php
        	if(isset($pdDelete)){
        		echo $pdDelete;
        	}
        ?>

        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th width="5%">SL</th>
					<th width="10%">Product Name</th>
					<th width="10%">Category</th>
					<th width="10%">Brand</th>
					<th width="20%">Body</th>
					<th width="10%">Price</th>
					<th width="15%">Image</th>
					<th width="10%">Type</th>
					<th width="15%">Action</th>
				</tr>
			</thead>
			<tbody>

				<?php
					$getProduct = $product->getAllProduct();
					if($getProduct){
						$i=0;
						while ($result = $getProduct->fetch_assoc()) {
							$i++;
				?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['productName']; ?></td>
					<td><?php echo $result['catName']; ?></td>
					<td><?php echo $result['brandName']; ?></td>
					<td><?php echo $fm->textShorten($result['body'], 50); ?></td>
					<td><?php echo $result['price']; ?></td>
					<td><img src="<?php echo $result['image']; ?>" width="60px" height="40px"></td>
					
					<td><?php 
						if($result['type']== 0){
							echo "Featured";
						}else{
							echo "General";
						}
					?></td>
					<td><a href="productedit.php?pdId=<?php echo $result['productId']?>">Edit</a>
					|| <a onclick="return confirm('Are you sure to Delete'); " href="?delId=<?php echo $result['productId']?>">Delete</a></td>
				</tr>
			<?php }} ?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
