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

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        echo "<script>window.location = 'customerorder.php'; </script>";
    }
?>

<?php
 		if(!isset($_GET['custId']) || $_GET['custId'] == NULL){
 			echo "<script>window.location = 'customerorder.php'; </script>";
 		}else{
 			$id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['custId']);
 			$custView = $cmr->getCustomerProfile($id);
 		}
 ?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Customer Profile</h2>
        <div class="block copyblock"> 
            <form action="" method="post">
                <?php
                    if($custView){
                    	while($result = $custView->fetch_assoc()){
                             
                ?>

                <table class="form">					
                    <tr>
                        <td>
                            <input type="text" readonly="readonly" name="name" value="<?php echo $result['name']; ?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" readonly="readonly" name="address" value="<?php echo $result['address']; ?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" readonly="readonly" name="city" value="<?php echo $result['city']; ?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" readonly="readonly" name="country" value="<?php echo $result['country']; ?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" readonly="readonly" name="zipcode" value="<?php echo $result['zipcode']; ?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" readonly="readonly" name="phone" value="<?php echo $result['phone']; ?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" readonly="readonly" name="email" value="<?php echo $result['email']; ?>" class="medium" />
                        </td>
                    </tr>
    				<tr> 
                        <td>
                            <input type="submit" name="submit" Value="OK" />
                        </td>
                    </tr>
                </table>
        <?php } } ?>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>
