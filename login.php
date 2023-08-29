
<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset="utf-8">
        <title>File Sharing Site</title>
    </head>
<?php
session_start();
//if the username is entered from the login page, we want to login
if (isset($_POST['username'])) {
        $first = $_POST['username'];
        $userList = fopen("/srv/users.txt","r");
        //iterating through the list to see if it matches our entered username
        while (!feof($userList)){
             if(trim(fgets($userList)) == $first){
                    //setting our session username
                    $_SESSION['username']=$first;
                    header("Location: userDash.php");
              	    exit;
                }
             }
        //destroy the session, and go to the user not found page
        fclose($userList);
        session_destroy();
        header("Location: userNotFound.html");
        exit;
}
else if(isset($_SESSION['username'])){
        // if we go back, we want to set this
        $first = $_SESSION['username'];
    }
else{
        // if nothing is set, go to the login.html page
        header("Location: login.html");
        die();
    }
?>
</html>