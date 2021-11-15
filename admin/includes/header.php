<?php ob_start(); ?>
<?php session_start(); ?>
<?php include("db.php") ?>
<?php 
    if(!isset($_SESSION['userrole'])){
            header("Location: ../");
} 
?> 

<?php include('function.php') ?>
<!DOCTYPE html>
<html lang="en">
 
<head> 
 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#860000" />
    <meta
      name="description"
      content="Gamehub Myanmar is the very first free-to-download PC Games Collection Community in Myanmar."
    />
    <link rel="icon" href="https://gamehubmyanmar.com/gm-icon.png" type="image/x-icon" />
 
    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
     <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">
    
    <!-- Editor -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="css/summernote.css">
    <!-- End Editor -->
    <!-- Jquery -->
    <script src="js/jquery.js"></script> 
    <link rel="stylesheet" href="css/style.css">
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<style>
    .card img{
        width: 100%;
    }
    .msg{
        margin-top: 0px;
        margin-bottom: 15px;
        text-align: center;
        color: green;
        font-weight: 700;
        font-size: 18px;
    }
    .card{
        padding: 20px;
    }
    .custom-file input[type='file']{
        display: none;
    }
    .custom-file label{
        cursor: pointer;
        margin-top: 15px;
    }
    #display_img img{
        width: 200px;
        border-radius: 7px;
    }
</style>
<body>