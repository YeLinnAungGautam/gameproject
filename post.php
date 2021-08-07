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
    <div class="container">

        <div class="row">
 
            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <div class="row">
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
                    <div class="col-md-12" style="margin-bottom:2%"> 
                        <div class="card" id="<?php echo $row->post_id; ?>">

                            <img src="img/<?php echo $row->post_img ?>"  alt="image" data-target="postImage" id="get-image" class="img-responsive">
                            
                            <div class="card-body">
                                <h4 class="card-title"><b><?php echo $row->post_title; ?></b></h4>
                                <p class="card-text" style="text-align:justify" data-target="postDescription"><?php echo $row->post_description; ?></p>
                                
                            </div>
                        </div> 
                    </div>
                    <?php 
                        } } 
                    } 
                        else{
                            header("Location: index.php");
                        }?>
                </div>
            </div>

            <!-- Sidebar -->
            <?php include("include/sidebar.php") ?>
            <!-- Sidebar -->

            <!-- Widget -->
            <?php include("include/widget.php") ?>
            <!-- Widget -->

            </div>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php include("include/footer.php") ?>
        <!-- Footer -->
