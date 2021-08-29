<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_GET['p_id'])){
    $post_id = $_GET['p_id'];
}

// Fetching Games data
$sql = "SELECT * FROM posts WHERE post_id = :postid ";
$query=$connection->prepare($sql);
$query->bindParam(':postid',$post_id,PDO::PARAM_INT);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount()>0){
    foreach($result as $row){ 
        $post_title = $row->post_title;
        // $post_category = $row->post_category;
        $post_img = $row->post_img; 
        $post_description = $row->post_description;
        $minimum_requirement = $row->requirement_description_one;
        $recommended_requirement = $row->requirement_description_two;
        $price = $row->price;
        $post_status= $row->post_status;
    }
}

// Fetching Categories
$sql = "SELECT * FROM posts as p INNER JOIN game_category as gc on p.post_id = gc.game_id  INNER JOIN categories as c on c.cat_id = gc.category_id where p.post_id = :postid";
$query=$connection->prepare($sql);
$query->bindParam(':postid',$post_id,PDO::PARAM_INT);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount()>0){
    
    foreach($result as $row){ 

    $arr[]= $row->category_id;

    }
} 

    // print_r($arr);
     
updatePosts();
?>
    <form action="" method="post" enctype="multipart/form-data">

        <div class="col-md-6">
        
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="post_title" class="form-control" value=<?php echo $post_title; ?> >
            </div>

            <div class="form-group mx-sm-3 mb-2">
                <label for="category">Category</label>
                <select multiple name="post_category[]" class="form-control" >
                <?php
                         $sql = "SELECT * FROM categories";
                         $query = $connection->prepare($sql);
                         $query->execute();
                         $result = $query->fetchAll(PDO::FETCH_OBJ);
                         if($query->rowCount()>0){
                             foreach($result as $cat_row){

                                 if(in_array($cat_row->cat_id, $arr)) {

                                     $color = 'selected';
                                        
                                 } else {
                                     // $value = "";
                                     // print_r($cat_row->cat_id);
                     
                                     $color = '';
                                 }
                     
                                 echo "<option value=$cat_row->cat_id $color>$cat_row->cat_title</option>";
                             } 
                         }
                     
                    ?>
                </select>
            </div>
            <div class="form-group">
                <img src="../img/<?php echo $post_img;?>" alt="" style="width: 125px;margin-bottom: 1%;">
                <input type="file" name="image"> 
            </div>

            <div class="form-group mx-sm-3 mb-2">
                <label for="category">Category</label>
                
            </div>

        <div class="form-group">
            <label for="summernote">Post Description</label>
            <textarea name="post_description" id="summernote_editdescription"  cols="30" rows="10" class="form-control"><?php echo $post_description ?></textarea>
        </div> 

        <div class="form-group">
            <label for="requirement-description-one">Minimum Requirements</label>
            <textarea name="requirement_description_one" id="summernote_editminimum"  cols="30" rows="10" class="form-control"><?php echo $minimum_requirement; ?></textarea>
        </div> 

        <div class="form-group">
            <label for="requirement-description-two">Recommended Requirements</label>
            <textarea name="requirement_description_two" id="summernote_recommended"  cols="30" rows="10" class="form-control"><?php echo $recommended_requirement; ?></textarea>
        </div> 

        
        </div>

        <div class="col-md-6">

            <div class="form-group">
                <label for="price"> Price </label>
                <input type="text" name="price" value="<?php echo $price;?>" class="form-control" pattern='[0-9]+(\\.[0-9][0-9]?)?' >
            </div>
                    

            <div class="form-group">
                <label for="Status"> Status </label>
                <select name="post_status" class="form-control">
                <option value='<?php echo $post_status;?>'><?php echo $post_status ?></option>
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

        </div>

    </form>

