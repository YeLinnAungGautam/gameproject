<?php include("../admin/includes/db.php") ?>
<?php session_start(); ?>
<?php 
if(isset($_POST['login'])){
   
   $username = $_POST['username'];
   $password = $_POST['password']; 
    
   $sql = "SELECT * FROM users WHERE username = :username";
   $query = $connection->prepare($sql);
   $query->bindParam(':username',$username,PDO::PARAM_STR);
   $query->execute();
   $result = $query->fetchAll(PDO::FETCH_OBJ);
   if($query->rowCount()>0){
       foreach($result as $row){
           $db_userid     = $row->user_id;
           $db_username   = $row->username;
           $db_password   = $row->user_password;
           $db_firstname  = $row->user_firstname;
           $db_lastname   = $row->user_lastname;
           $db_userrole   = $row->user_role;
       }
   } 
   $password = crypt($password,$db_password); 
   if($username === $db_username && $password === $db_password){
    $_SESSION['username'] = $db_username;
    $_SESSION['firstname'] = $db_firstname;
    $_SESSION['lastname'] = $db_lastname;
    $_SESSION['userrole'] = $db_userrole;
    header("Location: ../admin");   
} 
else{
    header("Location: ../login.php");
}  
}
?>