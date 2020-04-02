<?php
# Detect IP Browser of Visitor
$ip = $_SERVER['REMOTE_ADDR'];
$browser = $_SERVER['HTTP_USER_AGENT'];
// Not showing if we missed these both
if (empty($ip) && empty($browser))
	exit();

date_default_timezone_set('Asia/Kolkata');

session_name('LogID');
    session_start();
    // $username=$_POST['username'];
    // $password=$_POST['password'];
    // $con=mysqli_connect('localhost','root','','login_db');
    // if (mysqli_connect_errno())
    // {
    //      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    // }
    // $q="SELECT * FROM user where email='$email' && password='$password'";
    // $result=mysqli_query($con,$q);
    // $num=mysqli_num_rows($result);
    // if($num==1){
    //     $_SESSION['username']=$username;
    //     header('location:http://localhost/Book Management/home.php');
    // }
    // else{
    //     header('location:http://localhost/Book Management/login.php');
    // }
// session_start();

$templatepage = './theme/theme.php';
$pagefile = '';
$SID = '&LogID=' . session_id();
// print_r($_SESSION);

define('fileIncluded', true);
define('ROOT_PATH', './');

# Include the system file
require "lib/configure.php";
// echo $website;

if (strlen('http://' . $_SERVER['HTTP_HOST']) < strlen($website))
	$website = str_replace('www.', '', $website);
elseif (strlen('http://' . $_SERVER['HTTP_HOST']) > strlen($website))
	$website = str_replace('www.', '', $website);
else
	$website = $website;
// echo $website;

// $pagefile = $sys->getPageUrl(@$_GET['pagefile']);



# Check is AJAX call
if (!empty($_GET['ajax']) && $_GET['ajax'] == 1 && !empty($_GET['loaderfile'])) {
    # Include the file
    $loaderfile = $_GET['loaderfile'];
    if (is_readable("pages/$loaderfile.php")) {
        include("pages/$loaderfile.php");
    } else {
        echo '<br />' . '' . $sysmsg['no_data'] . '<br />';
    }
} else {

   $pagefile = $sys->getPageUrl(@$_GET['pagefile']);
$title = '';
$name = '';
$metakey = '';
$metades = '';
if (array_key_exists($pagefile, $menuarray)) {
    $title = $menuarray[$pagefile]['title'];
    $name = $menuarray[$pagefile]['name'];
    $metakey = $menuarray[$pagefile]['meta_key'];
    $metades = $menuarray[$pagefile]['meta_des'];
}
    if (is_readable($templatepage)) {
        include($templatepage);
    }else{
	   echo $sys->showError('danger', 'Theme file not found. Please try after some time');
    }
}



// if (file_exists($templateFile))
// 	include($templateFile);
// else
// 	echo $sys->showError('danger', 'Theme file not found. Please try after some time');



?>