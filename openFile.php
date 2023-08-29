
<?php
session_start();
//check for security things
if(!isset($_SESSION['username'])){
    header("Location: login.html");
    die();
}
//get username and file to open
$username = $_SESSION['username'];
$fileName = $_GET['fileToOpen'];

$path = sprintf("/srv/userFiles/%s/%s", $username,$fileName);
//if the file is not in the path
if (!is_file($path)){
    ?>
        <body> <div id = "main">
        <h1>File doesn't exist!</h1>
        <body><a href="userDash.php">Try again!</a></body>
    <?php
    exit;
}
//otherwise, we want to open it
$file = fopen($path, 'r');
$finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($path);
header("Content-Type: ".$mime);
while (ob_get_level() && @ob_end_clean()) {
	        ;
}
header("Content-Disposition: filename=\"$file\"");
readfile($path);
exit;

?>
