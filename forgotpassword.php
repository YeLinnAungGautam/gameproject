    <?php 
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
     
      require './vendor/autoload.php';
    //  require './vendor/phpmailer/phpmailer/src/SMTP.php';
    require './classes/Config.php';
    require 'vendor/phpmailer/phpmailer/src/Exception.php';
    require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require 'vendor/phpmailer/phpmailer/src/SMTP.php';
     

    if(!ifItIsMethod('get') && !isset($_GET['forgot'])){
        header("Location: index.php");
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

                /**Configure PHPMailer */
                

                 $mail = new PHPMailer(true);
                // $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
                try {
                // $mail->SMTPDebug = SMTP::DEBUG_SERVER;           //Enable verbose debug output
                $mail->SMTPDebug = 4; 
                $mail->isSMTP();                                 //Send using SMTP
                $mail->Host       = Config::SMTP_HOST;           //Set the SMTP server to send through
                $mail->Username   = Config::SMTP_USER;           //SMTP username
                $mail->Password   = Config::SMTP_PASSWORD;       //SMTP password
                $mail->Port       = Config::SMTP_PORT;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
                $mail->SMTPAuth   = true;                        //Enable SMTP authentication
                $mail->isHTML(true);
                $mail->setFrom('davidgautam.1234@gmail.com','Dev Gautam');
                $mail->addAddress($email);
                $mail->Subject = 'This is a test email';
                $mail->Body = 'Email body';
                $mail->send();
                echo 'Message has been sent';
            }catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

                // if($mail->send()){
                //     echo "It was sent";
                // }else{
                //     echo "It is not";
                // }
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

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




                   


