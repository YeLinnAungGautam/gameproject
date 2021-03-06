    <?php ob_start(); ?>
    <!-- Database Connection -->
    <?php include("admin/includes/db.php") ?>
    <!-- Database Connection -->
    <!-- Header -->
    <?php include("include/header.php") ?>
    <!-- Header -->

    <!-- Navigation -->
    <?php include("include/navigation.php") ?>
    <!-- Navigation -->
 
    <!-- Page Content -->
    <?php
            $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            
            if(is_numeric(basename($url)) != 1) {
                
                $slug = $_GET['p_slug'];
                $slug_sql = "SELECT * FROM posts WHERE slug LIKE :slug and post_status='published'";
                $slug_query = $connection->prepare($slug_sql);
                $slug_query->bindValue(':slug','%'.$slug.'%',PDO::PARAM_STR);
                $slug_query->execute();
                if($slug_query->rowCount()>0){

                $result_slug = $slug_query->fetch(PDO::FETCH_OBJ);
                $game_id = $result_slug->post_id;

                }

                $count = '1';
                $view_count = 'post_views_count';
                $view_sql = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = :postid";
                $view_query = $connection->prepare($view_sql);
                $view_query->bindParam(':postid',$game_id,PDO::PARAM_INT);
                $view_query->execute(); 
                
                $sql = "SELECT * FROM posts WHERE post_id = :posteachid";
                $query = $connection->prepare($sql);
                $query->bindParam(':posteachid',$game_id,PDO::PARAM_STR);
                $query->execute();
                $result = $query->fetchAll(PDO::FETCH_OBJ);
                if($query->rowCount()>0){
                foreach($result as $row){
    ?>
        <div id="overlay">
            <div class="cv-spinner">
                <span class="spinner"></span>
            </div>
         </div>  
        
        
        <div class="container">
            <h1 id="title"><?php echo $row->post_title; ?></h1>
            <div class="row singledescriptioncontainer">

                <div class="col-md-6 singledescription">

                    <div class="highlight"><h3 class="recomreq">Minimum Requirements</h3></div> 

                        <div class="para">
                            <?php echo $row->requirement_description_one; ?>
                        </div>

                        <div class="highlightmini"><h3 id="minireq">Recommended Requirements</h3></div> 
                            <div class="para">
                                <?php echo $row->requirement_description_two; ?>		
                            </div>   
                        </div>


                        <div class="col-md-6 singleimage">
                            <img src="../img/<?php echo $row->post_img ?>"  alt="image" data-target="postImage" id="get-image" class="img-responsive">
                                                                    
                            <input type='hidden' id='user_id' value="<?php echo (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : "";?>">
                            <input type='hidden' id='game_id' value="<?php echo $row->slug;?>">
                            <input type='hidden' id='game-id' value="<?php echo $row->post_id;?>">
                            <input type='hidden' id='download-url' value="<?php echo $row->google_drive_link;?>">
                            <input type='hidden' id='price' value="<?php echo $row->price;?>">
                            
                            <?php 
                            if(isset($_SESSION['user_id'])) {
                                $sql = "SELECT * FROM downloads_data where game_id = :postid";
                                $query = $connection->prepare($sql);
                                $postid = $row->post_id;
                                $query->bindParam(':postid',$postid,PDO::PARAM_STR);
                                $query->execute();
                                $result = $query->fetchAll(PDO::FETCH_OBJ);
                                if($query->rowCount()>0){
        
                                    foreach($result as $row) {
        
                                            echo "<input type='hidden' value='loggedin' name='p_user_id' id='p_user_id' />
                                                  <input type='hidden' value='$row->count' name='count' id='d_count' />";
                                            
                                        
                                    }
                                }else {
                                    echo "<input type='hidden' value='0' name='count' id='d_count' />";
                                }
                            }
                            ?>

                            <pre class='price'><button name='download' id='buynow' class='btn btn-info btn-lg'>Download</button></pre> 
                            <!-- <button class="modal-toggle" id="modal-toggle">show modal popup</button> -->
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="container-fluid" id="about">
                <h2 class="titletext">About This Game</h2>
                <div class="container" id="gallerybackground">
                    <div class="row">

                        <div class="col-md-7">
                            <div class="row gallerycontainer">
                                <?php
                                    $sql = "SELECT * FROM posts as p INNER JOIN game_images as gi on p.post_id = gi.game_id WHERE post_id = :posteachid";
                                    $query = $connection->prepare($sql);
                                    $query->bindParam(':posteachid',$game_id,PDO::PARAM_STR);
                                    $query->execute();
                                    $result = $query->fetchAll(PDO::FETCH_OBJ);
                                    if($query->rowCount()>0){
                                    foreach($result as $row){
                                        // echo $row->images;
                                ?>
                                    
                                <div class="col-md-6 col-sm-6 col-xs-6 abouthisgame">
                                    <img src="../admin/additionalimages/<?php echo $row->images ?>" alt="gallery1" width="100%">
                                </div>
                                        
                                <?php
                                    }
                                }
                                ?> 
                            </div>
                        </div>
                        <div class="col-md-5" id="para">
                            <?php echo $row->post_description; ?>
                        </div>
                    </div>
                </div>
                             
            </div>


            <div class="container">
                <h3 class="addinfo">Additional Information</h3>
                <div class="row">
                    <div class="col-md-4 col-xs-4 text-center">
                        <h4 id="datetitle"> <i class="far fa-calendar-alt" id="calendar"></i> Release Date</h4> 
                        <h6 class="calensub"><?php echo $row->releasegame_date;?></h6>
                    </div>
                    <div class="col-md-4 col-xs-4 text-center">
                        <h4 id="datetitle"> <i class='fas fa-user-slash' id="age"></i> Age Rating</h4> 
                        <h6 class="agesub"><?php echo $row->gamerage_rating;?></h6>
                    </div>
                    <div class="col-md-4 col-xs-4 text-center">
                        <h4 id="datetitle"> <i class='fas fa-gamepad' id="mode"></i> Mode</h4> 
                        <h6 class="modesub"> <?php echo $row->game_mode;?> </h6>
                    </div>
                </div>
            </div>
               
        </div>
                    <?php 
                            }
                    ?>
                    <!--  the end -->
        
                    <!-- Blog Entries Column -->  
                    <!-- Sidebar -->
                <br/><br/>
                <div class="container" style="background-color: black;">
                    <div class="row">
                        <div class="col-md-7" id="background">
                            <h3 class="youmayalso">You May Also Like</h3>
                            <div class="row" id="card">
                                    <?php
                                        
                                        $sql = "SELECT category_id FROM game_category where game_id = :gameid";
                                        $query = $connection->prepare($sql);
                                        $query->bindParam(':gameid',$game_id,PDO::PARAM_STR);
                                        $query->execute();
                                        $result = $query->fetchAll(PDO::FETCH_OBJ);
                                        if($query->rowCount()>0){
                                            foreach($result as $row) 
                                            {

                                                $category_ids[] = $row->category_id;
                                                
                                            }
                                            $arr = implode(",",$category_ids);
                                            
                                            $sql = "SELECT DISTINCT p.*
                                            FROM game_category AS gc
                                            INNER JOIN posts AS p ON gc.game_id = p.post_id
                                            WHERE gc.category_id IN (:categoryids) LIMIT 6
                                            ";
                                            $query = $connection->prepare($sql);
                                            $query->bindParam(':categoryids',$arr,PDO::PARAM_STR);
                                            $query->execute();
                                            $result = $query->fetchAll(PDO::FETCH_OBJ);
                                            if($query->rowCount()>0){
                                            foreach($result as $row){ 

                                            if ($row->post_id != $game_id) {
                                    ?>
                                <div class="col-md-4 col-xs-4  youmayalsolike">
                                    <div class="card">
                                        <a href="<?php echo $row->slug;?>">
                                            <img class="card-img-top img-responsive" src="<?php echo $baseurl;?>/img/<?php echo $row->post_img; ?>" alt="Card image cap">
                                        </a>
                                        <div class="card-body">
                                            <h5 class="text-center"><?php echo $row->post_title;?></h5>
                                        </div>
                                    </div>
                                </div>
                                <?php  }}}}?>
                            </div>
                            <!-- second row -->
                            <h3 class="youmayalso">New Arrivals</h3>
                                <div class="row" id="card">
                                    <?php 
                                        $others_sql = "SELECT * FROM posts ORDER BY post_id DESC LIMIT 3";
                                        $others_query = $connection->prepare($others_sql);
                                        $others_query->execute();
                                        $result = $others_query->fetchAll(PDO::FETCH_OBJ);
                                            if($others_query->rowCount()>0){
                                                foreach($result as $row){
                                                    ?>   

                                        
                                        <div class="col-md-4 col-xs-4  youmayalsolike">
                                            <div class="card">
                                                <a href="<?php echo $row->slug; ?>">
                                                    <img class="card-img-top img-responsive" src="../img/<?php echo $row->post_img ?>" alt="Card image cap">
                                                </a>
                                                <div class="card-body">
                                                    <h5 class="text-center"><?php echo $row->post_title ?></h5>
                                                </div>
                                            </div>
                                        </div>

                                    <?php
                                             }  }

                                            }else{
                                                echo '<div class="container notfoundpage text-center">
                                                     <h1>Record Not Found !</h1>
                                                     <p>Sorry, your requested page or keyword is not available at the moment</p>
                                                     <a href='.$baseurl.'>Back to Home Page</a>
                                                 </div>';
                                             }
                                             }else{
                                                 echo "<script type='text/javascript'>
                                                         window.location.href = ".$baseurl."
                                                         </script>";
                                             }
                                    ?>
                                    
                                </div>
                        </div>
                    </div>
                </div> 

        <!-- Modal -->
                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog" id="adadtime">
                        <!-- Modal content-->
                        <div class="modal-content"> 
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" id="ad_close_custom">&times;</button>
                            <h4 class="modal-title">Ads</h4>
                        </div>
                        <div class="modal-body">
                            <img src="https://neptune.link/ThemeOptions/images/ads.png" alt="Advertise at Gamehub Myanmar" srcset="">
                        </div>
                        <div class="modal-footer">
                            <!-- <progress value="0" max="10" id="progressBar"></progress> -->
                            <div id="countdown"></div>
                        </div>
                        </div>

                    </div>
                </div>
        <!-- Footer -->
        <?php include("include/footer.php") ?>
        <!-- Footer -->

