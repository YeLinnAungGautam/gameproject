<header class="header-box">
    <div class="container">
        <div class="col-md-6 col-sm-6 col-xs-12 text-left site-icon">
            <h1>
            <a href="<?php echo $baseurl;?>"> 
            <span class="firstletter">Gamehub</span> <span class="secondletter">Myanmar</span></h1>
            </a>
        </div>
        <!-- <div class="col-md-6 col-sm-6 col-xs-12 text-right site-profile">
            <ul>

                <?php                         
                    if(isset($_SESSION['user_id'])){
                ?>
                    <li class="btn btn-danger">
                        <a href="<?php echo $baseurl;?>/include/logout.php">log-out</a>
                    </li>
                
                <?php 
                    } else {
                    echo '<li>
                            <a href="'.$baseurl.'/login">Login</a>
                        </li>';
                    }
                ?>

            </ul>
        </div> -->
    </div>
</header>


<!-- Navigation -->
<nav class="navbar navbar-inverse" role="navigation">

        <div class="container">
            <div class="col-md-9 nav-links">
                <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div> 
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php displayInNav(); ?>
                    <?php                         
                    if(isset($_SESSION['user_id'])){
                    ?>
                        <li style="background:#231;">
                            <a href="<?php echo $baseurl;?>/include/logout.php" class="text-danger">Logout</a>
                        </li>
                    
                    <?php 
                        } else {
                        echo '<li style="background:#231;">
                                <a href="'.$baseurl.'/login">Login</a>
                            </li>';
                        }
                    ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
            </div>
            
            <div class="col-md-3 search-bar">   
                <div class="wrap">
                <form action="<?php echo $baseurl;?>/search" method="post">
                <input type="hidden" id="base-url" value="<?php echo $baseurl;?>">

                <?php if ($activePage != 'login') {?>
                    <div class="search">
                        <input type="text" class="searchTerm" placeholder="What are you looking for?" name="ptsearch" id="ptsearch" >
                        <button type="submit" class="searchButton" name="search_btns">
                            <i class="fa fa-search"></i>
                        </button>
                    </div> 
                <?php } ?>
                </form>
                </div>
            </div>
        </div>
        <!-- /.container -->
    </nav>