    <!-- Database Connection -->
    <?php include("admin/includes/db.php") ?>
    <!-- Database Connection -->
    <!-- Header -->
    <?php include("include/header.php") ?>
    <!-- Header -->

    <!-- Navigation -->
    <?php include("include/navigation.php") ?>
    <!-- Navigation -->

    <link rel="stylesheet" href="css/front-enddevelop.css">

<div class="container" class="well" style="min-height: calc(100vh - 300px);">
    <div class="row">
            <h1 class="text-center" id="gamehubtitle"> Gamehub Myanmar</h1>
            <h5 class="text-center" id="gamehubsubtitle">Play more, Pay less</h5>
        <div class="col-xs-6 col-xs-offset-3" id="logincontainer">
                <form action="include/login.php" method="POST">
                    <div class="form-group">
                        <input name="username" type="text" class="form-control" placeholder="Enter Username">   
                    </div>

                    <div class="form-group">
                        <input name="password" type="password" class="form-control" placeholder="Enter Password">
                    </div>

                    <h5 id="checkboxtitle"><input type="checkbox"> Remember me</h5>  

                    <div id="loginbutton">
                       <button class="btn" name="login" type="submit">Log In</button>
                    </div>
                </form>
                    <h5 class="text-center" id="passrecover"><a href="">Forgot your password?</a><a href="">Sign Up</a></h5>
       </div>          
    </div>
</div>




                   


