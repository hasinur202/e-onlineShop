<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath."/../lib/Database.php");
	include_once ($filepath."/../helpers/Format.php");
?>

<?php
class Cart{
	private $db;
	private $fm;
	
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function addToCart($quantity, $id){
		$quantity = $this->fm->validation($quantity);
		$quantity 	= mysqli_real_escape_string($this->db->link, $quantity);
		$productId 	= mysqli_real_escape_string($this->db->link, $id);

		$sId = session_id();

		$query 	= "SELECT *from tbl_product where productId = '$productId'";
		$result = $this->db->select($query)->fetch_assoc();

		$productName = $result['productName'];
		$price 		= $result['price'];
		$image 		= $result['image'];

		$chkquery = "SELECT *from tbl_cart WHERE productId='$productId' AND sId='$sId'";
		$getPro = $this->db->select($chkquery);
		if($getPro){
			$msg = "Product Already Added! Check chartlist";
			return $msg;
		}else{
			$inquery = "INSERT INTO tbl_cart(sId, productId, productName, price, quantity, image) 
						VALUES('$sId', '$productId', '$productName', '$price', '$quantity', '$image')";

            $inserted_rows = $this->db->insert($inquery);
            if ($inserted_rows) {
                header("Location: cart.php");
            }else {
               header("Location: 404.php");
            }
		}
	}

	public function getProductCart(){
		$sId = session_id();
		$query = "SELECT *from tbl_cart WHERE sId = '$sId'";
		$result = $this->db->select($query);
		return $result; 
	}

	public function updateQuantity($quantity, $id){
		$quantity = $this->fm->validation($quantity);
		$quantity 	= mysqli_real_escape_string($this->db->link, $quantity);
		$cartId 	= mysqli_real_escape_string($this->db->link, $id);
		
		$query = "UPDATE tbl_cart SET quantity = '$quantity' where cartId = '$cartId'";
		$updated_rows = $this->db->update($query);
	            if ($updated_rows) {
	                header("Location: cart.php");
	            }else {
	                $msg = '<span style="color: red; font-size: 20px;">Data not Updated!</span>';
					return $msg;
	            }
	}


		public function CartDeleteById($id){
			
			$query = "DELETE from tbl_cart WHERE cartId='$id'";
			$deleted_rows = $this->db->delete($query);
	            if ($deleted_rows) {
	                echo "<script>window.location = 'cart.php';</script>";
	            }else {
	                $msg = '<span style="color: red; font-size: 20px;">Cart not Updated!</span>';
					return $msg;
	            } 
		}

		public function checkCartTable(){
			$sId = session_id();

			$query 	= "SELECT *from tbl_cart where sId='$sId'";
			$result = $this->db->select($query);
			return $result;
		}

		public function deleteSessionCart(){
			$sId = session_id();
			$query = "DELETE from tbl_cart WHERE sId = '$sId'";
			$result = $this->db->delete($query);
			
		}

		public function payableAmount($cmrId){
			$query = "SELECT price, quantity from tbl_order where cmrId='$cmrId' and date=now()";
			$result = $this->db->select($query);
			return $result;
		}

		public function checkOrder($cmrId){
            $query = "SELECT *from tbl_order WHERE cmrId='$cmrId' ORDER BY productId DESC";
            $result = $this->db->select($query);
            return $result;
        }


        public function getOrderAll(){
        	$query = "SELECT *from tbl_order ORDER BY date";
        	$result = $this->db->select($query);
            return $result;
        }


		public function checkCompareTable($cmrId){
			$query 	= "SELECT *from tbl_compare where cmrId='$cmrId'";
			$result = $this->db->select($query);
			return $result;
		}



}