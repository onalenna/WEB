<?php
  // Include the database configuration file
  include 'config.php';
  // Get images from the database
  //$query = $conn->query("SELECT * FROM ads  ");
  //if($query->num_rows > 0){
   //   while($row = $query->fetch_assoc()){
      //    $imageURL = 'ads/'.$row["fileName"];
         // echo "<img src='ads/".$row['fileName']."' > style='width:100px'";
  $querry = ("SELECT * FROM ads ");
  $res=mysqli_query($conn,$querry);
  while ($row=mysqli_fetch_array($res)) {
  	# code...
  $imageURL = 'ads/'.$row["fileName"];
  
  
         
  ?>
 <div class="col-sm-4" style="border-left:1">
 	<div class="well" style="background-color: #ffb460;opacity: 100%;overflow: auto;">
<?php
echo "<br> Ad name: ".$row['adName']."<br>";
  

?>
      <img src="<?= $imageURL; ?>" style="width:100%" data-toggle="modal" data-target="#myModal"  />
  

  <?php
echo "<br> Ad description: ".$row['description']."<br>";
   echo "Views : ".$row['appearances']."<br>";
        echo "Clicks : ".$row['clicks']."<br>";

  ?>

</div>
</div>
<?php } ?>
