<form action="" method="post">
    <label for="cat_title"><h3>Update Category</h3></label>
    <div class="form-group">
        <?php 
            if(isset($_GET['edit'])){
                $cat_id = $_GET['edit'];
                $sql = "SELECT * FROM categories WHERE cat_id =:catid";
                $query =$connection->prepare($sql);
                $query->bindParam(':catid',$cat_id,PDO::PARAM_INT);
                $query->execute();
                $result = $query->fetchAll(PDO::FETCH_OBJ);
                if($query->rowCount()>0){
                    foreach($result as $row){
                    ?> 
                    <input type="text" value="<?php if(isset($row->cat_title)){echo $row->cat_title;}?>" class="form-control" name="cat_title">
                <?php } } } ?>
                <?php  
                    if(isset($_POST['update_category'])){
                        $the_cat_title = $_POST['cat_title'];
                        $sql = "UPDATE categories set cat_title =:cattitle WHERE cat_id = :catid";
                        $query = $connection->prepare($sql);
                        $query->bindParam(':cattitle',$the_cat_title,PDO::PARAM_STR);
                        $query->bindParam(':catid',$cat_id,PDO::PARAM_INT);
                        $query->execute();
                        header("Location: categories.php");
                    }
                ?>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_category" value="Update Category">
    </div>
</form>