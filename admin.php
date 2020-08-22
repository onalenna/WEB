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
     /* Style the navbar */
#navbar {
  overflow: hidden;
  background-color: #333;
}

/* Navbar links */
#navbar a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px;
  text-decoration: none;
}

/* Page content */
.content {
  padding: 16px;
}

/* The sticky class is added to the navbar with JS when it reaches its scroll position */
.sticky {
  position: fixed;
  top: 0;
  width: 100%;
}

/* Add some top padding to the page content to prevent sudden quick movement (as the navigation bar gets a new position at the top of the page (position:fixed and top:0) */
.sticky + .content {
  padding-top: 60px;
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
          <a class="navbar-brand" href="web.php" style="color: #ffb460">Audio Brand Sessions</a>
        </div>
        <ul class="nav navbar-nav " >
          <li class="active"><a href="#">Home</a></li>
          <li><a href="#">About</a></li>
          <li><a href="#">Help</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <form class="navbar-form navbar-left" action="/action_page.php">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Abs tunes.." name="search">
            </div>
            <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
          </form>
        </ul>
      </div>
    </nav>
<div class="container">
<div class="col-sm-2" style="background-image: url('img/bg/Advert.jpeg');">
	<div class="list-group" >
            <a href="admin.php" class="list-group-item list-group-item-warning" >EXPLORE &nbsp;<span class="glyphicon glyphicon-search" style="color:transparent">.</span></a>
              <a href="web.php" class="list-group-item list-group-item-action list-group-item-warning">VIDEO &nbsp;<span class="glyphicon glyphicon-film"></span></a>
              <a href="music.php" class="list-group-item list-group-item-action list-group-item-warning">MUSIC &nbsp;<span class="glyphicon glyphicon-music"></span></a>
           <img src="img/bg/Advert.jpeg" width="100%" >
           <img src="img/bg/Headphones - Merch.jpeg" width="100%" >
          </div>
</div>
<div class="col-sm-10">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
    <li><a data-toggle="tab" href="#menu1">Add Video </a></li>
    <li><a data-toggle="tab" href="#menu2">Add Music </a></li>
    <li><a data-toggle="tab" href="#menu3">Add ads</a></li>
    <li><a data-toggle="tab" href="#menu5">Music reports</a></li>
    <li><a data-toggle="tab" href="#menu6">Ads reports</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <br>
      <form class="form-group"  method="POST">
                <div class="input-group">
                  <input type="text"  class="form-control" placeholder="Search videos..." name="searchString" required="required">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" name="findVideos">
                      <span class="glyphicon glyphicon-search"></span>
                    </button>
                  </span>
                </div>
              </form>
         
         <?php

         include("config.php");

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
                        <?php echo "<h6>".$row['likes']." likes</h6>"?>
                        <?php echo "<h6>".$row['dislikes']." dislikes</h6>"?>
                          <?php echo "<h6>".$row['views']." views</h6>"?>


                        <img src="img/t2.jpg" style="width: 100%;"  >
                        <?php echo "<h6>".$row['fileName']." ~ ".$row['artist']."</h6>";?>
                        <form method="post">
                          <input type="hidden" name="id" value="<?php echo $row['textID']?>">
                          <input type="submit" class="btn-warning" value="delete video"name="test" onclick="view_update('<?php echo $row['textID']?>')">
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
                      <?php echo "<h6>".$row['likes']." likes</h6>"?>
                        <?php echo "<h6>".$row['dislikes']." dislikes</h6>"?>
                          <?php echo "<h6>".$row['views']." views</h6>"?>
                      <img src="img/t5.jpg" style="width: 100%;"  >
                      <?php echo "<h6>".$row['artist']." ~ ".$row['fileName']."</h6>"?>
                      <form method="post">
                        <input type="hidden" name="id" value="<?php echo $row['textID']?>">
                        <center><br>
                          <input type="submit" class="btn-warning" value="watch video"name="test" onclick="view_update('<?php echo $row['textID']?>')">
                        </center>
                      </form>

                    </div>
                  </div>
                  <?php
                }
              }
         else{
                $query1=("SELECT * FROM abs ");
                $result1 = mysqli_query($conn,$query1) or die("Failed: ".mysqli_error($conn));
                while($all_video=mysqli_fetch_array($result1))
                {
                  $list=$all_video['album'];

                  ?>
                  <div class="col-sm-4" >
                    <div class="well" style="background-color: #ffb460;opacity: 100%;overflow: auto;">
                      <?php echo "<h6>".$all_video['likes']." likes</h6>"?>
                        <?php echo "<h6>".$all_video['dislikes']." dislikes</h6>"?>
                          <?php echo "<h6>".$all_video['views']." views</h6>"?>
                      <img src="img/t5.jpg" style="width: 100%;"  >
                      <?php echo "<h6>".$all_video['artist']." ~ ".$all_video['fileName']."</h6>"?>
                      <form method="post">
                        <input type="hidden" name="id" value="<?php echo $all_video['textID']?>">
                        <center><br>
                          <input type="submit" class="btn-warning" value="delete video"name="test" onclick="view_update('<?php echo $all_video['textID']?>')">
                        </center>
                      </form>

                    </div>
                  </div>
                  <?php
                }
              }
                ?>




    </div>
    <div id="menu1" class="tab-pane fade">
      <h3>Add Videos</h3>
      <p> 
        <?php 
    include('addVideo.php')
     

