    <!-- Database Connection -->
    <?php include("admin/includes/db.php") ?>
    <!-- Database Connection -->
    <!-- Header -->
    <?php include("include/header.php") ?>
    <!-- Header -->

    <!-- Navigation -->
    <?php include("include/navigation.php") ?>
    <!-- Navigation -->
    <?php 
        checkIfUserIsLoggedInAndRedirect();
        if(ifItIsMethod('post')){
            if(isset($_POST['username']) &&  isset($_POST['password'])){
                login_user($_POST['username'],$_POST['password']);
            }
            else{
                header("Location: ../index.php");
            }
        }
    ?>
<div class="container" class="well" style="min-height: calc(100vh - 300px);">
    <div class="row"> 
            <h3 class="text-center" id="gamehubtitle" style="margin-top: 30px;"> Login</h3>
            <!-- <h5 class="text-center" id="gamehubsubtitle">Play more, Pay less</h5> -->
        <div class="col-md-6 col-xs-12 col-md-offset-3" id="logincontainer">
                <form action="include/login.php" method="POST">
                <input type="hidden" value="" id="gameId" name="gameId"/>

                    <?php
                    
                    if($_GET) {
                    
                    if($_GET['action'] == 'fail') {
                        
                    ?>

                    <h4 class="text-center text-warning">Invalid Credentials ! Please Try again.</h4>
                    
                    <?php }elseif($_GET['action'] == 'cfs') {;?>
                    
                    <h4 class="text-center text-warning">Please login so you can buy your favourite game.</h4>
                    
                    <?php }}; ?>

                    <div class="form-group">
                        <input name="username" type="text" class="form-control" placeholder="Enter Username">   
                    </div>

                    <div class="form-group">
                        <input name="password" class="form-control" id="password-input" type="password" placeholder="Enter Password">
                    </div>

                    <div class="form-group">
                        <input type="checkbox" onclick="togglePassword()" style="float: left; margin-top: -10px;>">
                        <div style="margin-left: 21px;color:#fff;">
                            Show Password
                        </div>
                    </div>

                    <div id="loginbutton">
                       <button class="btn" name="login" type="submit">Log In</button>
                    </div>
                </form>
                    <!-- <h5 class="text-center" id="passrecover">
                        <a href="<?php echo $baseurl;?>/forgotpassword/forgot=<?php echo uniqid(true); ?>">Forgot your password?</a> 
                        <a href="./registration">Sign Up</a></h5> -->

       </div>          
    </div>
</div>



<script type="text/javascript" >

    $(document).ready(function() {       

        var gId = window.sessionStorage.getItem("gameId");

        if(gId != ''){
            $("#gameId").val(gId);
        }
    })
    
    function togglePassword() {
        var x = document.getElementById("password-input");
        if (x.type === "password") {
        x.type = "text";
        } else {
        x.type = "password";
        }
    }

</script>


    <!-- Footer -->
    <?php include("include/footer.php") ?>
    <!-- Footer -->
    

                   

