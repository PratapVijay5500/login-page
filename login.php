<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login Form</title>
 	<link rel="icon" href="stationary_logo.png"/>

<?php include('./header.php'); ?>
<?php include('./db_connect.php'); ?>
<?php 
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;




$query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
		foreach ($query as $key => $value) {
			if(!is_numeric($key))
				$_SESSION['setting_'.$key] = $value;
		}
		
		  if(isset($_POST["register"])){
        $email = $_POST["email"];
        $_SESSION['username'] = $email;
        $check_query = mysqli_query($conn, "SELECT * FROM users where email ='$email'");
        $rowCount = mysqli_num_rows($check_query);
        
        
                $result = mysqli_query($conn, "INSERT INTO users (email, status) VALUES ('$email', 0)");
    
                if($result){
                    $otp = rand(100000,999999);
                    $_SESSION['otp'] = $otp;
                    $_SESSION['mail'] = $email;
                    $_SESSION['start'] = time(); // Taking now logged in time.
            // Ending a session in 30 minutes from the starting time.
            $_SESSION['expire'] = $_SESSION['start'] + (40);
                    require 'vendor/autoload.php';
                    $mail = new PHPMailer;
    
                    $mail->isSMTP();
                    $mail->Host='smtp.gmail.com';
                    $mail->Port=587;
                    $mail->SMTPAuth=true;
                    $mail->SMTPSecure='tls';
    
                    $mail->Username='kumarvijaypk007@gmail.com';
                    $mail->Password = 'ixdzsmlnhrgzbqsp';
                    $mail->setFrom('kumarvijaypk007@gmail.com', 'OTP Verification');
                    $mail->addAddress($_POST["email"]);
    
                    $mail->isHTML(true);
                    $mail->Subject="Your verify code";
                    $mail->Body="<p>Dear user, </p> <h3>Your verify OTP code is $otp <br></h3>
                    <br><br>
                    <p>With regrads,</p>
                    <b>Vijay Pratap</b>
                  ";
    
                            if(!$mail->send()){
                                ?>
                                    <script>
                                        alert("<?php echo "Register Failed, Invalid Email "?>");
                                    </script>
                                <?php
                            }else{
                                ?>
                                <script>
                                    // alert("<?php echo "Register Successfully, OTP sent to " . $email ?>");
                                    window.location.replace('index.php?page=otp');
                                </script>
                                <?php
                            }
                }
            }
        
    
?>

</head>


<body>
<img class="wave" src="assets/img/wave.png">
	<div class="container">
		<div class="img">
			<img src="assets/img/bg.svg">
		</div>
		<div class="login-content">
			<form action="#" method="POST" class="login-form">
				<img src="assets/img/avatar.svg">
				<div class="form-group">
				<h2 class="title">SIGN IN</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
					  <input type="text" placeholder="Enter Email Id"id="email" name="email" class="form-control">
           		   </div>
           		</div>
				</div>
           		<span class="login-error"></span>
				  
            	<input type="submit" class="btn-submit" value="Request OTP", name="register">
            </form>
        </div>
		
    </div>
	<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

</body>



</html>