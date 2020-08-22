<?php 
    // Database
     

    include 'config1.php'; 

    if(isset($_POST['addAds'])){
      include('Config.php');

        
        $uploadsDir = "ads/";
        $allowedFileType = array('jpg','png','raw');
        
        // Velidate if files exist
        if (!empty(array_filter($_FILES['fileUpload']['name']))) {
            
            // Loop through file items
            foreach($_FILES['fileUpload']['name'] as $id=>$val){
                // Get files upload path
             
              $description=$_POST['desc'];
              $days=$_POST['days'];
              $adName=$_POST['adName'];

                $fileName        = $_FILES['fileUpload']['name'][$id];
                $tempLocation    = $_FILES['fileUpload']['tmp_name'][$id];
                $targetFilePath  = $uploadsDir . $fileName;
                $fileType        = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
                $uploadDate      = date('Y-m-d H:i:s');
                $uploadOk = 1;
           //     $description=$artist.$genre.$fileName;

                if(in_array($fileType, $allowedFileType)){
                        if(move_uploaded_file($tempLocation, $targetFilePath)){
                           // $newtext=metaphone($description);
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
                
                    $insert = ("INSERT INTO ads (description,appearances,clicks,fileName,adName ) VALUES ('".$description."',0,0,'".$fileName."','".$adName."')
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

        } else {
            // Error
           // $response = array(
                echo "<h5 style='color: red'>Please select a file to upload.</h5>";
           // );
        }
    
  }