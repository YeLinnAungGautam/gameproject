    <!-- Database Connection -->
    <?php include("admin/includes/db.php") ?>
    <!-- Database Connection -->
    <!-- Header -->
    <?php include("include/header.php") ?>)
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
                        $sql = "SELECT * FROM posts";
                        $query = $connection->prepare($sql);
                        $query->execute();
                        $result = $query->fetchAll(PDO::FETCH_OBJ);
                        if($query->rowCount()>0){
                        foreach($result as $row){
                            if($row->post_status == 'published'){
                    ?>
                    <div class="col-md-6" style="margin-bottom:2%"> 
                        <div class="card" id="<?php echo $row->post_id; ?>">
                            <a href="post.php?p_id=<?php echo $row->post_id ?>">
                                <img src="img/<?php echo $row->post_img ?>"  alt="image" data-target="postImage" id="get-image" class="img-responsive">
                            </a> 
                            <div class="card-body">
                                <h4 class="card-title"><b><?php echo $row->post_title; ?></b></h4>
                                <p class="card-text" style="text-align:justify" data-target="postDescription"><?php echo $row->post_description; ?></p>
                                <a class="btn btn-primary" href="post.php?p_id=<?php echo $row->post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                            </div>
                        </div> 
                    </div>
                    <?php } } }?>
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
