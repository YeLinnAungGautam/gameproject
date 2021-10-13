<table class="table table-bordered table-hover">
                           <thead>
                               <tr>
                                   <th>ID</th>
                                   <th>Username</th>
                                   <th>Firstname</th>
                                   <th>Lastname</th>
                                   <th>Email</th>
                                   <th>Role</th>
                               </tr>
                           </thead> 
                           <tbody>  
                           <?php 
                                $sql ="SELECT * FROM users";
                                $query = $connection->prepare($sql);
                                $query->execute();
                                $result = $query->fetchAll(PDO::FETCH_OBJ);
                                if($query ->rowCount()>0){
                                    foreach($result as $row){
                                 echo "<tr>";
                                 echo "<td>$row->user_id</td>"; 
                                 echo "<td>$row->username</td>";
                                 echo "<td>$row->user_firstname</td>";
                                 echo "<td>$row->user_lastname</td>";
                                 echo "<td>$row->user_email</td>";
                                 echo "<td>$row->user_role</td>";
                             echo "<td><a href='user.php?change_to_admin={$row->user_id}'>Admin</a></td>";
                             echo "<td><a href='user.php?change_to_editor={$row->user_id}'>Editor</a></td>";
                                 echo "<td>Edit</td>";
                                 echo "<td><a href='user.php?delete_user={$row->user_id}'>Delete</a></td>";
                                    }
                                }
                                ?>
                           </tbody> 
                       </table>
                       <?php  
                            if(isset($_GET['change_to_admin'])){
                                $change_role = 'admin';
                                $the_user_id = $_GET['change_to_admin'];
                                $sql = "UPDATE users set user_role =:user_role WHERE user_id =:the_user_id";
                                $query = $connection->prepare($sql);
                                $query ->bindParam(':the_user_id',$the_user_id,PDO::PARAM_INT);
                                $query ->bindParam(':user_role', $change_role,PDO::PARAM_STR);
                                $query ->execute();
                                header("Location: user.php");
                            }
                            if(isset($_GET['change_to_editor'])){
                                $change_editor_role = 'editor';
                                $the_user_id = $_GET['change_to_editor'];
                                $sql = "UPDATE users set user_role =:user_role WHERE user_id = :the_user_id";
                                $query = $connection->prepare($sql);
                                $query ->bindParam(':the_user_id',$the_user_id,PDO::PARAM_INT);
                                $query ->bindParam(':user_role',$change_editor_role,PDO::PARAM_STR);
                                $query ->execute();
                                header("Location: user.php");
                            }
                            if(isset($_GET['delete_user'])){
                                $the_user_id = $_GET['delete_user'];
                                $sql = "DELETE FROM users WHERE user_id = :the_user_id";
                                $query = $connection->prepare($sql);
                                $query ->bindParam(':the_user_id', $the_user_id,PDO::PARAM_INT);
                                $query ->execute();
                                header("Location: user.php"); 
                            }
                       ?>