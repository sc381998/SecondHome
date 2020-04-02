<?php
@session_start();
///////////////////// SMTP MAILER with Image Verification Dt: 06 Dec 2017 by HD ////////////////////////////// 
include("lib/checkme.php");

$recipient = 'apexinvention@gmail.com';//'homesteadslg@gmail.com';

$referers = array('homesteadrealtors.in', 'www.homesteadrealtors.in');

$success_url = 'http://homesteadrealtors.in/thanks.php';

$siteurl = 'http://homesteadrealtors.in/';

# SMTP MAIL Config
$SMTPhost = 'homesteadrealtors.in'; // Mail Server Address or IP
$SMTPusername = 'noreply@homesteadrealtors.in'; // Email Username
$SMTPpassword = '}ap7.D2uJ5em'; // Password
// Header elements to restrict add more array elements if required
$injections = array('\r',
    '\t',
    '\n',
    '%0A',
    '%0D',
    '%0a',
    '%0d',
    '%08',
    '%09',
    'Content-type',
    'content-type',
    'Content-Type',
    'content-Type',
    'CONTENT-TYPE',
    'to:',
    'cc:',
    'bcc:',
    'To:',
    'Cc:',
    'Bcc:',
    'TO:',
    'CC:',
    'BCC:',
);

// Find in Field Name & Replace in Email Body
$Find = array('req_', '_');
$Replace = array('', ' ');

// Field Names to Ignore in Email Body becoz they have been embedded earlier or not required
$IgnoreFields = array('realname', 'email', 'Submit', 'message', 'mobile', 'txtNumber','apexCaptcha');


$FilteredSiteName = ucwords(str_replace('http://www.', '', $siteurl));
$subemail = @$_POST['email'];
$subject = 'Query from ' . $FilteredSiteName . ' - '. $subemail;;

// Browser and IP Check & Validate
$browser = getenv("HTTP_USER_AGENT");
$ip = getenv("REMOTE_ADDR");

if (empty($browser) || empty($ip)) {
    header("location:$siteurl");
    exit();
}

// Mail Functions
function Print_Footer() {
    echo '<p><center>Powered by apexinvention.com<a href="http://www.apexinvention.com">http://www.apexinvention.com</a>!</center>';
}

function Check_Referer() {
    global $referers;
    $temp = explode('/', $_SERVER['HTTP_REFERER']);
    $referer = $temp[2];
    $found = false;
    foreach ($referers as $domain) {
        if (stristr($referer, $domain)) {
            $found = true;
        }
    }
    return $found;
}

