            if (isset($_POST['test'])) {
# code...
              ?>
              <div class="well" style="background-color: #faf8f7;">
                <center>
                  <?php
                  include("config.php");
                  $seachId=$_POST['id'];
// $searchId=preg_replace("#[^0-9a-z]#i", "", $searchIdd);
//  echo " id is". $seachId;
                  $query=("SELECT * FROM abs WHERE textID='$seachId' LIMIT 1");
                  $result = mysqli_query($conn,$query) or die("Failed: ".mysqli_error($conn));
                  while($all_video=mysqli_fetch_array($result))
                  {
                    ?>
                    <object width="100%">
                      <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="upload/<?php echo $all_video['fileName']; ?>" autoplay="autoplay" type="video/mp4" allowfullscreen ></iframe>
                      </div>
                    </object>
                    <div class="panel" style="background-color: #ffb460">
                      <i style="float: left;display: inline-block;"> 
                        <form action="" method="">
                          <?php //if($row=mysqli_fetch_assoc($res)){?>
                            <div class=" d-inline p-2"  >
                              <a href="javascript:void(0)" class="btn btn-info btn-xs">
                                <span class="glyphicon glyphicon-thumbs-up" onclick="like_update('<?php echo $all_video['textID']?>')"> (<span id="like_loop_<?php echo $all_video['textID']?>"><?php echo $all_video['likes']?></span>)</span>
                              </a> 
                              <a href="javascript:void(0)" class="btn btn-info btn-xs">
                                <span class="glyphicon glyphicon-thumbs-down" onclick="dislike_update('<?php echo $all_video['textID']?>')"> (<span id="dislike_loop_<?php echo $all_video['textID']?>"><?php echo $all_video['dislikes']?></span>)</span>
                              </a>
                              <a href="javascript:void(0)" class="btn btn-info btn-xs">
                                <span class="glyphicon glyphicon-eye-open"> (<span id="like_loop_<?php echo $all_video['textID']?>"><?php echo $all_video['views']?></span>)</span>
                              </a>
                            </div>
                            <?php// }?>
                          </form>
                        </i>
                        <i style="float: right;">
                          <?php echo $all_video['fileName']." ~". $all_video['artist'];?> 
                        </i>
                      </div>
                      <?php
                      $list=$all_video['album'];
                      $selected=$all_video['textID'];
                    
                    ?>
                  </center>
                </div>
                <div class="panel">up next</div>
                <?php
                include('upNext.php');
              }
          