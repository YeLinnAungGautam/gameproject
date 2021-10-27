

<?php include("admin/includes/db.php") ?>

<?php 

    include("include/header.php");

    if(empty($_SESSION['user_id'])) {

        header("Location: $baseurl");

    }

 ?>

    <!-- Navigation -->
    <?php include("include/navigation.php") ?>
    <?php registerUser(); ?>
    <!-- Page Content -->
    <link rel="stylesheet" href="css/front-enddevelop.css">
    
<section id="login">
                <div class="container" style="min-height: calc(100vh - 300px);">
                    <div class="row" id="gamehub">
                            <h1 class="text-center"> Gamehub Myanmar</h1>
                            <h5 class="text-center">Play more, Pay less</h5>
                     
                <!-- form -->
                <div class="col-xs-6 col-xs-offset-3" id="main">
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                 
                        <h4 class="text-center text-warning"><?php echo $message ?></h4>
                        <div class="form-group"> 
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="enter your name">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="enter your email address">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="password">
                        </div>
                      
                                <input type="submit" name="submit" id="btn-register" class="btn" value="Register">          
                    </form>
                </div>
                <!-- end -->
             
                </div>
                   <h5 id="accountcheck">Already Have an Account?<a href="login">Sign In</a></h5>
                </div> 
        
</section>
       
        <?php include("include/footer.php") ?>
