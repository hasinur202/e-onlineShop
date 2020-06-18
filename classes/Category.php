<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath."/../lib/Database.php");
	include_once ($filepath."/../helpers/Format.php");
?>

<?php
class Category{
	private $db;
	private $fm;
	
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function catInsert($catName){
		$catName = $this->fm->validation($catName);
		$catName = mysqli_real_escape_string($this->db->link, $catName);

		if(empty($catName)){
			$msg = "<span class='error'>Field must not be empty!</span>";
			return $msg;
		}else{
			$query = "INSERT into tbl_category(catName) values ('$catName')";
			$result = $this->db->insert($query);
			if($result != false){
				$msg = "<span class='success'>Category added successfully!</span>";
				return $msg;
			}else{
				$msg = '<span class="error">Category not added!</span>';
				return $msg;
			}
		}
	}


	public function catSelect(){
		$queryCat = "SELECT *from tbl_category order by catId desc";
		$catlist = $this->db->select($queryCat);
		return $catlist;

	}

	public function catUpdate($id, $catName){
		$catName = $this->fm->validation($catName);
		$catName = mysqli_real_escape_string($this->db->link, $catName);
		$id = mysqli_real_escape_string($this->db->link, $id);

		if(empty($catName)){
			$msg = "<span class='error'>Field must not be empty!</span>";
			return $msg;
		}else{

		$query = "UPDATE tbl_category SET catName = '$catName' where catId = '$id'";
		$result = $this->db->update($query);
		if($result != false){
				$msg = "<span class='success'>Category updated successfully!</span>";
				return $msg;
			}else{
				$msg = '<span class="error">Category not updated!</span>';
				return $msg;
			}
		}
	}


	public function getCatById($id){
		$query = "SELECT *from tbl_category where catId = '$id'";
		$getcat = $this->db->select($query);
		return $getcat;

	}


	public function deleteCat($id){
		$query = "DELETE from tbl_category where catId = '$id'";
		$delcat = $this->db->delete($query);
		if($delcat != false){
				$msg = "<span class='success'>Category Deleted successfully!</span>";
				return $msg;
			}else{
				$msg = '<span class="error">Category not Deleted!</span>';
				return $msg;
			}
	}










}
?>