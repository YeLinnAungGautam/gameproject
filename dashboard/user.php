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
                        if(isset($_GET['source'])){
                            $source = $_GET['source'];
                        }else{
                            $source = '';
                        }
                        switch($source){
                            case 'add_user.php';
                            include ("includes/add_user.php");
                            break;
                            
                            default:
                            include ("includes/view_all_users.php");
                            break;
                        }
                    ?>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
<?php include('includes/footer.php') ?>
    