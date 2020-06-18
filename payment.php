
<?php
	include 'inc/header.php';
 ?>

<style>
    .payment{width: 550px; text-align: center; min-height: 200px; border: 1px solid #ddd; margin: 0 auto; padding: 50px; }
    .back a { width: 160px; text-align: center; border: 1px solid #ddd; margin: 5px auto; padding: 10px;   display: block; font-size: 18px; font-weight: bold; color: #fff; background: #3286C7; border-radius: 11px;
    }
    .back a:hover {color: #FF9800; background: #454545; }
    .payment h2 { margin-bottom: 70px; border-bottom: 3px solid #008000; }
    .payment a { font-size: 18px; padding: 10px 30px 10px 30px; background: green; border: 1px solid #ddd;   font-weight: bold; color: #FDFFDF; margin-inline: 5px;
    }
     .payment a:hover{color: #474747; background: #FBF2A9;}
</style>




    <?php
        if(isset($_GET['action']) && $_GET['action'] == "LogOffline"){
            $login = Session::get('cmrLogin');
            if($login == true){
                header("Location: paymentoffline.php");
            }else{
                header("Location: login.php");
            }
        }
    ?>

    <?php
        if(isset($_GET['action']) && $_GET['action'] == "LogOnline"){
            $login = Session::get('cmrLogin');
            if($login == true){
                header("Location: paymentonline.php");
            }else{
                header("Location: login.php");
            }
        }
    ?>



 <div class="main">
    <div class="content">
    	<div class="section group">

    	<div class="payment">
            <h2>Choose Payment Option</h2>

            <a href="?action=LogOffline">Offline Payment</a>
            <a href="?action=LogOnline">Online Payment</a>

        </div>
        <div class="back">
            <a href="cart.php">Previous</a>

        </div>
				
 		</div>
 	</div>
	</div>


<?php
	include 'inc/footer.php';
 ?>
