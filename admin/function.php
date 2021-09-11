<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Forget Password
function ifItIsMethod($method=null){
    
    if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){
        return true;
    }
    return false;
} 

function isLoggedIn(){
    if(isset($_SESSION['userrole'])){
        return true;
    }
    return false;
}

function checkIfUserIsLoggedInAndRedirect($redirectLocation = null){
    if(isLoggedIn()){
        redirect($redirectLocation);
    }
}
function email_exists($email){
    global $connection;

    $sql = "SELECT user_email FROM users WHERE user_email = :checkmail";
    $query = $connection->prepare($sql);
    $query->bindParam(':checkmail',$email,PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0){
            return true;
    }
    else{
        return false;
    }

}
//Forget Password


function findAllCategories(){
    global $connection;
    $sql = "SELECT * FROM categories";
    $query = $connection->prepare($sql);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount()>0){
        foreach($result as $row){
            echo "<tr>";
            echo "<td>$row->cat_id</td>";
            echo "<td>$row->cat_title</td>";
            echo "<td>
                    <a class='btn btn-success' href='categories.php?edit=$row->cat_id'>Edit </a>
                    <a class='btn btn-danger' href='categories.php?delete=$row->cat_id'>Delete</a>
                </td>";
            echo "</tr>";
        }
    }
}   
function insertCategories(){
    global $connection;
    if(isset($_POST['submit_categories'])){
        $cat_title = $_POST['cat_title'];
        if($cat_title == "" || empty($cat_title)){
            echo "This Field is Empty";
        }
        else{
            $sql = "INSERT INTO categories(cat_title) VALUE (:cattitle)";
            $query = $connection->prepare($sql);
            $query->bindParam(':cattitle',$cat_title,PDO::PARAM_STR);
            $query->execute();
            header("Location: categories.php");
        }
    }
}
function deleteCategories(){
    global $connection;
    if(isset($_GET['delete'])){
        $the_cat_id = $_GET['delete'];
        $sql = "DELETE FROM categories WHERE cat_id = :catid";
        $query = $connection->prepare($sql);
        $query->bindParam(':catid',$the_cat_id,PDO::PARAM_STR);
        $query->execute();
        header("Location: categories.php");
    }
}
function displayInNav(){
    global $connection;
    $sql = "SELECT * FROM categories";
    $query = $connection->prepare($sql);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount()>0){
        foreach($result as $row){
            echo "<li><a href='categorypage.php?category=$row->cat_id'>$row->cat_title</a></li>";
        }
    }
}
function viewAllPost(){
    global $connection;
    global $count;
    global $page;
    $per_page = 10;
    if(isset($_GET['page'])){ 
        $page = $_GET['page'];
    }else{
        $page = "";
        // header("Location: posts.php");
    }
    if($page == "" || $page == 1){
        $page_1 = 0;
    }else{
        $page_1 = ($page * $per_page) - $per_page;
    }

    $select_post_count_sql = "SELECT * FROM posts";
    $select_post_count_query = $connection->prepare($select_post_count_sql);
    $select_post_count_query->execute();
    $count = $select_post_count_query->rowCount();
    
    $count = ceil($count / $per_page);
    
    

    $sql = "SELECT * FROM posts ORDER BY post_id DESC LIMIT $page_1,$per_page";
    $query = $connection->prepare($sql);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount()>0){
        foreach($result as $row){ 
            echo "<tr>"
            ?> 
            <td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value='<?php echo $row->post_id ?>' /></td>
            <?php 
            echo "<td>$row->post_id</td>";
            $query_category = "SELECT * FROM categories WHERE cat_id =:postcategoryid";
            $ready = $connection->prepare($query_category);
            $ready-> bindParam(':postcategoryid',$row->post_category_id,PDO::PARAM_INT);
            $ready->execute();
            $finalresult = $ready->fetchAll(PDO::FETCH_OBJ);
            if($ready->rowCount()>0){
                foreach($finalresult as $asnwer){
                    echo "<td>$asnwer->cat_title</td>";
                } 
            }
            echo "<td>$row->post_title</td>";
            // echo "<td>$row->post_status</td>";
            echo "<td><img src='../img/$row->post_img' alt='image' style='object-fit: cover;height: 50px;'></td>";
            echo "<td>$row->post_date</td>";
            // echo "<td><a href='../post.php?p_id={$row->post_id}'>View</a></td>";
            echo "<td>
                    <a href='posts.php?source=edit_post.php&p_id={$row->post_id}' class='btn btn-info'>Edit</a>
                    <a onClick=\"javascript: return confirm('Are You Sure You Want To Delete'); \" href='posts.php?delete={$row->post_id}' class='btn btn-danger'>Delete</a>
                    
                </td>"; 
            echo "<td><a href='posts.php?reset={$row->post_id}'>{$row->post_views_count}</a></td>";
            echo "</tr>";
        }
    } 
}
function deletePosts(){
    global $connection;
    if(isset($_GET['delete'])){
        $the_post_id = $_GET['delete'];
        $sql = "DELETE FROM posts WHERE post_id = :postid";
        $query =$connection->prepare($sql);
        $query->bindParam(':postid',$the_post_id,PDO::PARAM_INT);
        $query->execute();
        header("Location: posts.php");
    }   
} 
function resetPostViews(){
    global $connection;
    if(isset($_GET['reset'])){
        $the_post_id = $_GET['reset'];
        $post_update = '0';
        $sql = "UPDATE posts SET post_views_count = :postviewscount WHERE post_id = :postid";
        $query =$connection->prepare($sql);
        $query->bindParam(':postid',$the_post_id,PDO::PARAM_INT);
        $query->bindParam(':postviewscount',$post_update,PDO::PARAM_INT);
        $query->execute();
        header("Location: posts.php");
    }   
} 
function updatePosts(){
    global $connection;
    if(isset($_GET['p_id'])){
        $post_id = $_GET['p_id'];
    }
    if(isset($_POST['update_post'])){
        $post_title = $_POST['post_title'];
        $slug = slug($post_title);
        $post_description = $_POST['post_description'];
        $minimum_requirement = $_POST['requirement_description_one'];
        $recommended_requirement = $_POST['requirement_description_two'];
        $release_date = $_POST['releasedate'];
        $age_rating = $_POST['agerating'];
        $game_mode = $_POST['gamemode'];
        $price = $_POST['price'];
        $post_status = $_POST['post_status'];
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        move_uploaded_file($post_image_temp,"../img/$post_image");
        // $post_date = now();
    
        if(empty($post_image)){
            $sql = "SELECT * FROM posts WHERE post_id =:postid";
            $query = $connection->prepare($sql);
            $query->bindParam(':postid',$post_id,PDO::PARAM_INT);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_OBJ);
            if($query->rowCount()>0){
                foreach($result as $row){
                    $post_image = $row->post_img;
                }
            }
        }
        $update_sql = "UPDATE posts SET post_title = :posttitle, 
                                        slug = :slug,
                                        post_status = :poststatus, 
                                        post_description = :postdescription, 
                                        requirement_description_one = :requirement_description_one,
                                        requirement_description_two = :requirement_description_two,
                                        post_img = :postimg, 
                                        price = :price,
                                        releasegame_date = :releasedate,
                                        gamerage_rating = :rating,
                                        game_mode = :mode
                                        WHERE 
                                        post_id =:postid";
        $update_query = $connection->prepare($update_sql);
        $update_query->bindParam(':posttitle',$post_title,PDO::PARAM_STR);
        $update_query->bindParam(':slug',$slug,PDO::PARAM_STR);
        $update_query->bindParam(':poststatus',$post_status,PDO::PARAM_STR);
        $update_query->bindParam(':postdescription',$post_description,PDO::PARAM_STR);
        $update_query->bindParam(':requirement_description_one',$minimum_requirement,PDO::PARAM_STR);
        $update_query->bindParam(':requirement_description_two',$recommended_requirement,PDO::PARAM_STR);
        $update_query->bindParam(':postimg',$post_image,PDO::PARAM_STR);
        $update_query->bindParam(':price',$price,PDO::PARAM_STR);
        $update_query->bindParam(':releasedate',$release_date,PDO::PARAM_STR);
        $update_query->bindParam(':rating',$age_rating,PDO::PARAM_STR);
        $update_query->bindParam(':mode',$game_mode,PDO::PARAM_STR);
        $update_query->bindParam(':postid',$post_id,PDO::PARAM_STR);
        $update_query->execute();
        print_r($update_query->errorInfo());

            $sql = "DELETE FROM game_category WHERE game_id = :gameid";
            $query = $connection->prepare($sql);
            $query->bindParam(':gameid',$post_id,PDO::PARAM_INT);
            $value = $query->execute();

            if($value) {

                $post_category = $_POST['post_category'];

                foreach ($post_category as $category) {
        
                    $sql = "INSERT INTO game_category(game_id,category_id) VALUE (:gameid,:categoryid)";
                    $query = $connection->prepare($sql);
                    $query->bindParam(':gameid',$post_id,PDO::PARAM_STR);
                    $query->bindParam(':categoryid',$category,PDO::PARAM_STR);
                    $query->execute();
                    print_r($query->errorInfo());
                }
        
                header("Refresh:0");
            }
    }
}

