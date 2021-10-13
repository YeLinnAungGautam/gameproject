<?php

include("dashboard/includes/db.php");

$token = generateRandomString();


if(isset($_POST['user_id']) && isset($_POST['game_id']) && isset($_POST['price'])) {

  $userId = $_POST['user_id'];
  $gameId = $_POST['game_id'];
  $price = $_POST['price'];
  $token = generateRandomString();
  $userIP = json_encode(IPtoLocation('74.119.146.35'));

  $status = "1";

  // $userIP = $_SERVER['REMOTE_ADDR']."<br/>";

  $sql = "INSERT INTO downloads_data(user_id,
                                    game_id,
                                    price,
                                    token,
                                    ip_location,
                                    status) 
                                    VALUE (
                                      :userid,
                                      :gameid,
                                      :price,
                                      :token,
                                      :ip_location,
                                      :status)";
            $query = $connection->prepare($sql);
            $query->bindParam(':userid',$userId,PDO::PARAM_STR);
            $query->bindParam(':gameid',$gameId,PDO::PARAM_STR);
            $query->bindParam(':price',$price,PDO::PARAM_STR);
            $query->bindParam(':token',$token,PDO::PARAM_STR);
            $query->bindParam(':ip_location',$userIP,PDO::PARAM_STR);
            $query->bindParam(':status',$status,PDO::PARAM_STR);

            $query->execute();

            $view = "<button name='download' id='buynow' class='btn btn-info btn-lg'>Download</button>";

            echo $view;
}

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