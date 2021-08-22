<?php buldOptions() ?>
<form action="" method="post">
<div class="col-md-12 mb-3" style="margin-bottom:1%;">
    <div id="bulkOptionContainer" class="col-xs-4" style="padding-left: 0px;">
      <select class="form-control" name="bulk_options" id="">
        <option value="">Select Options</option>
        <option value="published">Publish</option>
        <option value="draft">Draft</option>
        <option value="clone">Clone</option>
        <option value="delete">Delete</option>
      </select>
    </div>
    <div class="col-xs-4">
      <input type="submit" name="submit" class="btn btn-success" value="Apply">
      <a href="posts.php?source=add_post.php" class="btn btn-primary">Add New</a>
    </div>
</div>
<div class="col-md-12">
<table class="table table-bordered table-hover">
  <thead>
    <tr>   
      <th><input type="checkbox" id="selectAllBoxes"></th>
      <th>ID</th>
      <th>Title</th> 
      <th>Image</th>
      <th>Created Date</th>
      <th>Actions</th>
                      
    </tr>
  </thead>
  <tbody>
    <?php viewAllPost(); ?>
    <?php deletePosts(); ?>
    <?php resetPostViews() ?>
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
