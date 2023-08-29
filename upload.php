<!DOCTYPE html>
<html lang = "en">
    <head>
        <link rel="stylesheet" type="text/css" href="homepage.css">
        <title>Upload Files</title>
    </head>
    <body> <div id = "main">
    <h1>Feel free to upload your files!</h1>
    <!--form for uploading, we have two parts: file to upload and submit button-->
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="fileToUpload">
        <input type="submit" value="Upload File" name="submit">
    </form>
    </div>
    </body>
</html>
<?php
session_start();
//if coming from another place, redirect to login
if(!isset($_SESSION['username'])){
	    header("Location: login.html");
	    die();
	}
    
    $username = $_SESSION['username'];
    if(array_key_exists('fileToUpload', $_FILES) && array_key_exists('error', $_FILES['fileToUpload'])){
        $fileName = $_FILES['fileToUpload']['name'];
        
	
	$path = sprintf("/srv/userFiles/%s/%s", $username,$fileName);
	//try to move to path, go to upload worked page if it works
        if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $path) ){
		header("Location: uploadworked.html");
            exit;
	    }
        else{
            echo("Upload failed, please try again");
            exit;
        }
    }
    echo("Upload failed, please try again");
     exit;
    ?>
    
