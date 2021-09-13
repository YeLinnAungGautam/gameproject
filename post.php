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

        if(isset($_POST['buy'])) {
            if(isset($_SESSION['user_id'])) {
                header("Location:payment.php");
            }else{
                echo "Redirecting to ";
            }
        }

    ?>
    
    <link rel="stylesheet" href="css/front-enddevelop.css">
    <link rel="stylesheet" href="fontawesome-pack/css/all.min.css">
    <div class="container">

        <div class="row">
            <!-- php code --> 
                    <?php 
                        if(isset($_GET['p_id'])){
                            $post_each_id = $_GET['p_id'];

                            $count = '1';
                            $view_count = 'post_views_count';
                            $view_sql = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = :postid";
                            $view_query = $connection->prepare($view_sql);
                            $view_query->bindParam(':postid',$post_each_id,PDO::PARAM_INT);
                            $view_query->execute(); 

                            $sql = "SELECT * FROM posts WHERE post_id = :posteachid";
                            $query = $connection->prepare($sql);
                            $query->bindParam(':posteachid',$post_each_id,PDO::PARAM_STR);
                            $query->execute();
                            $result = $query->fetchAll(PDO::FETCH_OBJ);
                            if($query->rowCount()>0){
                            foreach($result as $row){
                    ?>
                    <!-- <div class="col-md-12" style="margin-bottom:2%"> 
                        <div class="card" id="">

                            <img src="img/"  alt="image" data-target="postImage" id="get-image" class="img-responsive">
                            
                            <div class="card-body">
                                <h4 class="card-title"><b></b></h4>
                                <p class="card-text" style="text-align:justify" data-target="postDescription"></p>
                                
                            </div>
                        </div> 
                    </div> -->
                    <h1 id="title"><?php echo $row->post_title; ?></h1>
	                <h5 id="subtitle">(action - adventure)</h5>
                    <div class="col-md-6">
                  <div class="highlight"><h3 class="recomreq">Recommended Requirements</h3></div> 
                    <p class="para">
                        <?php echo $row->requirement_description_one; ?>
                    </p>
                    <div class="highlightmini"><h3 id="minireq">Minimum Requirements</h3></div> 
                            <p class="para">
                            <?php echo $row->requirement_description_two; ?>		
                            </p>   
                    </div>

                    <div class="col-md-6">
                        <img src="img/<?php echo $row->post_img ?>"  alt="image" data-target="postImage" id="get-image" class="img-responsive">
                        <form method="post">
                        <pre class="price"> <?php echo $row->price; ?>  <button class="btn" name="buy" id="buynow">Buy Now</button> </pre> 
                        </form>
                    </div>
                </div>
            </div>
            <div class="container-fluid" id="about">
        <h2 class="titletext">About This Game</h2>
        <div class="container" id="gallerybackground">
            <div class="row">
                <div class="col-md-7">
                    <div class="row">
                    <div class="">
                                <div class="col-md-12">
                        <?php
                            $sql = "SELECT * FROM posts as p INNER JOIN game_images as gi on p.post_id = gi.game_id WHERE post_id = :posteachid";
                            $query = $connection->prepare($sql);
                            $query->bindParam(':posteachid',$post_each_id,PDO::PARAM_STR);
                            $query->execute();
                            $result = $query->fetchAll(PDO::FETCH_OBJ);
                            if($query->rowCount()>0){
                            foreach($result as $row){
                                // echo $row->images;
                        ?>
                            
                                    <div class="col-md-6">
                                        <img src="admin/additionalimages/<?php echo $row->images ?>" alt="gallery1" width="100%">
                                    </div>
                                
                        <?php
                            }
                        }
                        ?>
                        </div>
                                
                                </div>  
                        <div>
                            <!-- <div>
                                <div>
                                    <img src="img/residentEvilgallery2.jpg" alt="gallery2" width="100%"> 
                                </div>
                                <div>
                                    <img src="img/residentEvilgallery2.jpg" alt="gallery2" width="100%"> 
                                </div>
                            </div> -->
                            <!-- <div>
                                <div>
                                    <img src="img/residentEvilgallery3.jpeg" alt="gallery3" width="100%">
                                </div>
                                <div>
                                    <img src="img/residentEvilgallery4.png" alt="gallery4"  width="100%">
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="col-md-5" id="para">
                    <p class="residentpara">
                        <?php echo $row->post_description; ?>
                    </p>
                </div>
            </div>
        </div>
            <div class="container">
                <h3 class="addinfo">Additional Information</h3>
                <div class="row">
                    <div class="col-md-4 text-center">
                        <h4 id="datetitle"> <i class="far fa-calendar-alt" id="calendar"></i> Release Date</h4> 
                        <h6 class="calensub"><?php echo $row->releasegame_date;?></h6>
                    </div>
                    <div class="col-md-4 text-center">
                        <h4 id="datetitle"> <i class='fas fa-user-slash' id="age"></i> Age Rating</h4> 
                        <h6 class="agesub"><?php echo $row->gamerage_rating;?></h6>
                    </div>
                    <div class="col-md-4 text-center">
                    <h4 id="datetitle"> <i class='fas fa-gamepad' id="mode"></i> Mode</h4> 
                        <h6 class="modesub"> <?php echo $row->game_mode;?> </h6>
                    </div>
                </div>
            </div>
               
    </div>
                    <?php 
                        } } 
                    } 
                        else{
                            header("Location: index.php");
                        }?>
            <!--  the end -->
 
            <!-- Blog Entries Column -->  
              <!-- Sidebar -->
                <div class="container" style="background-color: black;">
                  <div class="row">
                      <div class="col-md-7" id="background">
                        <h3 class="youmayalso">You May Also Like:</h3>
                        <div class="row" id="card">
                           
                                <div class="col-md-4" id="firstcard">
                                       
                                <div class="card">
                                <img class="card-img-top img-responsive" src="img/assissan_cread.png" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="text-center">Assissan Cread</h5>
                                </div>
                                </div>
                                    
                                 </div>

                            <div class="col-md-4" id="secondcard">

                                <div class="card">
                                <img class="card-img-top img-responsive" src="img/cyberprunk.jpg" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="text-center">CyberPrunk 2007</h5>
                                </div>
                                </div>
 
                            </div>

                            <div class="col-md-4" id="thirdcard">

                                <div class="card">
                                <img class="card-img-top img-responsive" src="img/watchdogs.png" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="text-center">Watch Dogs 2</h5>
                                </div>
                                </div>
 
                            </div>
                            
                        </div>
                       <!-- second row -->
                       <h3 class="youmayalso">OTHERS :</h3>
                       <div class="row" id="card">
                           <?php 
                                $others_sql = "SELECT * FROM posts ORDER BY post_id DESC LIMIT 3";
                                $others_query = $connection->prepare($others_sql);
                                $others_query->execute();
                                $result = $others_query->fetchAll(PDO::FETCH_OBJ);
                                    if($others_query->rowCount()>0){
                                        foreach($result as $row){
                                            ?>   
                                <div class="col-md-4" id="firstcard">       
                                    <div class="card">
                                    <a href="post.php?p_id=<?php echo $row->post_id ?>">
                                        <img class="card-img-top img-responsive" src="img/<?php echo $row->post_img ?>" alt="Card image cap">
                                        <div class="card-body">
                                            <h5 class="text-center"><?php echo $row->post_title ?></h5>
                                        </div>
                                    </a>
                                    </div>    
                                </div>       
                                       <?php }
                                    }
                           ?>
                            
                        </div>
                    </div>
                      <?php include("include/sidebar.php") ?>
                  </div>
                </div>
           
        <!-- /.row -->

        <hr>
        <!-- Footer -->
        <?php include("include/footer.php") ?>
        <!-- Footer -->
