<?php //include("file-upload.php"); ?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

  <title>PHP 7 Upload Multiple Files Example</title>
  <style>
    .container {
      max-width: 450px;
    }
    .imgGallery img {
      padding: 8px;
      max-width: 100px;
    }    
  </style>
</head>

<body>

  <div class="container mt-5">
    <form action="" method="post" enctype="multipart/form-data" class="mb-3">
      <h3 class="text-center mb-5">Upload Multiple Images in PHP 7</h3>

      <div class="user-image mb-3 text-center">
        <div class="imgGallery"> 
          <!-- Image preview -->
        </div>
      </div>

      <div class="custom-file">
        <input type="file" name="fileUpload[]" class="custom-file-input" id="chooseFile" multiple>
        <label class="custom-file-label" for="chooseFile">Select file</label>
      </div>
      <label for="cars">Genre:</label>
  <select id="genre" name="genre">
    <option value="hip hop">Hip hop</option>
    <option value="rap">rap</option>
    <option value="trap">trap</option>
  </select>

  <div class="custom-file">
    <input type="text" name="album" placeholder="album">
        <input type="text" name="artist" placeholder="artist">

  </div>

      <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
        Upload Files
      </button>
    </form>

    <!-- Display response messages -->
    <?php if(!empty($response)) {?>
        <div class="alert <?php echo $response["status"]; ?>">
           <?php echo $response["message"]; ?>
        </div>
    <?php }?>
  </div>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

  <script>
    $(function() {
    // Multiple images preview with JavaScript
    var multiImgPreview = function(input, imgPreviewPlaceholder) {

        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

      $('#chooseFile').on('change', function() {
        multiImgPreview(this, 'div.imgGallery');
      });
    });    
  </script>

  



  <?php 
    // Database
     

    include 'config1.php'; 

    if(isset($_POST['submit'])){
      include('Config.php');

      $check="SELECT * FROM abs WHERE album='".$_POST['album']."'";
      $result = mysqli_query($conn,$check) or die("Failed: ".mysqli_error($conn));
        $row = mysqli_fetch_array($result);
        if ($row ) {

          echo"NAME TAKEN";
        }
        else{

        
        $uploadsDir = "upload/";
        $allowedFileType = array('jpg','png','jpeg','mp4','mp3');
        
        // Velidate if files exist
        if (!empty(array_filter($_FILES['fileUpload']['name']))) {
            
            // Loop through file items
            foreach($_FILES['fileUpload']['name'] as $id=>$val){
                // Get files upload path
              $newtext=metaphone($_POST['artist']);
               $albumName=$_POST['album'];
               $artist=$_POST['artist'];
               $genre=$_POST['genre'];
                $fileName        = $_FILES['fileUpload']['name'][$id];
                $tempLocation    = $_FILES['fileUpload']['tmp_name'][$id];
                $targetFilePath  = $uploadsDir . $fileName;
                $fileType        = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
                $uploadDate      = date('Y-m-d H:i:s');
                $uploadOk = 1;
                $description=$artist.$genre.$fileName;

                if(in_array($fileType, $allowedFileType)){
                        if(move_uploaded_file($tempLocation, $targetFilePath)){
                            $sqlVal = "('".$genre."','".$albumName."','".$fileName."')";
                            $newtext=metaphone($description);
                        } else {
                            $response = array(
                                "status" => "alert-danger",
                                "message" => "File coud not be uploaded."
                            );
                        }
                    
                } else {
                    $response = array(
                        "status" => "alert-danger",
                        "message" => "Only .jpg, .jpeg and .png file formats allowed."
                    );
                }
                // Add into MySQL database
                if(!empty($sqlVal)) {
                    $insert = ("INSERT INTO abs (description,artist,genre, album,fileName,phonicTxt ) VALUES ('".$description."','".$artist."','".$genre."','".$albumName."','".$fileName."','".$newtext."')
                      ");
                     $qry=mysqli_multi_query($conn,$insert);
                    
                    if($insert) {
                        $response = array(
                            "status" => "alert-success",
                            "message" => "Files successfully uploaded."
                        );
                    } else {
                        $response = array(
                            "status" => "alert-danger",
                            "message" => "Files coudn't be uploaded due to database error."
                        );
                    }
                }
            }

        } else {
            // Error
            $response = array(
                "status" => "alert-danger",
                "message" => "Please select a file to upload."
            );
        }
    } 
  }
?>
</body>

</html>