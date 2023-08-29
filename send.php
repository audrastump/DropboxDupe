<!DOCTYPE html>
<html lang = "en">
    <head>
        <link rel="stylesheet" type="text/css" href="homepage.css" media="screen">
        <title>Send File</title>
    </head>
</html>
<?php
 //getting the file name and receiving user
$filename = basename($_FILES['duplicate']['name']);
$receivingUser = $_POST['receivingUser'];
//validating the file name
if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
    echo "File you entered is invalid, please try again";
    exit;
}
//user list open
    $userList = fopen("/srv/users.txt","r");
    //checking through all the users and making sure the sendee is there
    while(!feof($userList)){
            $userName = trim(fgets($userList));
            if($userName == $receivingUser){
                //make new path for the sendee
            $path = sprintf("/srv/userFiles/%s/%s", $receivingUser, $filename);
            //try to move the new files and open success page if so
            if(move_uploaded_file($_FILES['duplicate']['tmp_name'], $path) ){
                header("Location: sentSuccess.html");
                exit;
            }
            //otherwise report error
            else{
                echo("error moving file, please try again");
                exit;
            }
        }
    }
    //if we get here, the user is not there
    echo("user does not exist, please try again");
    exit;
?>
