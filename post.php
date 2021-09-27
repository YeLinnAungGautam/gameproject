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
    if(isset($_SESSION['user_id'])) {
        $sql = "SELECT * FROM downloads_data where game_id = :postid";
        $postid = $_GET['p_id'];
        $query = $connection->prepare($sql);
        $query->bindParam(':postid',$postid,PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        if($query->rowCount()>0){

            foreach($result as $row) {

                if ($row->user_id == $_SESSION['user_id']) {
                    @$pay_user_id = "<input type='hidden' value='donePay' name='p_user_id' id='p_user_id' />";
                    
                }
            }


        } 
        
    } else {


    }
    
    ?>    
    <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div id="overlay">
                    <div class="cv-spinner">
                        <span class="spinner"></span>
                    </div>
                </div>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="modalLabel">Modal Title</h4>
                </div>
                <div class="modal-body">
                
                <div class="container">
                    <div class="row">
                        <form id="payform" method="post">
                            <div class="col-xs-12 col-md-4">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            Payment Details
                                        </h3>
                                        <div class="checkbox pull-right">
                                            <label>
                                                <input type="checkbox" />
                                                Remember
                                            </label>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                            <div class="form-group">
                                                <label for="cardNumber">CARD NUMBER</label>
                                                <div class="input-group">

                                                    <input type="hidden" name="user_id" id="m_user_id" />
                                                    <input type="hidden" name="game_id" id="m_game_id"/>
                                                    <input type="hidden" name="price" id="m_price"/>

                                                    <input type="text" class="form-control" id="cardNumber" value="09-939393939393" placeholder="Valid Card Number"
                                                        required autofocus />
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-7 col-md-7">
                                                    <div class="form-group">
                                                        <label for="expityMonth">
                                                            EXPIRY DATE</label>
                                                        <div class="col-xs-6 col-lg-6 pl-ziro">
                                                            <input type="text" class="form-control" id="expityMonth" value="7" placeholder="MM" required />
                                                        </div>
                                                        <div class="col-xs-6 col-lg-6 pl-ziro">
                                                            <input type="text" class="form-control" id="expityYear" value="2025" placeholder="YY" required /></div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-5 col-md-5 pull-right">
                                                    <div class="form-group">
                                                        <label for="cvCode">
                                                            CV CODE</label>
                                                        <input type="password" class="form-control" id="cvCode" value="888" placeholder="CV" required />
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <ul class="nav nav-pills nav-stacked">
                                    <li class="active"><a href="#"><span class="badge pull-right"><span class="glyphicon glyphicon-usd"></span>4200</span> Final Payment</a>
                                    </li>
                                </ul>
                                <br/>
                                <input type="submit" value="Pay" class="btn btn-success btn-lg btn-block" role="button" />
                            </div>
                        </form>
                    </div>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
        </div>
    </div>

    <!-- <div id="overlay">
        <div class="cv-spinner">
            <span class="spinner"></span>
        </div>
    </div> -->


    <div class="container mar-topper">
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
   
    <div class="container">
            <h1 id="title"><?php echo $row->post_title; ?></h1>
	        <h5 id="subtitle">(action - adventure)</h5>
            <div class="row singledescriptioncontainer">

                <div class="col-md-6 singledescription">
                  <div class="highlight"><h3 class="recomreq">Recommended Requirements</h3></div> 
                    <div class="para">
                        <?php echo $row->requirement_description_one; ?>
                    </div>
                    <div class="highlightmini"><h3 id="minireq">Minimum Requirements</h3></div> 
                            <div class="para">
                            <?php echo $row->requirement_description_two; ?>		
                            </div>   
                    </div>

                    <div class="col-md-6 singleimage">
                        <img src="img/<?php echo $row->post_img ?>"  alt="image" data-target="postImage" id="get-image" class="img-responsive">
                                                                
                        <input type='hidden' id='user_id' value="<?php echo (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : "";?>">
                        <input type='hidden' id='game_id' value="<?php echo $row->post_id;?>">
                        <input type='hidden' id='price' value="<?php echo $row->price;?>">
                        
                        <?php 
                        if (isset($_SESSION['user_id'])) {

                            echo @$pay_user_id ;

                        }
                        ?>

                        <pre class="price" id="pricebtn"> <?php echo $row->price; ?>  <button class="btn" id="buynow" name="buy">Buy Now</button> </pre> 
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
                                    $query->bindParam(':posteachid',$post_each_id,PDO::PARAM_STR);
                                    $query->execute();
                                    $result = $query->fetchAll(PDO::FETCH_OBJ);
                                    if($query->rowCount()>0){
                                    foreach($result as $row){
                                        // echo $row->images;
                                ?>
                                    
                                <div class="col-md-6 col-sm-6 col-xs-6 abouthisgame">
                                    <img src="admin/additionalimages/<?php echo $row->images ?>" alt="gallery1" width="100%">
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
                     } 
                    }else{
                        echo "<script type='text/javascript'>
                                window.location.href = 'index.php'
                                </script>";
                    }?>
            <!--  the end -->
 
            <!-- Blog Entries Column -->  
              <!-- Sidebar -->
                <div class="container" style="background-color: black;">
                  <div class="row">
                      <div class="col-md-7" id="background">
                        <h3 class="youmayalso">You May Also Like:</h3>
                        <div class="row" id="card">
                           
                            <div class="col-md-4 col-xs-4  youmayalsolike">
                                <div class="card">
                                    <img class="card-img-top img-responsive" src="img/assissan_cread.png" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="text-center">Assissan Cread</h5>
                                    </div>
                                </div>
                             </div>

                            <div class="col-md-4 col-xs-4 youmayalsolike">

                                <div class="card">
                                <img class="card-img-top img-responsive" src="img/cyberprunk.jpg" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="text-center">CyberPrunk 2007</h5>
                                </div>
                                </div>
 
                            </div>

                            <div class="col-md-4 col-xs-4 youmayalsolike">

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
                                
                                <div class="col-md-4 col-xs-4  youmayalsolike">
                                <div class="card">
                                <a href="post.php?p_id=<?php echo $row->post_id ?>">
                                    <img class="card-img-top img-responsive" src="img/<?php echo $row->post_img ?>" alt="Card image cap">
                                </a>
                                    <div class="card-body">
                                        <h5 class="text-center"><?php echo $row->post_title ?></h5>
                                    </div>
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
                                
            </div>

        <hr>

        <!-- Footer -->
        <?php include("include/footer.php") ?>
        <!-- Footer -->
