<?php
ob_start(); 
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;
        use PHPMailer\PHPMailer\SMTP;
    ?>
    
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

<?php 
        if(empty($_GET['email']) && empty($_GET['token'])){
            header("Location: http://localhost:8080/gameproject/index");
        }
        // $email = 'davidgautam.1234@gmail.com';
        // $token = '6a5fb1ea10528d4c8e6ae0189eb55dd63baecc347f1357b9597c070c671b48daa4ae534ebce693dc893d9ff1a3b6d3faf0a7';
        $sql = "SELECT username,user_email,token FROM users WHERE token =:token";
        if($sql){
        $query = $connection->prepare($sql);
        $query->bindParam(':token',$_GET['token'],PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $username = $result['username'];

        // if($_GET['token'] !== $token || $_GET['email'] !== $email){
        //     header("Location: index.php");
        // }

        if(isset($_POST['password']) && isset($_POST['confirmpassword'])){
            if($_POST['password'] === $_POST['confirmpassword']){
                $password = $_POST['password'];
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT, array('cost'=>12));
                $tokenupdate = '';
                $sql_updatepassword = "UPDATE users SET token=:tokenupdate,user_password=:updatedpassword WHERE user_email = :registeremail";
                if($sql_updatepassword){
                    $query_fornewpassword = $connection->prepare($sql_updatepassword);
                    $query_fornewpassword->bindParam(':tokenupdate',$tokenupdate,PDO::PARAM_STR);
                    $query_fornewpassword->bindParam(':updatedpassword',$hashedPassword,PDO::PARAM_STR);
                    $query_fornewpassword->bindParam(':registeremail',$_GET['email'],PDO::PARAM_STR);
                    $query_fornewpassword->execute();
                    header("Location: http://localhost:8080/gameproject/login");  
                    exit; 
                }
            }else{
                echo "No the password does not match";
            }
        }
    }?>
    <div class="container">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Reset Your Password</h2>
                                <div class="panel-body">

                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">   
                                                <input id="password" name="password" placeholder="Enter Your New Password" class="form-control"  type="password"> 
                                        </div>
                                        <div class="form-group">   
                                                <input id="confirmpassword" name="confirmpassword" placeholder="Confirmed Your Password" class="form-control"  type="password"> 
                                        </div>
                                        <div class="form-group">
                                            <input name="resetPassword" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <?php include("include/footer.php") ?>
</div> <!-- /.container -->
    