if ($_POST) {
    if (Check_Referer() == false) {
        echo '<font size="+1" color="#FF0000">Error: Invalid Referer</font><BR>';
        echo 'You are accessing this script from an unauthorized domain!';

        Print_Footer();
        die();
    }
    if(is_numeric($_POST['apexCaptcha']) == false){
         echo '<font size="+1" color="#FF0000">Error: Invalid Code</font><BR>';
        echo 'Your captcha verifaction is invalid!';

        Print_Footer();
        die();
    }
    if($chk->validCaptcha() == false){
         echo '<font size="+1" color="#FF0000">Error: Invalid Code</font><BR>';
        echo 'Your captcha verifaction is invalid!';

        Print_Footer();
        die();
    }

  

    $ctr = 0;

    $isrealname = 0;
    $isemail = 0;

    foreach ($_POST as $key => $val) {
        if ($key == 'realname') {
            $isrealname = 1;
        }
        if ($key == 'mobile') {
            $isemail = 1;
        }
        if (substr($key, 0, 4) == 'req_' || $key == 'realname' || $key == 'mobile') {
            if ($val == '') {
                if ($ctr == 0) {
                    echo '<font size="+1" color="#FF0000">Error: Missing Field(s)</font><BR>';
                    echo 'The following <i>required</i> field(s) were not filled out:<BR>';
                }
                echo '<BR>- <b>' . substr($key, 4) . '</b>';
                $ctr++;
            }
        }
    }

    if ($ctr > 0) {
        echo '<p>Click <a href="javascript:history.go(-1)">here</a> to go back';
        Print_Footer();
        die();
    } else {
        if ($isrealname == 0) {
            echo '<font size="+1" color="#FF0000">Error: Missing Field</font><BR>';
            echo 'No "realname" field found.<p><a href="' . $siteurl . '">here</a> to return to the home page.';
            Print_Footer();
            die();
        } elseif ($isemail == 0) {
            echo '<font size="+1" color="#FF0000">Error: Missing Field</font><BR>';
            echo 'No "email" field found.<p><a href="' . $siteurl . '">here</a> to return to the home page.';
            Print_Footer();
            die();
        }
    }

    /* if (!(preg_match("/^.{2,}?@.{2,}\./", $_POST['email']))) {
      echo '<font size="+1" color="#FF0000">Error: Invalid E-mail</font><BR>';
      echo 'The e-mail address you entered (<i>'.$_POST['email'].'</i>) is invalid.';
      Print_Footer();
      die();
      } */

    $body = "Below is the result of your contact form. It was submitted on:\n" . date('l, F jS, Y') . ' at ' . date('g:ia') . ".<br>";

    foreach ($_POST as $key => $val) {
        // echo $key;
        //if ($key == 'recipient') { $recipient = str_replace($injections,'',$val); }
        if ($key == 'date') {
            $subject = str_replace($injections, '', $val);
        } else {
            if ($key == 'realname') {
                $body .= "<br> <b>" . str_replace($key, 'Name', $key) . "</b>: " . str_replace($injections, '', $val);
            } else if ($key == 'email') {
                $body .= "<br> <b>" . str_replace($key, 'From', $key) . "</b>: " . str_replace($injections, '', $val);
            
            } else if ($key == 'mobile') {
                $body .= "<br> <b>" . str_replace($key, 'Mobile', $key) . "</b>: " . str_replace($injections, '', $val);
            } else if ($key == 'message') {
                $body .= "<br> <b>" . str_replace($key, 'Query', $key) . "</b>: " . str_replace($injections, '', $val);
            }
            //echo $body.'<br>';
            if (!in_array($key, $IgnoreFields) && $key != 'message' && $key != 'last_name' && $key != 'Submit' && $key != 'mobile') {
                $body .= "<br> <b>" . ucwords(str_replace($Find, $Replace, $key)) . "</b>: ";
                if (is_array($val)) {
                    $body .= implode(', ', $val);
                } else {
                    $body .= strip_tags(str_replace($injections, '', $val));
                }
            }
        }
    }
    $body .= '<br><br><i>Note: Please "<b>Reply</b>" this mail to contact the sender.</i>';
    $body .= "<br><br>-------- Submission Details --------<br>";
    $body .= "Remote Address: " . getenv('REMOTE_ADDR') . "<br>";
    $body .= "HTTP User Agent: " . getenv('HTTP_USER_AGENT') . "<br>";
    $body .= "--------------------------------------------------<br>";
    $body .= "Feedback Powered by homesteadrealtors.in/. Visit us @ http://www.homesteadrealtors.in/";


    // Name and Email Filtering
    $filteredname = str_replace($injections, '', $_POST['realname']);
    $filteredemail = str_replace($injections, '', $_POST['email']);



    // PHP PEAR SMTP MAIL
    require_once "Mail.php";
    require_once "Mail/mime.php";

    $from = 'FeedbackMailer <' . $SMTPusername . '>';
    $to = 'Feedback Recipient <' . $recipient . '>';
    $replyto = "$filteredname <$filteredemail>";

    # SMTP MAIL Config
    $host = $SMTPhost;
    $username = $SMTPusername;
    $password = $SMTPpassword;

    $header = "MIME-Version: 1.0" . "\r\n";
    $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $header .= "From: Homestead Connection<$username>";

    $headers = array ('From' => $from,
      'To' => $to,
      'Reply-To' => $replyto,
      'MIME-Version' => '1.0',
      //'Content-type' => 'text/html; charset=iso-8859-1',
      'Subject' => $subject);

      $smtp = Mail::factory('smtp',
      array ('host' => $host,
      'auth' => true,
      'username' => $username,
      'password' => $password,
      'port' => 25
      )); 

     $crlf = "\n";

      $body = str_replace('\r\n', '', $body);

      $mime = new Mail_mime($crlf);
      $mime->setTXTBody(trim(strip_tags($body)));
      $mime->setHTMLBody($body);

      $body = $mime->get();
      $headers = $mime->headers($headers); 
    // Send the Mail	
    //$mail = $smtp->send($to, $headers, $body);
      $mail = $smtp->send($to, $headers, $body);
       if (PEAR::isError($mail)) {
        $err = '[' . date("Y-m-d h:i:s") . '] => ' . $mail->getMessage()."\n";

        $filename = 'errorLogs/'.'smtpErrorLog';
        $file = fopen($filename, "a");
        fwrite($file, $err);
        fclose($file);
        //echo $err;

        // Save the Mail File
        $filename = 'errorLogs/'.date("Ymdhis").'-Failed-Mail-Details.html';
        $file = fopen($filename, "w");
        $text = "Form: ". htmlentities($from)."
                        <br>
                        To: ". htmlentities($to)."
                        <br>
                        Reply-to: ". htmlentities($replyto)."
                        <br>
                        Subject: $subject
                        <hr>
                        $body														
                        ";
        fwrite($file, $text);
        fclose($file);
        //print($mail); // Errors are displayed in Array
        //return false;
        }
   else {
        //print_r($_POST);
        //echo $body;
        header("Location: $success_url");
        
        exit();
    }
} else {
    echo '<center>You have access this page from an invalid location. Please click <a href="' . $siteurl . '">here</a> to go to ' . $siteurl . '.</center>';
}
Print_Footer();
?>