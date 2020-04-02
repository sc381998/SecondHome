<?php

$website = "http://localhost:8080";
// $website = "http://localhost:8080/,http://pc1:8080/";
$isonline = false;
/* Host Filter */
$host = $_SERVER['HTTP_HOST'];
$website_base = '';
$folderName = '';
$securehttps = false;
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
    $website_base = 'https://' . $_SERVER['HTTP_HOST'];
    $securehttps = true;
} else {
    $website_base = 'http://' . $_SERVER['HTTP_HOST'];
    $securehttps = false;
}
if (!empty($_SERVER['PHP_SELF'])) {
    $_SERVER['PHP_SELF'] = htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8");
}
if (dirname($_SERVER['PHP_SELF']) != '/' && dirname($_SERVER['PHP_SELF']) != '\\') {
    $folderName = dirname($_SERVER['PHP_SELF']);
}
$website_base .= $folderName . '/';

// echo $website_base; 
include("connectivity.php");
include('classFile.php');
include("checkMe.php");

include("sysMessage.php");
// include("dbfunction.php");

$img_allowed = array(".jpg", ".jpeg", ".gif", ".png");
$file_allowed = array(".doc", ".pdf");
$allowed_size = 512000;

$address_array = 'Nagrakata, Jalpaiguri, West Bengal, India';
$contact_array = '+91 99338 78928';
$email_array = 'sc381998@gmail.com';
$contactemail = 'sc381998@gmail.com';

$contactsub = array(
    'Feedback',
    'Enquiry',
    'Testimonials',
    'Suggestions',
    'Complaints',
    'Broken Links',
    'Others'
);
$menuarray = array(
    'index' => array(
        'name' => 'Home',
        'title' => 'Second Home',
        'meta_key' => '',
        'meta_des' => 'Project'
    ),
    'about' => array(
        'name' => 'About',
        'title' => 'About | Second Home',
        'meta_key' => '',
        'meta_des' => ''
    ),
    'accomodation' => array(
        'name' => 'Accomodation',
        'title' => 'Accomodation | Second Home',
        'meta_key' => '',
        'meta_des' => ''
    ),
    'contactus' => array(
        'name' => 'Contact Us',
        'title' => 'Contact Us | Second Home',
        'meta_key' => '',
        'meta_des' => ''
    )
);


