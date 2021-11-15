<?php buldOptions() ?>
<form action="" method="post">
<div class="col-md-12">
<table class="table table-bordered table-hover">
  <thead>
    <tr>   
      <th>Id</th>
      <th>Emails</th> 
    </tr>
  </thead>
  <tbody>
    <?php viewAllSubs(); ?>
  </tbody>
</table>
</div>
</form>
<ul class="pager">
  <?php 
    for($i = 1; $i <= $count; $i++){
      if($i == $page){
        echo "<li><a class='active_link' href='posts.php?page={$i}'>{$i}</a></li>";
      }
      else{
        echo "<li><a href='posts.php?page={$i}'>{$i}</a></li>";
      }
    } 
  ?>
</ul>
