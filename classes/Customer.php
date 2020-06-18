<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath."/../lib/Database.php");
	include_once ($filepath."/../helpers/Format.php");
?>

<?php
class Customer{
	private $db;
	private $fm;
	
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();

	}

	public function customerRegistration($data){
        $name 		= mysqli_real_escape_string($this->db->link, $data['name']);
        $address    = mysqli_real_escape_string($this->db->link, $data['address']);
        $city    	= mysqli_real_escape_string($this->db->link, $data['city']);
        $country 	= mysqli_real_escape_string($this->db->link, $data['country']);
        $zipcode 	= mysqli_real_escape_string($this->db->link, $data['zipcode']);
        $phone 		= mysqli_real_escape_string($this->db->link, $data['phone']);
        $email 		= mysqli_real_escape_string($this->db->link, $data['email']);
        $password 	= mysqli_real_escape_string($this->db->link, md5($data['password']));

        if($name == "" || $address == "" || $address == "" || $country == "" || $zipcode == "" || $phone == "" || $email == "" || $password == ""){
                $msg = "<span style='color:red; font-size: 18px; '>Field must not be empty..!</span>";
                return $msg;
            }

                $mailquery = "SELECT *from tbl_customer where email='$email'";
                $checkmail = $this->db->select($mailquery);
                if($checkmail){
                        $msg = "<span style='color:red; font-size: 18px; '>Email already exists..!</span>";
                        return $msg;
                }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                        $msg = "<span style='color:red; font-size: 18px; '>Invalid Email Address..!</span>";
                        return $msg;
                }else{
                        $query = "INSERT INTO tbl_customer(name, address, city, country, zipcode, phone, email, password) VALUES('$name', '$address', '$city', '$country', '$zipcode', '$phone', '$email', '$password')";

                    $inserted_rows = $this->db->insert($query);
                    if ($inserted_rows) {
                        $msg = "<span style='color: green; font-size: 18px; '>Data inserted successfully!</span>";
                        return $msg;
                    }else {
                        $msg = '<span style="color:red; font-size: 18px; ">Data not inserted!</span>';
                        return $msg;
                    }
            }


	}

        public function customerLogin($data){
               $email = mysqli_real_escape_string($this->db->link, $data['email']);
               $pass  = mysqli_real_escape_string($this->db->link, md5($data['pass']));

                $checkEmail = $this->emailCheck($email);

                if ($email == "" OR $pass == "") {
                        $msg = '<span style="color:red; font-size: 18px; ">Field must not be empty..!</span>';
                        return $msg;
                }elseif(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                        $msg = '<span style="color:red; font-size: 18px; ">Invalid Email!</span>';
                        return $msg;
                }elseif($checkEmail == false) {
                        $msg = '<span style="color:red; font-size: 18px; ">Email Address not exists!</span>';
                        return $msg;
                }else{
                        $value = $this->getLoginCustomer($email, $pass);
                        if ($value) {
                                $result = $value->fetch_assoc();
                                Session::set("cmrLogin", true);
                                Session::set("cmrId", $result['id']);
                                Session::set("cmrName", $result['name']);
                                header("Location: order.php");
                        }else{
                                $msg = '<span style="color:red; font-size: 18px; ">Email or password not matched!</span>';
                                return $msg;     
                        }

                }
        }

        public function emailCheck($email){
                $query = "SELECT *from tbl_customer where email='$email'";
                $result = $this->db->select($query);
                return $result;
        }
        public function getLoginCustomer($email, $pass){
                $query = "SELECT * FROM tbl_customer WHERE email = '".$email."' AND password = '".$pass."' LIMIT 1";
                $result = $this->db->select($query);
                return $result;
        }

        public function getCustomerProfile($id){
            $query = "SELECT *from tbl_customer where id='$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function cmrProfileUpdate($data, $cmrId){
            $name       = mysqli_real_escape_string($this->db->link, $data['name']);
            $address    = mysqli_real_escape_string($this->db->link, $data['address']);
            $city       = mysqli_real_escape_string($this->db->link, $data['city']);
            $country    = mysqli_real_escape_string($this->db->link, $data['country']);
            $zipcode    = mysqli_real_escape_string($this->db->link, $data['zipcode']);
            $phone      = mysqli_real_escape_string($this->db->link, $data['phone']);
            $email      = mysqli_real_escape_string($this->db->link, $data['email']);

            if($name == "" || $address == "" || $address == "" || $country == "" || $zipcode == "" || $phone == "" || $email == ""){
                    $msg = "<span style='color:red; font-size: 18px; '>Field must not be empty..!</span>";
                    return $msg;
            }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $msg = "<span style='color:red; font-size: 18px; '>Invalid Email Address..!</span>";
                            return $msg;
            }else{
                    $query = "UPDATE tbl_customer SET 
                    name='$name', 
                    address='$address', 
                    city='$city', 
                    country='$country', 
                    zipcode='$zipcode', 
                    phone='$phone', 
                    email='$email' WHERE id='$cmrId'";

                $updated_rows = $this->db->update($query);
                if ($updated_rows) {
                    $msg = "<span style='color: green; font-size: 18px; '> Customer Data Updated Successfully!</span>";
                    return $msg;
                }else {
                    $msg = '<span style="color:red; font-size: 18px; ">Customer Details not updated!</span>';
                    return $msg;
                }
            }

        }


        public function orderInsert($cmrId){
            $sId = session_id();
            $query  = "SELECT *from tbl_cart where sId = '$sId'";
            $getPro = $this->db->select($query);

            if($getPro){
                while ($result = $getPro->fetch_assoc()) {
                    
                    $productId = $result['productId'];
                    $productName = $result['productName'];
                    $quantity = $result['quantity'];
                    $price = $result['price'];
                    $image = $result['image'];

                $insertQuery = "INSERT INTO tbl_order(cmrId, productId, productName, price, quantity, image) VALUES('$cmrId', '$productId', '$productName', '$price', '$quantity', '$image')";

                $inserted_rows = $this->db->insert($insertQuery);

                }
            }

        }

        public function getProductOrder($cmrId){
            $query = "SELECT *from tbl_order WHERE cmrId='$cmrId' ORDER BY date DESC";
            $result = $this->db->select($query);
            return $result;
        }

        public function OrderDelete($orderId){
            $query = "DELETE from tbl_order WHERE id='$orderId'";
            $result = $this->db->delete($query);
            if($result){
                header("Location: orderdetails.php");
            }
        }

        public function getOrderAll(){
            $query = "SELECT *from tbl_order WHERE status='0' ORDER BY date DESC";
            $result = $this->db->select($query);
            return $result;
        }


        public function ProOrderShifted($cmrId, $price, $date){
            $cmrId = mysqli_real_escape_string($this->db->link, $cmrId);
            $price = mysqli_real_escape_string($this->db->link, $price);
            $date  = mysqli_real_escape_string($this->db->link, $date);
            $query = "UPDATE tbl_order SET status='1' WHERE cmrId='$cmrId' AND price='$price' AND date='$date'";
            $updated_rows = $this->db->update($query);
            if ($updated_rows) {
                    echo "<script>window.location = 'customerorder.php'; </script>";
                }else {
                    $msg = '<span style="color:red; font-size: 18px; ">Order not Shifted!</span>';
                    return $msg;
                }
        }
        public function shiftConfirmByCmr($cmrId, $price, $date){
            $cmrId = mysqli_real_escape_string($this->db->link, $cmrId);
            $price = mysqli_real_escape_string($this->db->link, $price);
            $date  = mysqli_real_escape_string($this->db->link, $date);
            $query = "UPDATE tbl_order SET status='2' WHERE cmrId='$cmrId' AND price='$price' AND date='$date'";
            $updated_rows = $this->db->update($query);
            // if ($updated_rows) {
            //         echo "<script>window.location = 'customerorder.php'; </script>";
            //     }else {
            //         $msg = '<span style="color:red; font-size: 18px; ">Order not Shifted!</span>';
            //         return $msg;
            //     }
        }


        public function ProOrderUnshifted($cmrId, $price, $date){
            $cmrId = mysqli_real_escape_string($this->db->link, $cmrId);
            $price = mysqli_real_escape_string($this->db->link, $price);
            $date  = mysqli_real_escape_string($this->db->link, $date);
            $query = "UPDATE tbl_order SET status='0' WHERE cmrId='$cmrId' AND price='$price' AND date='$date'";
            $updated_rows = $this->db->update($query);
            if ($updated_rows) {
                    echo "<script>window.location = 'customerorder.php'; </script>";
                }else {
                    $msg = '<span style="color:red; font-size: 18px; ">Order not Unshifted!</span>';
                    return $msg;
                }
        }


        public function getShiftedPro(){
            $query = "SELECT *from tbl_order WHERE status in ('1', '2') ORDER BY date DESC";
            $result = $this->db->select($query);
            return $result;
        }


        public function shiftedOrderDelete($orderId){
            $query = "DELETE from tbl_order WHERE id='$orderId'";
            $deleted_rows = $this->db->delete($query);
            if ($deleted_rows) {
                    $msg = '<span style="color:red; font-size: 18px; ">Shifted Product Deleted Succesfully!</span>';
                    return $msg;
                }else {
                    $msg = '<span style="color:red; font-size: 18px; ">Not Deleted....!</span>';
                    return $msg;
                }
        }


}