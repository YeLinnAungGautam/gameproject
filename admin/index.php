<?php
 
 include('includes/header.php');

 if($_SESSION['userrole'] != 'admin'){

    header("Location: 404");

}

?>
    <div id="wrapper"> 
        <!-- Navigation -->
        <?php include('includes/navigation.php') ?>
        
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading --> 
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome
                            <small><?php echo $_SESSION['username'] ?></small>
                        </h1>
                        <h1>
                        </h1>
                        
                    </div> 
                </div>
                <!-- /.row -->
                       
                <!-- /.row -->
                
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <?php 
                            $sql = "SELECT * FROM posts";
                            $query = $connection->prepare($sql);
                            $query->execute();
                            $post_counts = $query->rowCount();
                            echo "<div class='huge'>{$post_counts}</div>"
                        ?>
                        <div>Posts</div> 
                    </div>
                </div>
            </div>
            <a href="./posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <!-- <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                     <div class='huge'>23</div>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div> 
            </a>
        </div>
    </div> -->
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <?php 
                            $sql = "SELECT * FROM users";
                            $query =$connection ->prepare($sql);
                            $query->execute();
                            $users_count = $query->rowCount();
                            echo "<div class='huge'>{$users_count}</div>" 
                        ?>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="./user.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <?php 
                            $sql = "SELECT * FROM categories";
                            $query = $connection->prepare($sql);
                            $query->execute();
                            $cat_count = $query->rowCount();
                            echo "<div class='huge'>{$cat_count}</div>"; 
                        ?>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
                <!-- /.row -->
                <?php 
                    $user_role = 'editor';
                     $sql = "SELECT * FROM users WHERE user_role = :userrole";
                     $query = $connection->prepare($sql);
                     $query->bindParam(':userrole',$user_role,PDO::PARAM_STR);
                     $query->execute();
                     $editor_user_count = $query->rowCount();
                ?>
                <div class="row">
                    <script type="text/javascript">
                        google.charts.load('current', {'packages':['bar']});
                        google.charts.setOnLoadCallback(drawChart);
                            function drawChart() {
                                var data = google.visualization.arrayToDataTable([
                                ['Data', 'Count'],
                                <?php 
                             $element_text = ['Active Post','Categoires','Users','Editors'];
                             $element_count = [$post_counts, $cat_count ,$users_count,$editor_user_count];
                                    for($i = 0; $i < 4; $i++){
                                        echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
                                    }
                                ?>
                                // ['Posts', 20],
                                ]);
                                var options = {
                                chart: {
                                    title: '',
                                    subtitle: '',
                                }
                                };
                                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
                                chart.draw(data, google.charts.Bar.convertOptions(options));
                            }
                    </script>
                    <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                </div>    
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<!-- Modal -->
<?php include('includes/footer.php') ?>
    