<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="homepage.css">
        <title>Delete</title>
    </head>

        <?php
        session_start();
        if (!isset($_SESSION['username'])) {
            header("Location: login.html");
            die();
        }
        //getting the file, username, and path we want to delete
        $file = $_GET['fileToDelete'];
        $username = $_SESSION['username'];  
        $path = sprintf("/srv/userFiles/%s/%s", $username,$file);
        //if file exists in this pathway
        if (file_exists($path)){
            //see if we can unlink it
            if(unlink($path)) {
                echo "Delete file successfully";
                echo "<br>";
                echo "<a href='logout.php'>log out</a>";
                echo "<br>";
                echo "<a href='userDash.php'>Back to home page</a>";
            }
            else{
                //for some reason we cannot unlink path
                echo "Could not delete file";
                echo "<br>";
                echo "<a href='logout.php'>Log Out</a>";
                echo "<br>";
                echo "<a href='userDash.php'>Return home</a>";
            }
        }
        //file does not exist
        else{
            echo "Could not delete file";
            echo "<br>";
            echo "<a href='logout.php'>Log out</a>";
            echo "<br>";
        	echo "<a href='userDash.php'>Return home</a>";
        }
        ?>
</html>
