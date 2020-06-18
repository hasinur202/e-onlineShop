<?php 
	include 'inc/header.php';
	include 'inc/sidebar.php';
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath."/../classes/Customer.php");
?>

<?php
	$cmr = new Customer();
	$fm = new Format();
?>

<?php
 		if(isset($_GET['shiftId'])){
 			$cmrId = $_GET['shiftId'];
 			$price = $_GET['price'];
 			$date = $_GET['date'];
 			$shiftOrder = $cmr->ProOrderShifted($cmrId, $price, $date);
 		}
 ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Order List</h2>
                <div class="block"> 
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>SL</th>
							<th>Order Time</th>
							<th>Product</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Cust. ID</th>
							<th>Address</th>
							<th>Action</th>
							
						</tr>
					</thead>
					<tbody>
					<?php
                		$getOrder = $cmr->getOrderAll();
                		
                		if($getOrder){
                			$i=0;
                			while ($result = $getOrder->fetch_assoc()) {
                				$i++;
                	?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $fm->formateDate($result['date']);?></td>
							<td><?php echo $result['productName']; ?></td>
							<td><?php echo $result['quantity']; ?></td>
							<td><?php echo $result['price']; ?></td>
							<td><?php echo $result['cmrId']; ?></td>
							<td>
								<a href="customer.php?custId=<?php echo $result['cmrId'];?>">View Details</a>
							</td>
							<td>				
								<a href="?shiftId=<?php echo $result['cmrId'];?>&price=<?php echo $result['price'];?>&date=<?php echo $result['date'];?>">Shifted</a> 
							</td>
						</tr>
						<?php }} ?>
					</tbody>
				</table>
               </div>
            </div>


<?php
 		if(isset($_GET['orderId'])){
 			
 			$id = $_GET['orderId'];
 			$delOrd = $cmr->shiftedOrderDelete($id);
 		}
 ?>


<?php
 		if(isset($_GET['shiftId'])){
 			$cmrId = $_GET['shiftId'];
 			$price = $_GET['price'];
 			$date = $_GET['date'];
 			$shiftOrder = $cmr->ProOrderUnshifted($cmrId, $price, $date);
 		}
 ?>

	<div class="box round first grid">
                <h2>Order List</h2>
                <?php
                	if(isset($delOrd)){
                		echo "$delOrd";
                	}
                ?>
                <div class="block"> 
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>SL</th>
							<th>Order Time</th>
							<th>Product</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Cust. ID</th>
							<th>Address</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
                		$shiftedPro = $cmr->getShiftedPro();
                		if($shiftedPro){
                			$i=0;
                			while ($result = $shiftedPro->fetch_assoc()) {
                				$i++;
                	?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $fm->formateDate($result['date']);?></td>
							<td><?php echo $result['productName']; ?></td>
							<td><?php echo $result['quantity']; ?></td>
							<td><?php echo $result['price']; ?></td>
							<td><?php echo $result['cmrId']; ?></td>
							<td>
								<a href="customer.php?custId=<?php echo $result['cmrId'];?>">View Details</a>
							</td>
							<td>
							<?php 
									if($result['status'] == 1){ ?>
								Pending || <a href="?shiftId=<?php echo $result['cmrId'];?>&price=<?php echo $result['price'];?>&date=<?php echo $result['date'];?>">Unshifted</a>
							<?php }else{ ?>
								<a onclick="return confirm('Are you sure to Remove')" href="?orderId=<?php echo $result['id'];?>">Remove</a>
							<?php } ?>
								
							</td>
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
