<form class="form-group"  method="POST">
	<div class="input-group">
		<input type="text"  class="form-control" placeholder="Search music..." name="searchMusic" required="required">
		<span class="input-group-btn">
			<button class="btn btn-default" type="submit" name="findMusic">
				<span class="glyphicon glyphicon-search"></span>
			</button>
		</span>
	</div>
</form>

<?php

include("config.php");

if(isset($_POST['findMusic']))
{
	include("config.php");
//   $name=$_SESSION['email'];
	$MusicRESULTSS=$_POST['searchMusic'];
	$MusicRESULTS=preg_replace("#[^0-9a-z]#i", " ", $MusicRESULTSS);
	$searchTxtmUSIC=metaphone($MusicRESULTS);

	$getMusic="SELECT * from music  where artist LIKE '%$MusicRESULTS%' OR genre like '%$MusicRESULTS%' OR trackName like '%$MusicRESULTS%' OR album like '%$MusicRESULTS%' OR description like '%$MusicRESULTS%' or phonicTxt like '%$searchTxtmUSIC%'";
	$rs1 = mysqli_query($conn,$getMusic) or die(mysqli_error($conn));
	while($Mrow = mysqli_fetch_assoc($rs1))
	{
// echo " ".$row['artist'];
		if($Mrow){
			?>
			<div class="col-sm-4">
				<div class="well" style="border-color: #ffb460; overflow: auto">
					<?php echo "<h6>".$Mrow['likes']." likes</h6>"?>
					<?php echo "<h6>".$Mrow['dislike']." dislikes</h6>"?>
					<?php echo "<h6>".$Mrow['views']." views</h6>"?>


					<img src="img/t2.jpg" style="width: 100%;"  >
					<?php echo "<h6>".$Mrow['trackName']." ~ ".$Mrow['artist']."</h6>";?>
					<form method="post">
						<input type="hidden" name="Mid" value="<?php echo $row['id']?>">
						<input type="submit" class="btn-warning" value="delete video"name="test" onclick="view_update('<?php echo $row['id']?>')">
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
	$getM="SELECT * from music  ";
	$rst = mysqli_query($conn,$getM) or die(mysqli_error($conn));
	while($rowM = mysqli_fetch_assoc($rst))
	{
		?>
		<div class="col-sm-4" >
			<div class="well" style="background-color: #ffb460;opacity: 100%;overflow: auto;">
				<?php echo "<h6>".$rowM['likes']." likes</h6>"?>
				<?php echo "<h6>".$rowM['dislike']." dislikes</h6>"?>
				<?php echo "<h6>".$rowM['views']." views</h6>"?>
				<img src="img/t5.jpg" style="width: 100%;"  >
				<?php echo "<h6>".$rowM['artist']." ~ ".$rowM['trackName']."</h6>"?>
				<form method="post">
					<input type="hidden" name="id" value="<?php echo $rowM['id']?>">
					<center><br>
						<input type="submit" class="btn-warning" value="watch video"name="test" onclick="view_update('<?php echo $rowM['id']?>')">
					</center>
				</form>

			</div>
		</div>
		<?php
	}
}
else{
	$queryM=("SELECT * FROM music ");
	$resultM = mysqli_query($conn,$queryM) or die("Failed: ".mysqli_error($conn));
	while($all_music=mysqli_fetch_array($resultM))
	{
		$list=$all_music['album'];

		?>
		<div class="col-sm-4" >
			<div class="well" style="background-color: #ffb460;opacity: 100%;overflow: auto;">
				<?php echo "<h6>".$all_music['likes']." likes</h6>"?>
				<?php echo "<h6>".$all_music['dislike']." dislikes</h6>"?>
				<?php echo "<h6>".$all_music['views']." views</h6>"?>
				<img src="img/t5.jpg" style="width: 100%;"  >
				<?php echo "<h6>".$all_music['artist']." ~ ".$all_music['trackName']."</h6>"?>
				<form method="post">
					<input type="hidden" name="id" value="<?php echo $all_music['id']?>">
					<center><br>
						<input type="submit" class="btn-warning" value="delete video"name="test" onclick="view_update('<?php echo $all_music['id']?>')">
					</center>
				</form>

			</div>
		</div>
		<?php
	}
}
?>

