<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_POST['create_post'])){
    
    $post_title = $_POST['post_title'];
    $slug = slug($post_title);
    $post_description = $_POST['post_description'];
    $minimum_requirement = $_POST['requirement_description_one'];
    $recommended_requirement = $_POST['requirement_description_two'];
    $price = trim($_POST['price']);
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    move_uploaded_file($post_image_temp,"../img/$post_image");

    //Slider Image        
    $post_slider = $_FILES['post_slider']['name'];
    $post_slider_temp = $_FILES['post_slider']['tmp_name'];
    move_uploaded_file($post_slider_temp,"./additionalimages/$post_slider");
    
    
    $relase_date = $_POST['releasedate'];
    $age_rating = $_POST['agerating'];
    $game_mode = $_POST['gamemode'];
    
    $sql = "INSERT INTO posts(post_title,
                            slug,
                            post_img,
                            post_slider_img,
                            post_description,
                            requirement_description_one,
                            requirement_description_two,
                            post_status,
                            price,
                            releasegame_date,
                            gamerage_rating,
                            game_mode)
                        VALUE(:ptitle,
                            :slug,
                            :pimage,
                            :psliderimage,
                            :pdescription,
                            :requirement1,
                            :requirement2,
                            :poststatus,
                            :price,
                            :releasegamedate,
                            :gamerage_rating,
                            :game_mode
                            )";
    $query = $connection->prepare($sql);
    $query->bindParam(':ptitle',$post_title,PDO::PARAM_STR);
    $query->bindParam(':slug', $slug, PDO::PARAM_STR);
    $query->bindParam(':pimage',$post_image,PDO::PARAM_STR);
    $query->bindParam(':psliderimage',$post_slider,PDO::PARAM_STR);
    $query->bindParam(':pdescription',$post_description,PDO::PARAM_STR);
    $query->bindParam(':requirement1',$minimum_requirement,PDO::PARAM_STR);
    $query->bindParam(':requirement2',$recommended_requirement,PDO::PARAM_STR);
    $query->bindParam(':price',$price,PDO::PARAM_STR);
    $query->bindParam(':poststatus',$post_status,PDO::PARAM_STR);
    $query->bindParam(':releasegamedate',$relase_date,PDO::PARAM_STR);
    $query->bindParam(':gamerage_rating',$age_rating,PDO::PARAM_STR);
    $query->bindParam(':game_mode',$game_mode,PDO::PARAM_STR);
    $query->execute();
    $lastInsertid = $connection->lastInsertId();

    // $sliderquery = "INSERT INTO game_images(game_id,sliderimage)
    // VALUE(:gameid,
    // :sliderimage)";
    // $sliderquery = $connection->prepare($sliderquery);
    // $sliderquery->bindParam(':gameid',$lastInsertid, PDO::PARAM_STR);
    // $sliderquery->bindParam(':sliderimage',$post_slider, PDO::PARAM_STR);
    // $sliderquery->execute();



    // Additional Images
    
    
    if($lastInsertid){

        $extension = array('jpeg','jpg','png','gif');

        foreach($_FILES['images']['tmp_name'] as $items => $item){
            $filename = $_FILES['images']['name'][$items];
            $filename_tmp = $_FILES['images']['tmp_name'][$items];
            $ext = pathinfo($filename,PATHINFO_EXTENSION);

        if(in_array($ext,$extension)){
            move_uploaded_file($filename_tmp, './additionalimages/'.$filename);
        }

        else{
            echo "File Format is not correct";
        }

        $sql_additional_images = "INSERT INTO game_images(game_id,
                                images) 
                                VALUE(:gameid,
                                :images)";
        $query_additional_images = $connection->prepare($sql_additional_images);
        $query_additional_images->bindParam(':gameid',$lastInsertid, PDO::PARAM_STR);
        $query_additional_images->bindParam(':images',$filename, PDO::PARAM_STR);
        $query_additional_images->execute();
        }

        $post_category = $_POST['post_category'];

        foreach ($post_category as $category) {

            $sql = "INSERT INTO game_category(game_id,category_id) VALUE (:gameid,:categoryid)";
            $query = $connection->prepare($sql);
            $query->bindParam(':gameid',$lastInsertid,PDO::PARAM_STR);
            $query->bindParam(':categoryid',$category,PDO::PARAM_STR);
            $query->execute();
        }
        
        echo 
        "<div class='col-lg-12'> 
            <h3 class='msg'>Data is Successfully Inserted!</h3>
        </div>
        ";
        // header("Location: posts.php");
    }else{
        echo 
        "<div class='alert alert-danger' role='alert'>
        Something Wrong
        </div>";
    }
}

?>
<form action="" method="post" enctype="multipart/form-data">

    <div class="col-md-6">
        
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="post_title" class="form-control" >
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
                            foreach($result as $row){
                                echo "<option value='$row->cat_id'>$row->cat_title</option>";
                            } 
                        } 
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="post_image">Image</label>
                <input type="file" class="form-control" name="image" >
            </div>

            <div class="section">
                <h5><b>Additional Images</b></h5>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="file" class="form-control" name="images[]"  required multiple />
                        </div>
                    </div>
                    <!-- <div class="col-md-6">
                        <div class="form-group">
                            <input type="file" class="form-control" name="images[]">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="file" class="form-control" name="images[]">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="file" class="form-control" name="images[]">
                        </div>
                    </div> -->
                </div> 
            </div>

            <div class="form-group">
                <label for="post_slider">Slider</label>
                <input type="file" class="form-control" name="post_slider" >
            </div>

            <!-- <div class="form-group">
                <label for="post_image">Tags</label>
                <input type="text" name="post_tags" class="form-control">
            </div> -->
 
            <div class="form-group">
                <label for="summernote">Description</label>
                <textarea name="post_description" id="summernote" cols="30" rows="10" class="form-control"></textarea>
            </div> 

            <div class="form-group">
                <label for="requirement-description-one">Minimum Requirements</label>
                <textarea name="requirement_description_one" id="summernote" cols="30" rows="10" class="form-control"></textarea>
            </div> 
            <div class="form-group">
                <label for="requirement-description-two">Recommended Requirements</label>
                <textarea name="requirement_description_two" id="summernote"  cols="30" rows="10" class="form-control"></textarea>
            </div> 

    </div>

    <div class="col-md-6">
            
            <div class="form-group">
                <label for="price"> Price </label>
                <input type="text" name="price" class="form-control" pattern='[0-9]+(\\.[0-9][0-9]?)?' >
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="gamereleasedate">Game Release Date</label>
                    <input type="date" name="releasedate" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="agerating">Age Rating</label>
                    <input type="text" name="agerating" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="gamemode">Game Mode</label>
                    <input type="text" name="gamemode" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="status"> Status </label>
                <select name="post_status" class="form-control">
                    <option disabled value="draft">Post Status</option>
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
            </div>

    </div>

</form>