function slug($string){
    $slug = trim($string); // trim the string
    $slug= preg_replace('/[^a-zA-Z0-9 -]/','',$slug ); 
    $slug= str_replace(' ','-', $slug); // replace spaces by dashes
    $slug= strtolower($slug);  // make it lowercase
    return $slug;
}


function buldOptions(){
    global $connection;
    if(isset($_POST['checkBoxArray'])){
        foreach($_POST['checkBoxArray'] as $postValueId){
           $bulk_options = $_POST['bulk_options'];
              switch($bulk_options){
                case 'published':
                  $sql = "UPDATE posts SET post_status = :bulkoptions WHERE post_id = :postvalueid";
                  $query = $connection->prepare($sql);
                  $query->bindParam(':bulkoptions',$bulk_options,PDO::PARAM_STR);
                  $query->bindParam(':postvalueid',$postValueId,PDO::PARAM_INT);
                  $query->execute();
                break;
    
                case 'draft':
                  $sql = "UPDATE posts SET post_status = :bulkoptions WHERE post_id = :postvalueid";
                  $query = $connection->prepare($sql);
                  $query->bindParam(':bulkoptions',$bulk_options,PDO::PARAM_STR);
                  $query->bindParam(':postvalueid',$postValueId,PDO::PARAM_INT);
                  $query->execute();
                break;

                case 'clone':
                    $sql = "SELECT * FROM posts WHERE post_id = :postvalueid";
                    $query = $connection->prepare($sql);
                    $query->bindParam(':postvalueid',$postValueId,PDO::PARAM_STR);
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_OBJ);
                    if($query->rowCount()>0){
                        foreach($result as $row){
                            $postcategoryid  = $row->post_category_id;
                            $posttitle       = $row->post_title;
                            $poststatus      = $row->post_status;
                            $postdescription = $row->post_description;
                            $postimg         = $row->post_img;
                            $posttag         = $row->post_tags;
                            $postdate        = $row->post_date;
                        }
                    }
                    $sqlinsertclone = "INSERT INTO posts(post_category_id,post_title,post_status,post_description,post_img,post_tags,post_date) VALUE(:postcategoryid,:ptitle,:poststatus,:pdescription,:pimage,:posttags,:postdate)";
                    $queryclone = $connection->prepare($sqlinsertclone);
                    $queryclone->bindParam(':postcategoryid',$postcategoryid,PDO::PARAM_STR);
                    $queryclone->bindParam(':ptitle',$posttitle,PDO::PARAM_STR);
                    $queryclone->bindParam(':pdescription',$postdescription,PDO::PARAM_STR);
                    $queryclone->bindParam(':pimage',$postimg,PDO::PARAM_STR);
                    $queryclone->bindParam(':posttags',$posttag,PDO::PARAM_STR);
                    $queryclone->bindParam(':postdate',$postdate,PDO::PARAM_STR);
                    $queryclone->bindParam(':poststatus',$poststatus,PDO::PARAM_STR);
                    $queryclone->execute();
                break;

                case 'delete':
                  $sql = "DELETE FROM posts WHERE post_id = :postvalueid";
                  $query = $connection->prepare($sql);
                  $query->bindParam(':postvalueid',$postValueId,PDO::PARAM_INT);
                  $query->execute();
                break;
              }
        }
      }
}

