<?php include("includes/header.php") ?>

  <div id="wrapper">

        <!-- Navigation -->
        <?php include("includes/navigation.php") ?>

        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome Admin
                            <small>Author</small>
                        </h1>

                        <div class="col-xs-6">
                            <?php insertCategories() ?>
                         <form action="" method="post">
                         <label for="cat-title"><h3>Add Category</h3></label>
                          <div class="form-group">
                            <input type="text" class="form-control" name="cat_title">
                          </div>
                          <div class="form-group">
                          <input type="submit" class="btn btn-primary" name="submit_categories" value="Add Category">
                          </div>
                         </form>
                         <?php 
                            if(isset($_GET['edit'])){
                                $cat_id = $_GET['edit'];
                                include "includes/updatecategories.php";
                            }
                         ?>
                        </div>
                        <div class="col-xs-6">
                           <table class="table table-bordered table-hover">
                               <thead>
                                   <tr> 
                                       <th>ID</th>
                                       <th>Category Title</th>
                                   </tr>
                               </thead>
                               <tbody> 
                                <?php findAllCategories(); ?>
                                <?php deleteCategories(); ?>                                
                               </tbody>
                           </table>
                        </div>
                    </div> 
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    <?php include("includes/footer.php") ?>
