<?php
$email = '';
$password = '';
$mobile = '';
$status = 1;
$email_err ="";
$password_err = '';
$msg = '';
//If the form is submitted

if (!empty($_POST)) {
    // Check if username is empty
    if(empty(trim($_POST["email"]))){
        $msg = "email_error";
    } else{
        $email = trim($_POST["email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $msg = "password_error";
    } else{
        $password = trim($_POST["password"]);
    }
    if($_POST["remember_me"]=='1' || $_POST["remember_me"]=='on'){
        $hour = time() + 3600 * 24 * 30;
        setcookie('email', $email, $hour);
             setcookie('password', $password, $hour);
        }
    if(empty($email_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, email, password FROM registerqry WHERE email = :email";
        
        if($stmt = $pdocon->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if email exists, if yes then verify password
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["id"];
                        $email = $row["email"];
                        $hashed_password = $row["password"];
                        if(password_verify($password, $hashed_password)){
                            // Redirect user to welcome page
                            // header("location: welcome.php");
                        } else{
                            // Display an error message if password is not valid
                            $msg = "password_error";
                        }
                    }
                } else{
                    // Display an error message if email doesn't exist
                    $msg = "email_error";
                }
            } else{
                $msg = "Oops! Something went wrong. Please try again later.";
            }
        }
    }
}
 
if (!empty($msg)) {
    echo $msg;
}

?>