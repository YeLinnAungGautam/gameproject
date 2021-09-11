    <!-- Database Connection -->
    <?php include("admin/includes/db.php") ?>
    <!-- Database Connection -->
    <!-- Header -->
    <?php include("include/header.php") ?>
    <!-- Header -->

    <!-- Navigation -->
    <?php include("include/navigation.php") ?>
    <!-- Navigation -->


    <!-- Slider -->
    
    

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
                        if(isset($_GET['category'])){
                            $category_title_id = $_GET['category'];
                        }
                        $sql = "SELECT * FROM posts as p INNER JOIN game_category as gc on p.post_id = gc.game_id INNER JOIN categories as c on c.cat_id = gc.category_id WHERE cat_id = :postcategoryid";
                        $query = $connection->prepare($sql);
                        $query->bindParam(':postcategoryid',$category_title_id,PDO::PARAM_STR);
                        $query->execute();
                        $result = $query->fetchAll(PDO::FETCH_OBJ);
                        if($query->rowCount()>0){
                        foreach($result as $row){
                    ?>
                        <div class="col-md-4 col-sm-4 col-xs-4 prodouctbox"> 
                            <div class="card" id="<?php echo $row->post_id; ?>">
                                <div class="download-icon">
                                    <i class="fas fa-download"></i>
                                </div>
                                <div class="image-container">
                                    <a href="post.php?p_id=<?php echo $row->post_id ?>">
                                        <img src="img/<?php echo $row->post_img ?>"  alt="image" data-target="postImage" id="get-image" class="img-responsive">
                                    </a>
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title"><b><?php echo $row->post_title; ?></b></h4>
                                    <div class="card-text" data-target="postDescription"><?php echo $row->post_description; ?></div>
                                    <a class="btn btn-primary readmore" href="post.php?p_id=<?php echo $row->post_id ?>">Read More <i class="fas fa-angle-double-right"></i> </a>
                                </div>
                            </div> 
                        </div>
                        <?php } } ?>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- Footer -->
        <?php include("include/footer.php") ?>
    <!-- Footer -->
