<?php include("dashboard/includes/db.php") ?>
<?php  
    global $keywords;
    if(isset($_POST['query'])){
        $keywords = $_POST['query']; 
    }
    $searchsql ="SELECT * FROM posts WHERE post_title LIKE :keywords";
    $searchquery = $connection->prepare($searchsql);
    $searchquery->bindValue(':keywords','%' . $keywords . '%',PDO::PARAM_STR);
    $searchquery->execute(); 
    $all_member_data = array();
    if($searchquery->rowCount() > 0)
    {
        while($result = $searchquery->fetch(PDO::FETCH_ASSOC))
        {
            $all_member_data[] = $result['post_title'];
        }
        echo json_encode($all_member_data);
    }
?>
