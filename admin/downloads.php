<?php include('includes/header.php') ?>
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
                            <small>Admin</small>
                        </h1>
                    </div>
                    <!-- IN HERE NEED TO MAKE CONDITION -->
                    <?php 
                        include ("includes/view_all_downloads.php");                        
                    ?>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
<?php include('includes/footer.php') ?>
    