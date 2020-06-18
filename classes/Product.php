<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath."/../lib/Database.php");
	include_once ($filepath."/../helpers/Format.php");
?>

<?php
class Product{
	private $db;
	private $fm;
	
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function productInsert($data, $file){
		$productName    = $this->fm->validation($_POST['productName']);
        $catId          = $this->fm->validation($_POST['catId']);
        $brandId        = $this->fm->validation($_POST['brandId']);
        $body           = $_POST['body'];
        $price          = $this->fm->validation($_POST['price']);
        $type           = $this->fm->validation($_POST['type']);
        $productName 	= mysqli_real_escape_string($this->db->link, $productName);
        $catId 			= mysqli_real_escape_string($this->db->link, $catId);
        $brandId 		= mysqli_real_escape_string($this->db->link, $brandId);
        $body 			= mysqli_real_escape_string($this->db->link, $body);
        $price 			= mysqli_real_escape_string($this->db->link, $price);
        $type 			= mysqli_real_escape_string($this->db->link, $type);
       

			$permited  = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "upload/".$unique_image;

            if($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $file_name == "" || $type == ""){
                $msg = "<span class='error'>Field must not be empty!</span>";
				return $msg;

            }elseif ($file_size >1048567) {
                echo "<span class='error'>Image Size should be less then 1MB! </span>";

            } elseif (in_array($file_ext, $permited) === false) {
                echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
            } else{

                move_uploaded_file($file_temp, $uploaded_image);

               	$query = "INSERT INTO tbl_product(productName, catId, brandId, body, price, image, type) VALUES('$productName', '$catId', '$brandId', '$body', '$price', '$uploaded_image', '$type')";

            $inserted_rows = $this->db->insert($query);
            if ($inserted_rows) {
                $msg = "<span class='success'>Data inserted successfully!</span>";
				return $msg;
            }else {
                $msg = '<span class="error">Data not inserted!</span>';
				return $msg;
            }
    }
	}


	public function getAllProduct(){

		$query = "SELECT p.*, c.catName, b.brandName 
		FROM tbl_product as p, tbl_category as c, tbl_brand as b 
		WHERE p.catId = c.catId AND p.brandId = b.brandId ORDER BY p.productId desc";


		/* $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName from tbl_product
		INNER JOIN tbl_category
		ON tbl_product.catId = tbl_category.catId
		INNER JOIN tbl_brand
		ON tbl_product.brandId = tbl_brand.brandId
		order by tbl_product.productId desc";*/

		$productlist = $this->db->select($query);
		return $productlist;

	 }

		public function productUpdate($data, $file, $id){
		$productName    = $this->fm->validation($_POST['productName']);
        $catId          = $this->fm->validation($_POST['catId']);
        $brandId        = $this->fm->validation($_POST['brandId']);
        $body           = $_POST['body'];
        $price          = $this->fm->validation($_POST['price']);
        $type           = $this->fm->validation($_POST['type']);
        $productName 	= mysqli_real_escape_string($this->db->link, $productName);
        $catId 			= mysqli_real_escape_string($this->db->link, $catId);
        $brandId 		= mysqli_real_escape_string($this->db->link, $brandId);
        $body 			= mysqli_real_escape_string($this->db->link, $body);
        $price 			= mysqli_real_escape_string($this->db->link, $price);
        $type 			= mysqli_real_escape_string($this->db->link, $type);
       

			$permited  = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "upload/".$unique_image;

            if($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $type == ""){
                $msg = "<span class='error'>Field must not be empty!</span>";
				return $msg;

         }else{
            if (!empty($file_name)){	
	            if ($file_size >1048567) {
	                echo "<span class='error'>Image Size should be less then 1MB! </span>";

	            } elseif (in_array($file_ext, $permited) === false) {
	                echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
	            } else{

	                move_uploaded_file($file_temp, $uploaded_image);

	               	$query = "UPDATE tbl_product
	               	SET 
	               	productName = '$productName', 
	               	catId 		= '$catId', 
	               	brandId 	= '$brandId', 
	               	body 		= '$body', 
	               	price 		= '$price', 
	               	image 		= '$uploaded_image', 
	               	type 		= '$type'
	               	WHERE productId = '$id'";

	            $updated_rows = $this->db->update($query);
	            if ($updated_rows) {
	                $msg = "<span class='success'>Data Updated successfully!</span>";
					return $msg;
	            }else {
	                $msg = '<span class="error">Data not Updated!</span>';
					return $msg;
	            }
	    	}

		}else{
      			$query = "UPDATE tbl_product
	               	SET 
	               	productName = '$productName', 
	               	catId 		= '$catId', 
	               	brandId 	= '$brandId', 
	               	body 		= '$body', 
	               	price 		= '$price', 
	               	
	               	type 		= '$type'
	               	WHERE productId = '$id'";

	            $updated_rows = $this->db->update($query);
	            if ($updated_rows) {
	                $msg = "<span class='success'>Data Updated successfully!</span>";
					return $msg;
	            }else {
	                $msg = '<span class="error">Data not Updated!</span>';
					return $msg;
	            }

		}
	}
}

		public function getProductById($id){
		$query = "SELECT* from tbl_product WHERE productId = '$id'";
			
		$getbrand = $this->db->select($query);
		return $getbrand;

		}


