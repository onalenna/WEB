<?php
$query1=("SELECT * FROM abs where album='$list' AND textID!='$seachId'");
                $result1 = mysqli_query($conn,$query1) or die("Failed: ".mysqli_error($conn));
                while($all_video=mysqli_fetch_array($result1))
                {
                  $list=$all_video['album'];

                  ?>
                  <div class="col-sm-4" style="background-color: transparent; overflow: auto;">
                    <img src="img/t6.jpg" style="width: 100%">
                    <?php echo "<h6>".$all_video['fileName']." ~ ".$all_video['artist']."</h6>";?>
                    <form method="post" >
                      <input type="hidden" name="id" value="<?php echo $all_video['textID']?>">
                      <input type="submit" class="btn-success" value="watch video"name="test" onclick="view_update('<?php echo $all_video['textID']?>')">
                    </form>
                  </div>
                  <?php
                }
                ?>