?>
    <form method="POST"  enctype="multipart/form-data">
  <div class="form-group">
    <label for="album">Album files:</label>
    <input type="file" name="fileUpload[]" class="form-control"  id="chooseFile" multiple>
  </div>
  <div class="form-group">
    <label for="artist">Artist:</label>
    <input type="text" class="form-control" placeholder="Artist" name="artist" >
  </div>
  <div class="form-group">
    <label for="text">Album Name:</label>
    <input type="text" class="form-control" placeholder="Album Name" name="album">
  </div>
  <div class="form-group">
    <label for="text">Genre:</label>
    <select id="genre" name="genre"class="form-control" >
    <option value="hip hop">Hip Hop</option>
    <option value="rap">Rap</option>
    <option value="trap">Trap</option>
    <option value="country">Country</option>
    <option value="rock">Rock</option>
    <option value="jazz">Jazz</option>
    <option value="traditional">Traditional</option>
    <option value="other">Other</option>

  </select>
  </div>
  
  <button type="submit" class="btn btn-primary" name="addVid">Submit</button>
</form> </p>
    </div>
    <div id="menu2" class="tab-pane fade">
      <h3>Add Music</h3>

              <?php 
    include('addMusic.php')
?>
      <p><form method="POST"  enctype="multipart/form-data">
  <div class="form-group">
    <label for="album">Album files:</label>
    <input type="file" name="fileUpload[]" class="form-control" placeholder="Enter email" id="email" multiple>
  </div>
  <div class="form-group">
    <label for="artist">Artist:</label>
    <input type="text" class="form-control" placeholder="Artist" name="artist" >
  </div>
  <div class="form-group">
    <label for="text">Album Name:</label>
    <input type="text" class="form-control" placeholder="Album Name" name="album">
  </div>
  <div class="form-group">
    <label for="text">Genre:</label>
    <select id="genre" name="genre"class="form-control" >
    <option value="hip hop">Hip Hop</option>
    <option value="rap">Rap</option>
    <option value="trap">Trap</option>
    <option value="country">Country</option>
    <option value="rock">Rock</option>
    <option value="jazz">Jazz</option>
    <option value="traditional">Traditional</option>
    <option value="other">Other</option>

  </select>
  </div>
  
  <button type="submit" class="btn btn-primary" name="addTrack">Submit</button>
</form> </p>
    </div>
    <div id="menu3" class="tab-pane fade">
      <h3>Add adverts</h3>
      <p> 
      	<?php
      	include('addAds.php');
?>
    <form method="POST"  enctype="multipart/form-data">
  <div class="form-group">
    <label for="album">Image files:</label>
    <input type="file" name="fileUpload[]" class="form-control"  id="chooseFile" multiple>
  </div>
  <div class="form-group">
    <label for="text">Advert Name:</label>
    <input type="text" class="form-control" placeholder="ad name" name="adName">
  </div>
  <div class="form-group">
    <label for="artist">Description:</label>
    <textarea class="form-control" placeholder="what users should see" name="desc" ></textarea>
  </div>
  <div class="form-group">
    <label for="text">Advert duration(days):</label>
    <input type="number" class="form-control" placeholder="11" name="days">
  </div>
  
  
  
  <button type="submit" class="btn btn-primary" name="addAds">Submit</button>
</form>.</p>
    </div>

    <div id="menu5" class="tab-pane fade">
      <h3>Music reports</h3>
      <p><?php include('getMusicAdmin.php');?>.</p>
    </div>
    <div id="menu6" class="tab-pane fade">
      <h3>Advert reports</h3>
      <p><?php include('getM.php');?></p>
    </div>
  </div>
</div>
</div>

</body>
</html>
