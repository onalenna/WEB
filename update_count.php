<?php
$con=mysqli_connect('localhost','root','','abs');
$type=$_POST['type'];
$id=$_POST['id'];
if($type=='like'){
	$sql="update abs set likes=likes+1 where textID=$id";
}

if($type=='view'){
	$sql="update abs set views=views+1 where textID=$id";
}

if($type=='dislike'){
	$sql="update abs set dislikes=dislikes+1 where textID=$id";
}

if($type=='like1'){
	$sql="update music set likes=likes+1 where id=$id";
}

if($type=='view1'){
	$sql="update music set views=views+1 where id=$id";
}

if($type=='dislike1'){
	$sql="update music set dislike=dislike+1 where id=$id";
}
if($type=='AddClick'){
	$sql="update ads set clicks=clicks+1 where id=$id";
}
if($type=='AdView'){
	$sql="update ads set appearances=appearances+1 where id=$id";
}
$res=mysqli_query($con,$sql);
?>
