<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
    include "../classes/Category.php";
?>

<?php
		$cat = new Category();

        if(isset($_GET['delid'])){
          
            $id = $_GET['delid'];
 			$delCat = $cat->deleteCat($id);

        }
       
    ?>



<div class="grid_10">
    <div class="box round first grid">
        <h2>Category List</h2>

         <?php
                if(isset($delCat)){
                    echo $delCat;
                }
            ?>
        <div class="block">        
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Category Name</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>

			<?php
			    $cat = new Category();
			    $getCat = $cat->catSelect();
			    if($getCat){
			    	$i = 0;
			    	while($result = $getCat->fetch_assoc()){
			    		$i++;
			?>


				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['catName']; ?></td>

					<td><a href="catedit.php?catid=<?php echo $result['catId']?>">Edit</a>
					|| <a onclick="return confirm('Are you sure to Delete'); " href="?delid=<?php echo $result['catId']?>">Delete</a></td>
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

