
<!DOCTYPE html>
<html lang="en">
<head>
  <title>ABS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    .footer {
      position: fixed;
      left: 0;
      bottom: 0;
      width: 100%;
      background-color:  #122A0A;
      color: white;
      text-align: center;
    }
  </style>

  <link rel="apple-touch-icon" sizes="180x180" href="img/fav/icon_4.png">
  <link rel="icon" type="image/png" sizes="32x32" href="img/fav/icon_4.png">
  <link rel="icon" type="image/png" sizes="16x16" href="img/fav/icon_4.png">
  <link rel="manifest" href="/site.webmanifest">
</head>
<body style=" background: linear-gradient(to bottom, #f8fafb 0%, #fafcfd 100%);">
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="web.php" style="color: #ffb460;">Audio Brand Sessions</a>
        </div>
        <ul class="nav navbar-nav " >
          <li class="active"><a href="web.php">Home</a></li>
          <li><a href="#">About</a></li>
          <li><a href="#">Help</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <form class="navbar-form navbar-left" method="POST">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Abs tunes.." name="search">
            </div>
            <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" name="music"></span></button>
          </form>
        </ul>
      </div>
    </nav>


    <div class="container" style="width: 100%; overflow-x: auto" >
      <div class="rw">
        <div class="col-sm-2" style="background-image: url('img/bg/Advert.jpeg');">
          <form class="form-group">
            <center>
              <!-- <input type="text" name="" class="form-control" disabled="disabled" placeholder=" OPTIONS " style="background-color: #de392b"> -->
              <img src="img/logo_default.png" style="width: 79%;padding: 15%;opacity: 160%;">
            </center>
          </form>
          <div class="list-group" >
            <a href="web.php" class="list-group-item list-group-item-warning" >EXPLORE &nbsp;<span class="glyphicon glyphicon-search" style="color:transparent">.</span></a>
              <a href="music.php" class="list-group-item list-group-item-action list-group-item-warning">MUSIC &nbsp;<span class="glyphicon glyphicon-music"></span></a>
           <img src="img/bg/Advert.jpeg" width="100%">
          </div>

            </div>
            <div class="col-sm-8">
              <form class="form-group"  method="POST">
                <div class="input-group">
                  <input type="text"  class="form-control" placeholder="Search videos..." name="searchString" required="required" autocomplete="off">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" name="findVideos">
                      <span class="glyphicon glyphicon-search"></span>
                    </button>
                  </span>
                </div>
              </form>
              <div id="output">
              </div>
            </div>
          </div>
          <div class="col-sm-2" >
          </div>
          <div class="col-sm-8"style="background-color: ">
            <?php
            
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
              }
          }

              if(isset($_POST['findVideos']))
              {
                include("config.php");
//   $name=$_SESSION['email'];
                $searchString1=$_POST['searchString'];
                $searchString=preg_replace("#[^0-9a-z]#i", " ", $searchString1);
                $searchTxt=metaphone($searchString);

                $getThumb="SELECT * from abs  where artist LIKE '%$searchString%' OR genre like '%$searchString%' OR fileName like '%$searchString%' OR album like '%$searchString%' OR description like '%$searchString%' or phonicTxt like '%$searchTxt%'";
                $rs = mysqli_query($conn,$getThumb) or die(mysqli_error($conn));
                while($row = mysqli_fetch_assoc($rs))
                {
// echo " ".$row['artist'];
                  if($row){
                    ?>
                    <div class="col-sm-4">
                      <div class="well" style="border-color: #ffb460; overflow: auto">
                        <img src="img/t2.jpg" style="width: 100%;"  >
                        <?php echo "<h6>".$row['fileName']." ~ ".$row['artist']."</h6>";?>
                        <form method="post">
                          <input type="hidden" name="id" value="<?php echo $row['textID']?>">
                          <input type="submit" class="btn-success" value="watch video"name="test" onclick="view_update('<?php echo $row['textID']?>')">
                        </form>
                      </div>
                    </div> 
                    <?php
                  }
                  else{
                    echo "nothing found...";
                  }
                }
                include("config.php");
//   $name=$_SESSION['email'];
                $getThumb="SELECT * from abs  ORDER BY RAND() limit 8 offset 0";
                $rs = mysqli_query($conn,$getThumb) or die(mysqli_error($conn));
                while($row = mysqli_fetch_assoc($rs))
                {
                  ?>
                  <div class="col-sm-4" >
                    <div class="well" style="background-color: #ffb460;opacity: 100%;overflow: auto;">

                      <img src="img/t5.jpg" style="width: 100%;"  >
                      <?php echo "<h6>".$row['artist']." ~ ".$row['fileName']."</h6>"?>
                      <form method="post">
                        <input type="hidden" name="id" value="<?php echo $row['textID']?>">
                        <center><br>
                          <input type="submit" class="btn-success" value="watch video"name="test" onclick="view_update('<?php echo $row['textID']?>')">
                        </center>
                      </form>

                    </div>
                  </div>
                  <?php
                }
              }
              else 
              {
                //if (isset($_POST['test'])) {
# code...
//echo "end of playlist";
//echo nothing here
              //  }

              //  if (isset($_POST['music'])) {
                  # code...
               //   echo "string";
              //  }
               // else{
// echo "<br>random pics for you";
                  include("config.php");
//   $name=$_SESSION['email'];
                  $getThumb="SELECT * from abs  ORDER BY RAND() limit 8";
                  $rs = mysqli_query($conn,$getThumb) or die(mysqli_error($conn));
                  while($row = mysqli_fetch_assoc($rs))
                  {
                    ?>
                    <div class="col-sm-4">
                      <div class="well" style="background-color: #ffb460;opacity: 100%;">
                        <img src="img/t5.jpg" style="width: 100%;"  >
                        <?php echo "<h6>".$row['fileName']." ~ ".$row['artist']."</h6>";?>
                        <form method="post">
                          <input type="hidden" name="id" value="<?php echo $row['textID']?>">
                          <input type="submit" class="btn-success" value="watch video"name="test" onclick="view_update('<?php echo $row['textID']?>')">
                        </form>
                      </div>
                    </div>
                    <?php
                  //}
                }
              }
              ?>
            </div>
            <div class="col-sm-2" style="height:100%;background-image: url('img/bg/dAdvert.jpeg');">
              
     
            	<?php include('getAds.php');?>
              </div>
            </div><br>
            <div class="well" style="background-color: #ffb460"><br></div>
            <div class="footer">
              <p >&copy 2020 Audio Brand Sessions</p>
            </div>
            <!-- The Modal -->
            <div class="modal" id="myModal">
              <div class="modal-dialog">
                <div class="modal-content">

                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">Modal Heading</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <!-- Modal body -->
                  <div class="modal-body">
                    Music
                  </div>
                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            <audio id="like">
              <source src="audio/like/like.mp3" type="audio/mpeg">
              </audio>
              <audio id="dislike">
                <source src="audio/dislike/dislk.mp3" type="audio/mpeg">
                </audio>
              </body>
              </html>
              <script>
                function like_update(id){
                  jQuery.ajax({
                    url:'update_count.php',
                    type:'post',
                    data:'type=like&id='+id,
                    success:function(result){
                      var cur_count=jQuery('#like_loop_'+id).html();
                      cur_count++;
                      jQuery('#like_loop_'+id).html(cur_count);
                      var x = document.getElementById("like");
                      x.play(); 
                    }
                  });
                } 
                function view_update(id){
                  jQuery.ajax({
                    url:'update_count.php',
                    type:'post',
                    data:'type=view&id='+id,
                    success:function(result){
                      var cur_count=jQuery('#like_loop_'+id).html();
                      cur_count++;
                      jQuery('#like_loop_'+id).html(cur_count);
                    }
                  });
                } 
                function dislike_update(id){
                  jQuery.ajax({
                    url:'update_count.php',
                    type:'post',
                    data:'type=dislike&id='+id,
                    success:function(result){
                      var cur_count=jQuery('#dislike_loop_'+id).html();
                      cur_count++;
                      jQuery('#dislike_loop_'+id).html(cur_count);
                      var x = document.getElementById("dislike");
                      x.play(); 
                    }
                  });
                } 
              </script>
