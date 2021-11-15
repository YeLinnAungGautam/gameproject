<?php

session_start();

include("admin/function.php");

$activePage = basename($_SERVER['PHP_SELF'], ".php");

// $baseurl = "https://gamehubmyanmar.com";
 $baseurl = "http://localhost/gameproject";

?>

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

    <title>Gamehub Myanmar</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo $baseurl;?>/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $baseurl;?>/css/front-enddevelop.css">

    <!-- Custom CSS -->
    <link href="<?php echo $baseurl;?>/css/blog-home.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->    
    
    <!-- Custom Fonts -->
    <link href="<?php echo $baseurl;?>/fontawesome-pack/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- <script src="./js/typeahead/typeahead.bundle.min.js"></script> -->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>-->
    <script src="<?php echo $baseurl;?>/js/typeahead.js"></script>

    <script src="https://apis.google.com/js/api.js"></script>

    <!-- Splide CSS  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">


    

</head>

<body>
