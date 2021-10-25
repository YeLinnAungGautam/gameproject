<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("admin/includes/db.php");

$token = generateRandomString();

if($_POST['user_id'] !='' && $_POST['game_id'] !='' ) {

    $sql = "SELECT * FROM downloads_data WHERE game_id = :game_id";
    $query = $connection->prepare($sql);
    $query->bindParam(':game_id',$_POST['game_id'],PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0){
      $count_sql = "UPDATE downloads_data SET count = count + 1 WHERE game_id = :game_id";
      $count_query = $connection->prepare($count_sql);
      $count_query->bindParam(':game_id',$_POST['game_id'],PDO::PARAM_INT);
      $count_query->execute(); 
    
    }else{

      $userId = $_POST['user_id'];
      $gameId = $_POST['game_id'];
      $count = 1;
      $token = generateRandomString();
      $userIP = json_encode(IPtoLocation('74.119.146.35'));

      $status = "1";

      // $userIP = $_SERVER['REMOTE_ADDR']."<br/>";

      $sql = "INSERT INTO downloads_data(user_id,
                                        game_id,
                                        count,
                                        token,
                                        ip_location,
                                        status) 
                                        VALUE (
                                          :userid,
                                          :gameid,
                                          :count,
                                          :token,
                                          :ip_location,
                                          :status)";
                $query = $connection->prepare($sql);
                $query->bindParam(':userid',$userId,PDO::PARAM_STR);
                $query->bindParam(':gameid',$gameId,PDO::PARAM_STR);
                $query->bindParam(':count',$count,PDO::PARAM_STR);
                $query->bindParam(':token',$token,PDO::PARAM_STR);
                $query->bindParam(':ip_location',$userIP,PDO::PARAM_STR);
                $query->bindParam(':status',$status,PDO::PARAM_STR);

                $query->execute();

                print_r($query->errorInfo());
          
    }

    require("download.php");
}

echo $_POST['user_id'];
echo $_POST['game_id'];

 function generateRandomString($length = 10) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}

function IPtoLocation($ip){ 
  $apiURL = 'https://freegeoip.app/json/'.$ip; 
   
  // Make HTTP GET request using cURL 
  $ch = curl_init($apiURL); 
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
  $apiResponse = curl_exec($ch); 
  if($apiResponse === FALSE) { 
      $msg = curl_error($ch); 
      curl_close($ch); 
      return false; 
  } 
  curl_close($ch); 
   
  // Retrieve IP data from API response 
  $ipData = json_decode($apiResponse, true); 
   
  // Return geolocation data 
  return !empty($ipData)?$ipData:false; 
}



?>