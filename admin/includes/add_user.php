<?php 
if(isset($_POST['create_user'])){
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $password = $_POST['user_password'];

    $sql ="INSERT INTO users(username,user_password,user_firstname,user_lastname,user_email,user_role) 
           VALUE(:username,:user_password,:user_firstname,:user_lastname,:user_email,:user_role)";
    $query = $connection->prepare($sql);
    $query->bindParam(':username',$username,PDO::PARAM_STR);
    $query->bindParam(':user_password',$password,PDO::PARAM_STR);
    $query->bindParam(':user_firstname',$user_firstname,PDO::PARAM_STR);
    $query->bindParam(':user_lastname',$user_lastname,PDO::PARAM_STR);
    $query->bindParam(':user_email',$user_email,PDO::PARAM_STR);
    $query->bindParam(':user_role',$user_role,PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $connection->lastInsertId();
    if($lastInsertId){
        header("Location: user.php");
    }else{
        echo "Something Went Wrong";
    }
}
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
       <label for="title">Firstname</label>
       <input type="text" name="user_firstname" class="form-control">
    </div>
    <div class="form-group">
       <label for="title">Lastname</label>
       <input type="text" name="user_lastname" class="form-control">
    </div>
    <div class="form-group">
         <select name="user_role" id="" class="mb-2">
               <option value="subscriber">Select User Role</option>
               <option value="admin">Admin</option>
               <option value="editor">Editor</option>
         </select>
    </div>
    <div class="form-group">
       <label for="post_image">Username</label>
      <input type="text" name="username" class="form-control">
    </div>
    <div class="form-group">
       <label for="post_content">Email</label>
       <input type="email" name="user_email" class="form-control">
    </div>
    <div class="form-group">
       <label for="post_content">Password</label>
       <input type="password" name="user_password" class="form-control">
    </div>

    <div class="form-group">
      <input type="submit" class="btn btn-primary" name="create_user" value="Add User">
    </div>
</form>