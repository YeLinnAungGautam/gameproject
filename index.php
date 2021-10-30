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
    <div class="container-fluid slider-container">
        <div class="splide" id="one">
                <div class="splide__track">
                    <ul class="splide__list">
                    <?php 
                        $slider_sql = "SELECT * FROM posts ORDER BY post_id DESC LIMIT 3";
                        $slider_query = $connection->prepare($slider_sql);
                        $slider_query->execute();
                        $result = $slider_query->fetchAll(PDO::FETCH_OBJ);
                            if($slider_query->rowCount()>0){
                                foreach($result as $row){
                                

                    ?>

                        <li class="splide__slide">
                            <img src="admin/additionalimages/<?php echo $row->post_slider_img ?>" class="slider-image">
                            <div class="slide-description">
                                <h3 class="slider-header"><?php echo $row->post_title?></h3>
                                <p>
                                    <?php
                                    $string = strip_tags($row->post_description);
                                    if (strlen($string) > 500) {

                                        // truncate string
                                        $stringCut = substr($string, 0, 500);
                                        $endPoint = strrpos($stringCut, ' ');

                                        //if the string doesn't contain any space then it will cut without word basis.
                                        $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                        $string .= '... </a>';
                                    }
                                    echo $string;?>
                                </p>
                                <a class="btn btn-primary readmore" href="<?php echo $baseurl;?>/post/<?php echo $row->slug; ?>">Read More <i class="fas fa-angle-double-right"></i> </a>
                            </div>
                        </li>
                        
                    <?php }} ?>
                    </ul>
                </div>
        </div>
    </div>
    
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
                            $sql = "SELECT * FROM posts";
                            $query = $connection->prepare($sql);
                            $query->execute();
                            $result = $query->fetchAll(PDO::FETCH_OBJ);
                            if($query->rowCount()>0){
                            foreach($result as $row){
                                if($row->post_status == 'published'){
                        ?>
                        <div class="col-md-4 col-sm-6 col-xs-6 prodouctbox"> 
                            <div class="card" id="<?php echo $row->post_id; ?>">
                                <div class="download-icon">
                                    <i class="fas fa-download"></i>
                                </div>
                                <div class="image-container"> 
                                    <a href="<?php echo $baseurl;?>/post/<?php echo $row->slug ?>">
                                        <img src="img/<?php echo $row->post_img ?>"  alt="image" data-target="postImage" id="get-image" class="img-responsive">
                                    </a>
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title"><b><?php echo $row->post_title; ?></b></h4>
                                    <div class="card-text" data-target="postDescription">
                                    <?php
                                        $string = strip_tags($row->post_description);
                                        if (strlen($string) > 100) {

                                            // truncate string
                                            $stringCut = substr($string, 0, 100);
                                            $endPoint = strrpos($stringCut, ' ');

                                            //if the string doesn't contain any space then it will cut without word basis.
                                            $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                            $string .= '... </a>';
                                        }
                                        echo $string;
                                    ?>
                                    </div>
                                    <a class="btn btn-primary readmore" id="readmore" href="<?php echo $baseurl;?>/post/<?php echo $row->slug ?>" data-json="{ 'id' : '<?php echo $row->post_id;?>'}">
                                    Read More <i class="fas fa-angle-double-right"></i> </a>
                                </div>
                            </div> 
                        </div>
                        <?php } } }?>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    
    
    <div class="red-product-container container-fluid mar-topper">
        <div class="container">
                <div class="home-category-header">
                    <h3>
                        Best Sellers
                    </h3>
                </div>
                <div class="category-description">
                    <p>
                        These are the best seller of this week.
                    </p>
                    <p>
                        Get it and Play it Now!
                    </p>
                </div>

                
                <div class="splide best-seller-splide" id="two">
                    <div class="splide__track">
                        <ul class="splide__list">
                            <?php 
                                $best_seller_sql = "SELECT * FROM posts ORDER BY post_views_count DESC LIMIT 5";
                                $best_seller_query = $connection->prepare($best_seller_sql);
                                $best_seller_query->execute();
                                $result = $best_seller_query->fetchAll(PDO::FETCH_OBJ);
                                    if($best_seller_query->rowCount()>0){
                                        foreach($result as $row){

                            ?>
                            <li class="splide__slide">
                                <div class="bs-posts-container">
                                    <div class="bs-posts-image">
                                        <a href="<?php echo $baseurl;?>/post/<?php echo $row->slug;?>">
                                            <img src="img/<?php echo $row->post_img; ?>">
                                        </a>
                                    </div>
                                    <div class="bs-posts-desc">
                                        <?php

                                        $sql = "SELECT * FROM posts as p INNER JOIN game_category as gc on p.post_id = gc.game_id INNER JOIN categories as c on c.cat_id = gc.category_id WHERE post_id = :postid";
                                        $query = $connection->prepare($sql);
                                        $query->bindParam(':postid',$row->post_id,PDO::PARAM_STR);
                                        $query->execute();
                                        $result = $query->fetchAll(PDO::FETCH_OBJ);
                                        if($query->rowCount()>0){
                                        foreach($result as $row){ 
                                        ?>
                                        <span class="bs-posts-tags"><?php echo $row->cat_title; ?></span>
                                        <?php }} ?>
                                    </div>
                                </div>
                            </li>
                            <?php  } } ?>

                        </ul>
                    </div>
                </div>
            </div>
    </div>

    <div class="container mar-topper">

        <div class="no-mar-bottom row"> 

            <!-- Blog Entries Column -->
            <div class="no-mar-bottom col-md-12">
                <div class="home-category-header">
                    <h3>
                        Our Offers
                    </h3>
                </div>
                <div class="row mar-topper">
                    <div class="col-md-3 col-sm-3 col-xs-6 offer-container">
                            <div class="offer-icon">
                            <i class="fas fa-undo"></i>
                            </div>
                            <div class="offer-desc">
                                <h5>Free Return</h5>
                                <p>We serve free if there is an error.</p>
                            </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6 offer-container">
                            <div class="offer-icon">
                            <i class="far fa-money-bill-alt"></i>
                            </div>
                            <div class="offer-desc">
                                <h5>Good Price</h5>
                                <p>We bring less price to play more.</p>
                            </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6 offer-container">
                            <div class="offer-icon">
                            <i class="far fa-clock"></i>
                            </div>
                            <div class="offer-desc">
                                <h5>No Delay</h5>
                                <p>No gap between payment and loading</p>
                            </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6 offer-container">
                            <div class="offer-icon">
                            <i class="fas fa-gamepad"></i>
                            </div>
                            <div class="offer-desc">
                                <h5>Unlimited</h5>
                                <p>Get Membership and play all.</p>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
</div>

    <!-- Footer -->
        <?php include("include/footer.php") ?>
    <!-- Footer -->
    
