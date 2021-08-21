<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">

<!-- Blog Search Well -->

<!-- Login --> 
<div class="well">
                    <h4>Login</h4>
                    <form action="include/login.php" method="POST">
                    <div class="form-group">
                        <input name="username" type="text" class="form-control" placeholder="Enter Username">   
                    </div>
                    <div class="input-group">
                        <input name="password" type="password" class="form-control" placeholder="Enter Password">   
                        <span class="input-group-btn">
                            <button class="btn btn-primary" name="login" type="submit">
                                Submit
                            </button>
                        </span>
                    </div> 
                    </form> 
                </div>
<!-- End Login -->
<!-- Blog Categories Well -->
<div class="well">
    <h4>Blog Categories</h4>
    <div class="row">
        <div class="col-lg-12">
            <ul class="list-unstyled">
                <?php 
                    $sql = "SELECT * FROM categories";
                    $query = $connection->prepare($sql);
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_OBJ);
                    if($query->rowCount()>0){
                        foreach($result as $row){
                            echo "<li><a href='categorypage.php?category=$row->cat_id'>$row->cat_title</li>";
                        }
                    }
                ?>
            </ul>
        </div>
    </div>
    <!-- /.row -->
</div>