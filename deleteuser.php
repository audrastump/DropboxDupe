<!DOCTYPE html>
<html lang = "en">
    <head>
        <link rel="stylesheet" type="text/css" href="homepage.css">
        <title>Delete Account</title>
    </head>
    <body> <div id = "main">
    <h1>Are you sure you want to delete your account?</h1>
        <form action="deleteuser.php" method="POST"><input type="submit" value="delete"/></form>
    </div>
    </body>

<?php
    session_start();
	//if user is trying to hack the account, we will redirect them to login
    if (!isset($_SESSION['username'])) {
	    header("Location: login.html");
		die();
	}
	//get username and user directory
    $username = $_SESSION['username'];  
    $path = sprintf("/srv/userFiles//%s", $username);
	//need to check if they posted to delete it
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		//getting rid of the path
		rmdir($path);
		$userFile  = file("/srv/users.txt");
		$final = '';
		//going to change the users.txt to not have the user anymore
		foreach($userFile as $var) {
			if(stripos($var, $username) === false) {
				$final .= $var;
			}
			//change it to blank
			file_put_contents('/srv/users.txt', $final);
			session_destroy();
		}
		//go back to login
	    header('Location: login.html');
	    exit();
?>
</html>