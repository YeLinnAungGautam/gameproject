<?php

include('admin/includes/db.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    $email = $_POST['email'];

    $sql = "SELECT * FROM subscriptions WHERE email = :checkmail";
    $query = $connection->prepare($sql);
    $query->bindParam(':checkmail',$email,PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0){
        echo "1";
    }else{
        $sql = "INSERT INTO subscriptions(email) 
                            VALUE(:email)";
        $query = $connection->prepare($sql);
        $query->bindParam(':email',$email, PDO::PARAM_STR);
        $query->execute(); 
        echo "0";
    }

?>