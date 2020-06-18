<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
    include "../classes/Brand.php";
?>

	<?php
		$brand = new Brand();
        if(isset($_GET['delid'])){
            $id = $_GET['delid'];
 			$delBrand = $brand->deleteBrand($id);
        }
       
    ?>



<div class="grid_10">
    <div class="box round first grid">
        <h2>Brand List</h2>

         <?php
                if(isset($delBrand)){
                    echo $delBrand;
                }
            ?>
        <div class="block">        
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Brand Name</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>

			<?php
			    $brand = new Brand();
			    $getBrand = $brand->brandSelect();
			    if($getBrand){
			    	$i = 0;
			    	while($result = $getBrand->fetch_assoc()){
			    		$i++;
			?>


				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['brandName']; ?></td>

					<td><a href="brandedit.php?brandid=<?php echo $result['brandId']?>">Edit</a>
					|| <a onclick="return confirm('Are you sure to Delete'); " href="?delid=<?php echo $result['brandId']?>">Delete</a></td>
				</tr>
				
				<?php } } ?>
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

