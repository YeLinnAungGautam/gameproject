<!-- Navigation -->

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Start Bootstrap</a>
            </div> 
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php displayInNav(); ?>

                    <?php if(isLoggedIn()): ?>
                        <li>
                            <a href="admin">Admin</a>
                        </li>
                        <li>
                            <a href="include/logout.php">Logout</a>
                        </li>
                    <?php else: ?>
                        <li>
                            <a href="./login.php">Login</a>
                        </li>
                    <?php endif; ?>
                    <li>
                        <a href="registration.php">Register</a>
                    </li>
                    <!-- <li>
                        <a href="registration.php">Testing</a>
                    </li> -->
                    <?php  
                        if(isset($_SESSION['userrole'])){
                            if(isset($_GET['p_id'])){
                                echo "<li><a href='./admin/posts.php'>Edit</a></li>";
                            } 
                        }
                    ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>