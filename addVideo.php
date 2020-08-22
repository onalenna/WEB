<?php


    include 'config1.php'; 

    if(isset($_POST['addVid'])){
      include('Config.php');

      $check="SELECT * FROM abs WHERE album='".$_POST['album']."'";
      $result = mysqli_query($conn,$check) or die("Failed: ".mysqli_error($conn));
        $row = mysqli_fetch_array($result);
        if ($row ) {

          echo" <h3 style='color:red'>ALBUM NAME ALREADY TAKEN..PLEASE USE A DIFFERENT ONE</h3>";
        }
        else{

        
        $uploadsDir = "upload/";
        $allowedFileType = array('mp4','avi','mov','flv','3gp','mwv','ogg');
        
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
                           // $response = array(
                               echo "<h5 style='color: red'>File coud not be uploaded.</h5>";
                           // );
                        }
                    
                } else {
                    //$response = array(
                        echo "<h5 style='color:red;' wrong file type.. please retry</h5>";
                    //);
                }
                // Add into MySQL database
                if(!empty($sqlVal)) {
                    $insert = ("INSERT INTO abs (description,artist,genre, album,fileName,phonicTxt ) VALUES ('".$description."','".$artist."','".$genre."','".$albumName."','".$fileName."','".$newtext."')
                      ");
                     $qry=mysqli_multi_query($conn,$insert);
                    
                    if($insert) {
                      //  $response = array(
                            echo "<h5 style='color: green'>Files successfully uploaded.</h5>";
                       // );
                    } else {
                     //   $response = array(
                            echo "<h5 style='color: red'>Files coudn't be uploaded due to database error.</h5>";
                     //   );
                    }
                }
            }

        } else {
            // Error
           // $response = array(
                echo "<h5 style='color: red'>Please select a file to upload.</h5>";
           // );
        }
    } 
  }
?>