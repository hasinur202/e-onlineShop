<?php 
        include 'inc/header.php';
        include 'inc/sidebar.php';
        include "../classes/Brand.php";
        include "../classes/Category.php";
        include "../classes/Product.php";
?>


 <?php
        if(!isset($_GET['pdId']) || $_GET['pdId'] == NULL){
            echo "<script>window.location = 'productlist.php'; </script>";
            //header("Loation: catlist.php");
        }else{
            $id = $_GET['pdId'];
        }
    ?>

<?php
    $product = new Product();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $updatePd = $product->productUpdate($_POST, $_FILES, $id);
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Product</h2>

            <?php
                if(isset($updatePd)){
                    echo $updatePd;
                }
            ?>

        <div class="block">               
         <form action="" method="post" enctype="multipart/form-data">

            <?php
                $pd = new Product();
                $getProduct = $pd->getProductById($id);
                if($getProduct){
                    while ($result = $getProduct->fetch_assoc()) {
            ?>

            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="productName" value="<?php echo $result['productName'];?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="catId">
                               <?php 
                                    $cat = new Category();
                                    $getCat = $cat->catSelect();
                                    if($getCat){
                                        while ($Catresult = $getCat->fetch_assoc()) {
                                ?> 
                            <option
                                <?php 
                                    if($Catresult['catId'] == $result['catId']){ ?>
                                        selected = "selected"
                                    <?php } ?>
                                value="<?php echo $Catresult['catId']; ?>"><?php echo $Catresult['catName']?> 
                            </option>
                        <?php }} ?>
                           
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brandId">
                            
                            <?php 
                                    $brand = new Brand();
                                    $getBrand = $brand->brandSelect();
                                    if($getBrand){
                                        while ($Bresult = $getBrand->fetch_assoc()) {
                                ?> 
                            <option 
                                <?php if($Bresult['brandId'] == $result['brandId']){ ?>
                                    selected = "selected"
                                <?php } ?>
                                value="<?php echo $Bresult['brandId']; ?>"><?php echo $Bresult['brandName']?>
                            </option>
                        <?php }} ?>

                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="body"><?php echo $result['body'];?></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="price" value="<?php echo $result['price'];?>" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img src="<?php echo $result['image']; ?>" width="120px" height="80px"><br/>
                        <input  type="file" name="image"/>
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            
                            <option 
                            <?php if($result['type']== 0){?>
                                selected = "selected"
                            <?php }?>
                            value="0"> Featured</option>
                            <option
                            <?php if($result['type']== 1){?>
                                selected = "selected"
                            <?php }?>
                            value="1">General</option>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
        <?php } } ?>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


