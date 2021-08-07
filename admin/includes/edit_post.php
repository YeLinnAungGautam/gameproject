<?php 
  if(isset($_GET['p_id'])){
    $post_id = $_GET['p_id'];
}
$sql = "SELECT * FROM posts WHERE post_id = :postid";
$query=$connection->prepare($sql);
$query->bindParam(':postid',$post_id,PDO::PARAM_INT);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount()>0){
    foreach($result as $row){ 
        $post_title = $row->post_title;
        // $post_category = $row->post_category;
        $post_img = $row->post_img; 
        $post_tags= $row->post_tags;
        $post_description = $row->post_description;
        $post_status= $row->post_status;
    }
}
updatePosts();
?>
<div class="col-md-12">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" name="post_title" class="form-control" value="<?php echo $post_title; ?>">
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
        <img src="../img/<?php echo $post_img;?>" alt="" style="width: 125px;margin-bottom: 1%;">
        <input type="file" name="image"> 
        </div>
        <div class="form-group">
            <label for="post_image">Post Tags</label>
            <input type="text" name="post_tags" class="form-control" value="<?php echo $post_tags ?>">
        </div>
        <div class="form-group">
        <label for="summernote">Post Description</label>
        <textarea name="post_description"  cols="30" rows="10" class="form-control"><?php echo $post_description ?></textarea>
        </div> 
        <div class="form-group">
            <select name="post_status" id="">
            <option value='<?php echo $post_status ?>'><?php echo $post_status ?></option>
                <?php

                if($post_status == 'published'){
                    echo "<option value='draft'>draft</option>";
                }else{
                    echo "<option value='published'>published</option>";
                }

                ?>
            </select>
        </div>
        <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
        </div>
    </form>
</div>