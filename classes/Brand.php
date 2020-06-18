<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath."/../lib/Database.php");
	include_once ($filepath."/../helpers/Format.php");
?>

<?php
class Brand{
	private $db;
	private $fm;
	
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function brandInsert($brandName){
		$brandName = $this->fm->validation($brandName);
		$brandName = mysqli_real_escape_string($this->db->link, $brandName);

		if(empty($brandName)){
			$msg = "<span class='error'>Field must not be empty!</span>";
			return $msg;
		}else{
			$query = "INSERT into tbl_brand(brandName) values ('$brandName')";
			$result = $this->db->insert($query);
			if($result != false){
				$msg = "<span class='success'>Brand added successfully!</span>";
				return $msg;
			}else{
				$msg = '<span class="error">Brand not added!</span>';
				return $msg;
			}
		}
	}


	public function brandSelect(){
		$query = "SELECT *from tbl_brand order by brandId desc";
		$brandlist = $this->db->select($query);
		return $brandlist;

	}

	public function brandUpdate($id, $brandName){
		$brandName = $this->fm->validation($brandName);
		$brandName = mysqli_real_escape_string($this->db->link, $brandName);
		$id = mysqli_real_escape_string($this->db->link, $id);

		if(empty($brandName)){
			$msg = "<span class='error'>Field must not be empty!</span>";
			return $msg;
		}else{

		$query = "UPDATE tbl_brand SET brandName = '$brandName' where brandId = '$id'";
		$result = $this->db->update($query);
		if($result != false){
				$msg = "<span class='success'>Brand updated successfully!</span>";
				return $msg;
			}else{
				$msg = '<span class="error">Brand not updated!</span>';
				return $msg;
			}
		}
	}


	public function getBrandById($id){
		$query = "SELECT *from tbl_brand where brandId = '$id'";
		$getbrand = $this->db->select($query);
		return $getbrand;

	}


	public function deleteBrand($id){
		$query = "DELETE from tbl_brand where brandId = '$id'";
		$delbrand = $this->db->delete($query);
		if($delbrand != false){
				$msg = "<span class='success'>Brand Deleted successfully!</span>";
				return $msg;
			}else{
				$msg = '<span class="error">Brand not Deleted!</span>';
				return $msg;
			}
	}



}
?>