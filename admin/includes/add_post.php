<?php 
if(isset($_POST['create_post'])){
    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category'];
    $post_description = $_POST['post_description'];
    $post_tags = $_POST['post_tags'];
    $post_date = date('d-m-y');
    $post_status = $_POST['post_status'];
     
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    move_uploaded_file($post_image_temp,"../img/$post_image");
 
    $sql = "INSERT INTO posts(post_category_id,post_title,post_status,post_description,post_img,post_tags,post_date) VALUE(:postcategoryid,:ptitle,:poststatus,:pdescription,:pimage,:posttags,:postdate)";
    $query = $connection->prepare($sql);
    $query->bindParam(':postcategoryid',$post_category_id,PDO::PARAM_STR);
    $query->bindParam(':ptitle',$post_title,PDO::PARAM_STR);
    $query->bindParam(':pdescription',$post_description,PDO::PARAM_STR);
    $query->bindParam(':pimage',$post_image,PDO::PARAM_STR);
    $query->bindParam(':posttags',$post_tags,PDO::PARAM_STR);
    $query->bindParam(':postdate',$post_date,PDO::PARAM_STR);
    $query->bindParam(':poststatus',$post_status,PDO::PARAM_STR);
    $query->execute();
    $lastInsertid = $connection->lastInsertId();
    if($lastInsertid){
        echo "
        <div class='col-lg-12'> 
            <h3 class='msg'>Data is Successfully Inserted!</h3>
        </div>
        ";
        header("Location: posts.php");
    }else{
        echo "Something Wrong";
    }
}

?>
<div class="col-md-12">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" name="post_title" class="form-control">
        </div>
        <div class="form-group">
            <select name="post_category" id="">
                <?php
                    $sql = "SELECT * FROM categories";
                    $query = $connection->prepare($sql);
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_OBJ);
                    if($query->rowCount()>0){
                        foreach($result as $row){
                            echo "<option value='$row->cat_id'>$row->cat_title</option>";
                        } 
                    } 
                ?>
            </select>
        </div>
        <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
        </div>
        <div class="form-group">
            <label for="post_image">Post Tags</label>
            <input type="text" name="post_tags" class="form-control">
        </div>
        <div class="form-group">
        <label for="summernote">Post Description</label>
        <textarea name="post_description"  cols="30" rows="10" class="form-control"></textarea>
        </div> 
        <div class="form-group">
          <select name="post_status" id="">
              <option value="draft">Post Status</option>
              <option value="published">Published</option>
              <option value="draft">Draft</option>
          </select>
        </div>
        <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
        </div>
    </form>
</div>