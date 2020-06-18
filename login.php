
<?php
	include 'inc/header.php';
 ?>

 <div class="main">
    <div class="content">

   	<?php
		if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
			$loginChk = $cmr->customerLogin($_POST);
		}
	?>
    	<div class="login_panel">
        	<h3>Existing Customers</h3>
        	<?php
        		if(isset($loginChk)){
        			echo "$loginChk";
        		}
        	?>
        	<form action="" method="post" >
                <input name="email" type="text" placeholder="Username" >
                <input name="pass" type="password" placeholder="Password">
                <div class="buttons">
                	<div><button class="grey" name="login">Sign In</button></div>
            	</div>
            </form>
        </div>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])){
        $addCustomer = $cmr->customerRegistration($_POST);
    }
?>
    	<div class="register_account">
    		<h3>Register New Account</h3>
    		<?php
    			if(isset($addCustomer)){
    				echo "$addCustomer";
    			}?>
    		<form action="" method="post">
		   		<table>
		   			<tbody>
						<tr>
							<td>
								<div>
									<input type="text" name="name" placeholder="Name" >
								</div>
								<div>
									<input type="text" name="address" placeholder="Address" >
								</div>
								<div>
								   <input type="text" name="city" placeholder="City" >
								</div>
								<div>
									<input type="text" name="country" placeholder="Country" >
						 		</div>		
			    			</td>
				    		<td>
								<div>
									<input type="text" name="zipcode" placeholder="Zip-Code" >
								</div>
									<div>
					          		<input type="text" name="phone" placeholder="Phone">
					          	</div>
								<div>
									<input type="text" name="email" placeholder="E-mail" >
								</div>
								<div>
									<input type="password" name="password" placeholder="Password" >
								</div>
				    		</td>
		    			</tr> 
		    		</tbody>
				</table> 
			   	<div class="search">
			   		<div><button class="grey" name="register">Create Account</button></div>
			   	</div>
		    
		    	<div class="clear"></div>
		    </form>
    	</div>  	
       	<div class="clear"></div>
    </div>
 </div>

 <?php
	include 'inc/footer.php';
 ?>
