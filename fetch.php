<?php

$db_connect = mysqli_connect("localhost", "root", "", "gameproject");
$request = mysqli_real_escape_string($db_connect, $_POST["query"]);
$query = "SELECT * FROM posts WHERE post_title LIKE '%".$request."%'";

$result = mysqli_query($db_connect, $query);

$all_member_data = array();

if(mysqli_num_rows($result) > 0)
{
 while($row = mysqli_fetch_assoc($result))
 {
  $all_member_data[] = $row["post_title"];
 }
 echo json_encode($all_member_data); 
} 
?>