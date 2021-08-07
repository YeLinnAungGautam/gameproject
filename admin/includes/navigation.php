<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../index.php">Visit Website</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <!-- <li>
                    <a href="../index.php">Home Site</a>
                </li> -->
                <li>
                    <a href="#"><i class="fa fa-user"></i>
                    <?php 
                            if(isset($_SESSION['username'])){
                                echo $_SESSION['username'];
                            }
                        ?>
                    </a>
                </li>
                <!-- <li class="dropdown">
                    <a href="#" class="dropdown-toggle"  data-toggle="dropdown"><i class="fa fa-user"></i>  
                        
                    <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="../include/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li> -->
                <li><a href="../include/logout.php">Log Out</a></li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                     
                    <li> 
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Posts <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li> 
                                <a href="./posts.php">View Posts</a>
                            </li>
                            <li>
                                <a href="posts.php?source=add_post.php">Add Post</a>
                            </li>
                        </ul> 
                    </li>
                    <li>
                        <a href="categories.php"><i class="fa fa-fw fa-wrench"></i> Categories</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#users">
                        <i class="fa fa-fw fa-user"></i>Users<i class="fa fa-fw fa-caret-down"></i>
                        </a>
                        <ul id="users" class="collapse">
                            <li><a href="./user.php">View Users</a></li>
                            <li><a href="user.php?source=add_user.php">Add Users</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="profile.php"><i class="fa fa-fw fa-file"></i> Profile</a>
                    </li> 
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>