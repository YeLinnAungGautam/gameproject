<?php 
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','gameproject');

// define('DB_HOST','localhost');
// define('DB_USER','neptrior_gameadmin');
// define('DB_PASS','neptrior_GAME');
// define('DB_NAME','neptrior_gameproject');
 
try{
    $connection = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER,DB_PASS);
}catch(PDOException $e){
    exit("Error: " .$e->getMessage());
} 
?>