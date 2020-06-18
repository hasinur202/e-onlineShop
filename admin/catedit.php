<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
    include "../classes/Category.php";
?>

    <?php
        if(!isset($_GET['catid']) || $_GET['catid'] == NULL){
            echo "<script>window.location = 'catlist.php'; </script>";
            //header("Loation: catlist.php");
        }else{
            $id = $_GET['catid'];
        }
    ?>

    <?php
        $cat = new Category();
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $catName = $_POST['catName'];
            $updateCat = $cat->catUpdate($id, $catName);
        }
    ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Category</h2>
        <div class="block copyblock"> 
            <?php
                if(isset($updateCat)){
                    echo $updateCat;
                }
            ?>

            <form action="" method="post">
                <?php
                    $getCat = $cat->getCatById($id);
                    if($getCat){
                       $result = $getCat->fetch_assoc();      
                ?>

                <table class="form">					
                    <tr>
                        <td>
                            <input type="text" name="catName" value="<?php echo $result['catName']; ?>" class="medium" />
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