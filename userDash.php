<!DOCTYPE html>
<html lang = "en">
    <head>
        <link rel="stylesheet" type="text/css" href="homepage.css"> 
        <title>User Dashboard</title>
        
    </head>
    <body> <div id = "main">
        <h1>My dashboard</h1>
        <h2>My files </h2>
</div>
<?php
session_start();
ini_set('display_errors',1);
error_reporting(E_ALL);
//go back to login if the user tries to enter without logging in
        if(!isset($_SESSION['username'])){
            header("Location: login.html");
            die();
        }
        //get username and path of user files
        $username = ($_SESSION['username']);
        $path = sprintf("/srv/userFiles/%s",$username);
        //scan the path directory and echo the files
        $files = array_diff(scandir($path), array('..', '.'));
        foreach($files as $file) {   
            echo $file;
            echo "\n";
    }
  
	echo('<form action="upload.php"> <input type="submit" value="Upload a File" /> </form>');

    echo('<form action="logout.php" method="POST"><input type="submit" value="Logout"/></form>');
echo('<form action = "deleteuser.php" method = "POST"><input type="submit" value = "Delete account"/></form>');	
	
    ?>
    <form name = "openFiles" action = "openFile.php" method = "GET">
        <label>Please enter the file you want to open</label>
        <input type = "text" name = "fileToOpen" required/>
        <input type = "submit" value = "enter"/>
    </form>
    <form name = "deleteFiles" action = "delete.php" method = "GET">
        <label>Please enter the file you want to delete</label>
        <input type = "text" name = "fileToDelete" required/>
        <input type = "submit" value = "enter"/>
</form>
<br>
    <form enctype="multipart/form-data" action="send.php" method="POST">
        
        <input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
           <label>Send this file:</label> <input name="duplicate" type="file" id="duplicate" /> 
           <label>User to send to: </label>: <input name = "receivingUser" type = "text" id = "recievingUser"/>
            <input type="submit" value="Share File" />
    </form>
    </body>
</html>
    