function registerUser(){
    global $connection;
    global $message;
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $email    = $_POST['email'];
        $password = $_POST['password'];
        $userrole = 'editor';
        if(!empty($username) && !empty($email) && !empty($password)){
            $sql = "SELECT randSalt FROM users";
            $query_randSalt = $connection->prepare($sql);
            $query_randSalt->execute();
            $result = $query_randSalt->fetch(PDO::FETCH_ASSOC);
            $salt = $result['randSalt'];  
            $password = crypt($password,$salt);
            
            $sql_register = "INSERT INTO users(username,user_password,user_email,user_role) 
            VALUE(:username,:userpassword,:useremail,:userrole)";
            $query_registration = $connection->prepare($sql_register);
            $query_registration->bindParam(':username',$username,PDO::PARAM_STR);
            $query_registration->bindParam(':userpassword',$password,PDO::PARAM_STR);
            $query_registration->bindParam(':useremail',$email,PDO::PARAM_STR);
            $query_registration->bindParam(':userrole',$userrole,PDO::PARAM_STR);
            $query_registration->execute();   

            $message = "Your Registration has been submitted";
        }else{
            $message = "Fields cannot be empty";
        }  
    }else{
        $message ="";
    }
}

function usersOnline(){
    global $connection;
    if(isset($_GET['onlineusers'])){
        if(!$connection){
            session_start();
            include("includes/db.php");
            $session = session_id();
            $time = time();
            $time_out_in_seconds = 30;
            $time_out = $time - $time_out_in_seconds; 

            $useronline_sql = "SELECT * FROM users_online WHERE session = :session";
            $useronline_query = $connection->prepare($useronline_sql);
            $useronline_query->bindParam(':session',$session,PDO::PARAM_STR);
            $useronline_query->execute();
            $countusers = $useronline_query->rowCount();

            // $useronline_sql = "SELECT * FROM users_online WHERE session = :session";
            // $useronline_query = $connection->prepare($useronline_sql);
            // $useronline_query->execute();
            // $countusers = $useronline_query->rowCount();
            // echo $countusers; 
    
            if($countusers == NULL){ 
                $addonlineusers_sql = "INSERT INTO users_online(session,time) VALUES (:usersession,:usertime)"; 
                $addonlineusers_query = $connection->prepare($addonlineusers_sql);
                $addonlineusers_query->bindParam(':usersession',$session,PDO::PARAM_STR);
                $addonlineusers_query->bindParam(':usertime',$time,PDO::PARAM_STR);
                $addonlineusers_query->execute();
            }
            else{
                $olduser_sql ="UPDATE users_online SET time =:oldusertime WHERE session = :oldusersession";
                $olduser_query = $connection->prepare($olduser_sql);
                $olduser_query -> bindParam(':oldusersession',$session,PDO::PARAM_STR);
                $olduser_query -> bindParam(':oldusertime',$time,PDO::PARAM_STR);
                $olduser_query->execute();
            } 
            $useronline_count_sql = "SELECT * FROM users_online WHERE time > :usertime";
            $useronline_count_query = $connection->prepare($useronline_count_sql);
            $useronline_count_query->bindParam(':usertime',$time_out,PDO::PARAM_STR);
            $useronline_count_query->execute();
            echo $count_user = $useronline_count_query->rowCount(); 
        }
    }
}
?>
