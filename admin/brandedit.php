<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
    include "../classes/Brand.php";
?>

    <?php
        if(!isset($_GET['brandid']) || $_GET['brandid'] == NULL){
            echo "<script>window.location = 'brandlist.php'; </script>";
            //header("Loation: catlist.php");
        }else{
            $id = $_GET['brandid'];
        }
    ?>


    <?php
        $brand = new Brand();
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $brandName = $_POST['brandName'];
            $updateBrand = $brand->brandUpdate($id, $brandName);
        }
    ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Brand</h2>
        <div class="block copyblock"> 
            <?php
                if(isset($updateBrand)){
                    echo $updateBrand;
                }
            ?>

            <form action="" method="post">
                <?php
                    $getBrand = $brand->getBrandById($id);
                    if($getBrand){
                       $result = $getBrand->fetch_assoc();      
                ?>

                <table class="form">					
                    <tr>
                        <td>
                            <input type="text" name="brandName" value="<?php echo $result['brandName']; ?>" class="medium" />
                        </td>
                    </tr>
    				<tr> 
                        <td>
                            <input type="submit" name="submit" Value="Update" />
                        </td>
                    </tr>
                </table>
        <?php } ?>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>