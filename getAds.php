<?php
  // Include the database configuration file
  include 'config.php';
  // Get images from the database
  $query = $conn->query("SELECT * FROM ads  ");
  if($query->num_rows > 0){
      while($row = $query->fetch_assoc()){
          $imageURL = 'ads/'.$row["fileName"];
         // echo "<img src='ads/".$row['fileName']."' > style='width:100px'";
         
  ?>
  		<p>

      <img src="<?= $imageURL; ?>" style="width:100%" data-toggle="modal" data-target="#myModal" onload="view_updater('<?php echo $row['id']?>')" onclick="click_update('<?php echo $row['id']?>')" /></p>
  

<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title"> <?php echo $row['adName'];?></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <?php echo $row['description'];?>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<?php }} ?>
<script> 
	 function click_update(id){
                  jQuery.ajax({
                    url:'update_count.php',
                    type:'post',
                    data:'type=AddClick&id='+id,
                    success:function(result){
                      var cur_count=jQuery('#like_loop_'+id).html();
                      cur_count++;
                      jQuery('#like_loop_'+id).html(cur_count);
                    }
                  });
                } 

                 function view_updater(id){
                  jQuery.ajax({
                    url:'update_count.php',
                    type:'post',
                    data:'type=AdView&id='+id,
                    success:function(result){
                      var cur_count=jQuery('#like_loop_'+id).html();
                      cur_count++;
                      jQuery('#like_loop_'+id).html(cur_count);
                    }
                  });
                } 
            </script>