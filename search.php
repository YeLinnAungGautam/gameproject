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
    <div class="container mar-topper">

        <div class="no-mar-bottom row"> 
 
            <!-- Blog Entries Column -->
            <div class="no-mar-bottom col-md-12">
                <div class="home-category-header">
                    <h3>
                        Most Popular Among Users
                    </h3>
                </div>
                <div class="row mar-topper">
                    <?php 
                        if(isset($_POST['search_submit'])){
                            $search = $_POST['ptsearch'];
                            $query = "SELECT * FROM posts as p INNER JOIN game_category as gc on p.post_id = gc.game_id WHERE post_title LIKE '%$search%' ";
                            $searchquery = $connection->prepare($query);
                            $searchquery->bindValue(':keywords','%' . $search . '%',PDO::PARAM_STR);
                            $searchquery->execute();
                            if($searchquery->rowCount() == 0){
                                echo "<h1>NO RESULT</h1>";
                            }else{
                                while($row = $searchquery->fetch(PDO::FETCH_ASSOC)){
                                    $post_id = $row['post_id'];
                                    $post_title = $row['post_title'];
                                    $post_image = $row['post_img'];
                                    $post_description = $row['post_description'];
                    ?>
                        <div class="col-md-4 col-sm-4 col-xs-4 prodouctbox"> 
                            <div class="card" id="<?php echo $post_id?>">
                                <div class="download-icon">
                                    <i class="fas fa-download"></i>
                                </div>
                                <div class="image-container">
                                    <a href="post.php?p_id=<?php echo $post_id ?>">
                                        <img src="img/<?php echo $post_image ?>"  alt="image" data-target="postImage" id="get-image" class="img-responsive">
                                    </a>
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title"><b><?php echo $post_title; ?></b></h4>
                                    <div class="card-text" data-target="postDescription"><?php echo $post_description; ?></div>
                                    <a class="btn btn-primary readmore" href="post.php?p_id=<?php echo $post_id ?>">Read More <i class="fas fa-angle-double-right"></i> </a>
                                </div>
                            </div> 
                        </div>
                        <?php  }
                            }
                        }?>
                        
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- Footer -->
        <?php include("include/footer.php") ?>
    <!-- Footer -->