		public function deleteProduct($id){
			$query = "SELECT *from tbl_product where productId = '$id'";
			$getData = $this->db->select($query);
			if($getData){
				while ($delImg = $getData->fetch_assoc()) {
					$dellink = $delImg['image'];
					unlink($dellink);
				}
			}

			$delquery = "DELETE from tbl_product where productId = '$id'";
			$delpd = $this->db->delete($delquery);
			if($delpd != false){
				$msg = "<span class='success'>Product Deleted successfully!</span>";
				return $msg;
			}else{
				$msg = '<span class="error">Product not Deleted!</span>';
				return $msg;
			}
		}



		public function getProductFeature(){
			$query = "SELECT *from tbl_product WHERE type='0' ORDER BY productId DESC LIMIT 4";
			$result = $this->db->select($query);
			return $result;
		}
		
		public function getNewProduct(){
			$query = "SELECT *from tbl_product ORDER BY productId DESC LIMIT 4";
			$result = $this->db->select($query);
			return $result;
		}


		public function getSingleProduct($id){
		$query = "SELECT*, c.catName, b.brandName 
		FROM tbl_product as p, tbl_category as c, tbl_brand as b 
		WHERE p.catId = c.catId AND p.brandId = b.brandId AND p.productId = '$id'";
		$getbrand = $this->db->select($query);
		return $getbrand;
		}


		public function getSingleIphone(){
		$query = "SELECT*, b.brandName FROM tbl_product as p, tbl_brand as b 
		WHERE p.brandId = b.brandId AND b.brandName='IPHONE' LIMIT 1";
		$getbrand = $this->db->select($query);
		return $getbrand;
		}
		public function getSingleSamsung(){
		$query = "SELECT*, b.brandName FROM tbl_product as p, tbl_brand as b 
		WHERE p.brandId = b.brandId AND b.brandName='SAMSUNG' LIMIT 1";
		$getbrand = $this->db->select($query);
		return $getbrand;
		}
		public function getSingleAcer(){
		$query = "SELECT*, b.brandName FROM tbl_product as p, tbl_brand as b 
		WHERE p.brandId = b.brandId AND b.brandName='ACER' LIMIT 1";
		$getbrand = $this->db->select($query);
		return $getbrand;
		}
		public function getSingleCanon(){
		$query = "SELECT*, b.brandName FROM tbl_product as p, tbl_brand as b 
		WHERE p.brandId = b.brandId AND b.brandName='CANON' LIMIT 1";
		$getbrand = $this->db->select($query);
		return $getbrand;
		}
	


		public function getAllIphone(){
		$query = "SELECT*, b.brandName FROM tbl_product as p, tbl_brand as b 
		WHERE p.brandId = b.brandId AND b.brandName='IPHONE' ORDER BY b.brandId DESC LIMIT 4";
		$getbrand = $this->db->select($query);
		return $getbrand;
		}
		public function getAllAcer(){
		$query = "SELECT*, b.brandName FROM tbl_product as p, tbl_brand as b 
		WHERE p.brandId = b.brandId AND b.brandName='ACER' ORDER BY b.brandId DESC LIMIT 4";
		$getbrand = $this->db->select($query);
		return $getbrand;
		}
		public function getAllSamsung(){
		$query = "SELECT*, b.brandName FROM tbl_product as p, tbl_brand as b 
		WHERE p.brandId = b.brandId AND b.brandName='SAMSUNG' ORDER BY b.brandId DESC LIMIT 4";
		$getbrand = $this->db->select($query);
		return $getbrand;
		}
		public function getAllCanon(){
		$query = "SELECT*, b.brandName FROM tbl_product as p, tbl_brand as b 
		WHERE p.brandId = b.brandId AND b.brandName='CANON' ORDER BY b.brandId DESC LIMIT 4";
		$getbrand = $this->db->select($query);
		return $getbrand;
		}

		public function getProductByCatId($id){
		$query = "SELECT*, c.catName from tbl_product as p, tbl_category as c WHERE p.catId='$id' and p.catId=c.catId ORDER BY productId DESC";
		$getproduct = $this->db->select($query);
		return $getproduct;
		}

		public function deleteCompareList($cmrId){
			$query = "DELETE from tbl_compare where cmrId='$cmrId'";
			$delcompare = $this->db->delete($query);
		}

		public function insertToCompare($cmrId, $proId){
			$cmrId 		= mysqli_real_escape_string($this->db->link, $cmrId);
        	$productId 	= mysqli_real_escape_string($this->db->link, $proId);

        	$cquery = "SELECT *from tbl_product where productId='$productId'";
        	$result = $this->db->select($cquery)->fetch_assoc();
        	if($result){
        	$productName = $result['productName'];
			$price 		= $result['price'];
			$image 		= $result['image'];

			$chkquery = "SELECT *from tbl_compare WHERE productId='$productId' AND cmrId='$cmrId'";
			$getPro = $this->db->select($chkquery);

			if($getPro){
				$msg = '<span style="color:red; font-size: 18px; ">Already Added! Check compare list</span>';
                return $msg;
			}else{
            	$query = "INSERT INTO tbl_compare(cmrId, productId, productName, price, image) VALUES('$cmrId', '$productId', '$productName', '$price', '$image')";

                $inserted_rows = $this->db->insert($query);

                if ($inserted_rows) {
                    header("Location: compare.php");
                }else {
                    $msg = '<span style="color:red; font-size: 18px; ">Not Added!</span>';
                    return $msg;
                }

            }
        }

		}

		public function getCompareProduct($cmrId){
			$query="SELECT *from tbl_compare where cmrId='$cmrId' ORDER BY id DESC";
			$result = $this->db->select($query);
			return $result;
		}





}
?>