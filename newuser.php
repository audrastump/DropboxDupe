<!DOCTYPE html>
<html lang = "en">
    <head>
        <link rel="stylesheet" type="text/css" href="homepage.css"> 
        <title>File Sharing Site</title>
    </head>
    <body> <div id = "main">
        <h1>Username Created Successfully!</h1>
        <a href="login.html">Please login using your new account</a>
    </div>
    </body>
</html>
<?php
//if the username is not set, we want to go back to login
if (!isset($_POST['username'])){
    header("Location: login.html");
    die();
} 

$new_username = $_POST['username'];
//validating the username so no weird characters
if( !preg_match('/^[\w_\.\-]+$/', $new_username) ){
        echo "Name you entered is invalid, please try again";
        exit;
    }
$first = $_POST['username'];
$userList = fopen("/srv/users.txt","r");
$isTaken = false;
//iterating through the list and checking to see if taken or not
while (!feof($userList)){
    if(trim(fgets($userList)) == $first){
        $isTaken = true;
    }   
}
//if not taken 
if ($isTaken ==false){
    //add a newline and the username to the txt file
    file_put_contents("/srv/users.txt", "\n", FILE_APPEND); 
    file_put_contents("/srv/users.txt", $first, FILE_APPEND); 
    $personalDir = sprintf("/srv/userFiles/%s",$first);
    //if the file does not exist we will create a personal directory for them
    if(!file_exists($personalDir)) {
	   mkdir($personalDir,0777,true);
	}
}
    else{
        echo "Username taken, please pick a different name";
        exit;
}
?>
