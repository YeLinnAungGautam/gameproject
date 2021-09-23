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
                                $slider_sql = "SELECT * FROM posts as p INNER JOIN game_images as gi on p.post_id = gi.game_id ORDER BY p.post_id DESC LIMIT 3";
                                $slider_query = $connection->prepare($slider_sql);
                                $slider_query->execute();
                                $result = $slider_query->fetchAll(PDO::FETCH_OBJ);
                                    if($slider_query->rowCount()>0){
                                        foreach($result as $row){


                    ?>

                        <li class="splide__slide">
                            <img src="admin/additionalimages/<?php echo $row->images ?>" class="slider-image">
                            <div class="slide-description">
                                <h3 class="slider-header"><?php ?></h3>
                                <div class="slider-text" data-target="postDescription"><?php echo $row->post_description; ?></div>
                                <a class="btn btn-primary readmore" href="#">Read More <i class="fas fa-angle-double-right"></i> </a>
                            </div>
                        </li>
<?php }} ?>

                        <!-- <li class="splide__slide">
                            <img src="https://splidejs.com/wp-content/themes/splide/assets/images/slim/02.jpg" class="slider-image">
                            <div class="slide-description">
                                <h3 class="slider-header">Hit Man : 3</h3>
                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quam perspiciatis vel, ipsam est et, at dolore nam maxime provident placeat laborum exercitationem! Cupiditate officia animi enim odio suscipit, laboriosam eveniet.Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quam perspiciatis vel, ipsam est et, at dolore nam maxime provident placeat laborum exercitationem! Cupiditate officia animi enim odio suscipit, laboriosam eveniet.</p>
                                <a class="btn btn-primary readmore" href="#">Read More <i class="fas fa-angle-double-right"></i> </a>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <img src="https://splidejs.com/wp-content/themes/splide/assets/images/slim/03.jpg" class="slider-image">
                            <div class="slide-description">
                                <h3 class="slider-header">Hit Man : 3</h3>
                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quam perspiciatis vel, ipsam est et, at dolore nam maxime provident placeat laborum exercitationem! Cupiditate officia animi enim odio suscipit, laboriosam eveniet.Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quam perspiciatis vel, ipsam est et, at dolore nam maxime provident placeat laborum exercitationem! Cupiditate officia animi enim odio suscipit, laboriosam eveniet.</p>
                                <a class="btn btn-primary readmore" href="#">Read More <i class="fas fa-angle-double-right"></i> </a>
                            </div>
                        </li> -->
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
                            <li class="splide__slide">
                                <div class="bs-posts-container">
                                    <div class="bs-posts-image">
                                        <a href="#">
                                            <img src="https://cdn.europosters.eu/image/750/posters/mass-effect-3-multiplayer-i12272.jpg">
                                        </a>
                                    </div>
                                    <div class="bs-posts-desc">
                                        <span class="bs-posts-tags">Adventure</span>
                                        <span class="bs-posts-tags">Strategy</span>
                                        <span class="bs-posts-tags">Multiplayer</span>
                                    </div>
                                </div>
                            </li>

                            <li class="splide__slide">
                                <div class="bs-posts-container">
                                    <div class="bs-posts-image">
                                        <a href="#">
                                            <img src="https://image.api.playstation.com/vulcan/ap/rnd/202012/0815/7CRynuLSAb0vysSC4TmZy5e4.png">
                                        </a>
                                    </div>
                                    <div class="bs-posts-desc">
                                    <span class="bs-posts-tags">Adventure</span><span class="bs-posts-tags">Strategy</span><span class="bs-posts-tags">Multiplayer</span>
                                    </div>
                                </div>
                            </li>
                            
                            <li class="splide__slide">
                                <div class="bs-posts-container">
                                    <div class="bs-posts-image">
                                        <a href="#">
                                            <img src="https://s2.gaming-cdn.com/images/products/2692/orig/game-epic-games-control-cover.jpg">
                                        </a>
                                    </div>
                                    <div class="bs-posts-desc">
                                    <span class="bs-posts-tags">Adventure</span><span class="bs-posts-tags">Strategy</span><span class="bs-posts-tags">Multiplayer</span>
                                    </div>
                                </div>
                            </li>

                            <li class="splide__slide">
                                <div class="bs-posts-container">
                                    <div class="bs-posts-image">
                                        <a href="#">
                                            <img src="https://cdn.shopify.com/s/files/1/0747/3829/products/mL4130_1024x1024.jpg?v=1577740565">
                                        </a>
                                    </div>
                                    <div class="bs-posts-desc">
                                        <span class="bs-posts-tags">Adventure</span><span class="bs-posts-tags">Strategy</span><span class="bs-posts-tags">Multiplayer</span>
                                    </div>
                                </div>
                            </li>
                                
                            
                            
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
