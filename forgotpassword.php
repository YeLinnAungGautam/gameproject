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
    <?php 
    include("include/header.php");

    if(empty($_SESSION['user_id'])) {

        header("Location: $baseurl");

    }

    ?>
    <!-- Header -->

    <!-- Navigation -->
    <?php include("include/navigation.php") ?>
    <!-- Navigation -->

    <link rel="stylesheet" href="css/front-enddevelop.css">


<?php 
     
    require __DIR__ .'/vendor/autoload.php';
    require 'vendor/phpmailer/phpmailer/src/Exception.php';
    require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require 'vendor/phpmailer/phpmailer/src/SMTP.php';
     

    if(empty($_GET['forgot'])){
        header("Location: http://localhost:8080/gameproject/index");
        exit;
    }
    if(ifItIsMethod('post')){
        if(isset($_POST['email'])){
            $email = $_POST['email'];
            $length = 50;
            $token = bin2hex(openssl_random_pseudo_bytes($length));

            if(email_exists($email)){
                $sql = "UPDATE users SET token = :token WHERE user_email = :useremail";
                $query = $connection->prepare($sql);
                $query->bindParam(':token',$token,PDO::PARAM_STR);
                $query->bindParam(':useremail',$email,PDO::PARAM_STR);
                $query->execute();

                $mail = new PHPMailer();
                $mail->isSMTP();
                $mail->Host = 'smtp.mailtrap.io';
                $mail->SMTPAuth = true;
                $mail->Port = 2525;
                $mail->Username = 'be2414b7b456f6';
                $mail->Password = '5f6a2f826a7e91'; 
                $mail->isHTML(true);
                $mail->CharSet = 'UTF-8';

                $mail->setFrom('yelinnaung@neptunemm.com','Dev Gautam');
                $mail->addAddress($email);

                $mail->Subject = 'This is a test email';

                $mail->Body = '<p>Please Click To Reset Your Password
                                <a href="http://localhost:8080/gameproject/reset.php?email='.$email.'&token='.$token.' ">http://localhost:8080/gameproject/reset.php?email='.$email.'&token='.$token.'</a>
                               </p>';

                if($mail->send()){
                    $emailSent = true;
                }else{
                    echo "Not Sent";
                }
                
                
            

            } 
        }
    }
?>



<div class="container" class="well" style="min-height: calc(100vh - 300px);">
<div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                            <?php if(!isset($emailSent)): ?>
                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">
                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>
                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->
                                <?php else: ?>
                                <h2>Please Check Your Mail</h2>
                                <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include("include/footer.php") ?>