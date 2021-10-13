<?php include('includes/header.php') ?>
    <?php 
        if(isset($_SESSION['username'])){
            $username_session = $_SESSION['username'];
            
            $sql = "SELECT * FROM users WHERE username =:username";
            $query = $connection->prepare($sql);
            $query->bindParam(':username', $username_session, PDO::PARAM_STR);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_OBJ);
            if($query->rowCount()>0){
                foreach($result as $row){
                    $user_id     = $row->user_id;
                    $username   = $row->username;
                    $user_password   = $row->user_password;
                    $user_firstname  = $row->user_firstname;
                    $user_lastname   = $row->user_lastname;
                    $user_email     = $row->user_email;
                    $user_role   = $row->user_role;
                    
                }
            }
            $password = crypt($password,$user_password);
        }    
        if(isset($_POST['update_user'])){
            // $userid = $_POST['id'];
            $username = $username_session;
            $user_password_m = $_POST['user_password'];
            $user_firstname = $_POST['user_firstname'];
            $user_lastname = $_POST['user_lastname'];
            $user_email = $_POST['user_email'];
            $user_role = $_POST['user_role'];

            $sql = "SELECT randSalt FROM users";
            $query_randSalt = $connection->prepare($sql);
            $query_randSalt->execute();
            $result = $query_randSalt->fetch(PDO::FETCH_ASSOC);
            $salt = $result['randSalt'];  
            $hash_password = crypt($user_password_m,$salt);

            $sql = "UPDATE users set user_password = :userpassword, user_firstname = :userfirstname, user_lastname = :userlastname, user_email = :useremail, user_role = :userole WHERE username = :username";
            $query = $connection->prepare($sql);
            $query ->bindParam(':username',$username,PDO::PARAM_STR);
            $query ->bindParam(':userpassword',$hash_password,PDO::PARAM_STR);
            $query ->bindParam(':userfirstname',$user_firstname,PDO::PARAM_STR);
            $query ->bindParam(':userlastname',$user_lastname,PDO::PARAM_STR);
            $query ->bindParam(':useremail',$user_email,PDO::PARAM_STR);
            $query ->bindParam(':userole',$user_role,PDO::PARAM_STR);

            $query->execute();
        }
    ?>
    <div id="wrapper">
        
        <!-- Navigation -->
        <?php include('includes/navigation.php') ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading --> 
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome
                            <small>Admin</small>
                        </h1>
                        <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
       <label for="title">Firstname</label>
       <input type="text" name="user_firstname" class="form-control" value="<?php echo $user_firstname?>">
    </div>
    <div class="form-group">
       <label for="title">Lastname</label>
       <input type="text" name="user_lastname" class="form-control" value="<?php echo $user_lastname?>">
    </div>
    <div class="form-group">
         <select name="user_role" id="" class="mb-2">
         <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
         <?php 
            if($user_role == 'admin'){
               echo "<option value='editor'>Editor</option>";
            } 
            else{
               echo "<option value='admin'>Admin</option>";
            }
         ?>  
         </select>
    </div>
    
    <!-- <div class="form-group">
       <label for="post_status">Post Status</label>
       <input type="text" name="post_status" class="form-control">
    </div> -->
    <!-- <div class="form-group">
       <label for="post_image">Post Image</label>
      <input type="file" name="image">
    </div> -->
    <div class="form-group">
       <label for="post_image">Username</label>
      <input type="text" name="username" class="form-control" value="<?php echo $username?>">
    </div>
    <div class="form-group">
       <label for="post_content">Email</label>
       <input type="email" name="user_email" class="form-control" value="<?php echo $user_email?>">
    </div>
    <div class="form-group">
       <label for="post_content">Password</label>
       <input type="text" name="user_password" class="form-control" value="<?php echo $password?>">
    </div>

    <div class="form-group">
      <input type="submit" class="btn btn-primary" name="update_user" value="Update Profile">
    </div>
</form>
                    </div>
                    <!-- IN HERE NEED TO MAKE CONDITION -->
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
<?php include('includes/footer.php') ?>
    