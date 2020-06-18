<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath."/../lib/Database.php");
	
?>

<?php
class Control{
	private $db;

	
	public function __construct(){
		$this->db = new Database();
	
	}
	 public function getShiftedPro(){
            $query = "SELECT *from tbl_order WHERE status='0' ORDER BY id DESC";
            $result = $this->db->select($query);
            return $result;
        }



}