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
      <th>Category</th>
      <th>Title</th> 
      <th>Status</th>
      <th>Image</th>
      <th>Tags</th>
      <th>Date</th>
      <th>View</th>
      <th>Edit</th>
      <th>Delete</th>   
      <th>Views</th>                  
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
