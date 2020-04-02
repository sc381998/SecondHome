<?php 
$name = '';
$email = '';
$mobile = '';
$status = 1;
$flag = 1;
$content = '';
$msg = '';
$to ='';
$from = '';
//$subject = "Feedback from $subject";
$subject = '';
$find = '';
$replace = '';
$Mailbody ='';
$hidden = false;
$formShow = true;
$process = false;
$hasError = true;
if (!empty($_POST)) {

    $to = "sc381998@gmail.com"; // this is not correct Email address
    $from = $_POST['email']; // this is the sender's Email address
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $subject = $_POST['subject'];
    $content = $_POST['message'];
    $status = 1;
    $headers = "From:" . $name . 'and Phone No.:' . $mobile;
 if ($chk->validCaptcha() == false) {
        $hasError = true;
        $process = false;
        $msg = 'Captcha Error!!!The Captcha Verification Failed. Please try again.';
    } else {
        $hasError = false;
        $process = true;
    }

    // Alls Right Baby Insert to DB & Mail
    if ($process == true && $hasError == false) {
        // Prepare the SQL for the Record Addition
      $statement = $pdocon->prepare('INSERT INTO contactform 
        (name, email, mobile, subject, message, status)
        VALUES (:name, :email, :mobile, :subject, :message, :status)');

    $mResult = $statement->execute([
      ':name' => $name,
      ':email' => $email,
      ':mobile' => $mobile,
      ':subject' => $subject,
      ':message' => $content,
      ':status' => $status
    ]);
            if ($mResult) {
                $msg = 'success';
                // echo '<script>console.log("succesfully done")</script>';
                // mail($to, $subject, $content, $headers);
                $flag =1;
            } else {
              // echo '<script>console.log("succesfully not done")</script>';
              $msg = "error";
            }
    }
}
if (!empty($msg)) {
    echo $msg;
}
?>