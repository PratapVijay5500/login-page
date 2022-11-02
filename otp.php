<!DOCTYPE html>
<html>
<head>
	<title>Login Form Using OTP </title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include('./header.php'); ?>
<?php include('./db_connect.php'); ?>

<?php 
session_start();
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");
$query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
		foreach ($query as $key => $value) {
			if(!is_numeric($key))
				$_SESSION['setting_'.$key] = $value;
		}
		
    if(isset($_POST["verify"])){
        $otp = $_SESSION['otp'];
        $email = $_SESSION['mail'];
        $otp_code = $_POST['otp_code'];
        $_SESSION["user"] = $email;
        if($otp != $otp_code){
            ?>
           <script>
               alert("Invalid OTP code");
           </script>
           <?php
        }else{
            mysqli_query($conn, "UPDATE users SET status = 1 WHERE email = '$email'");
            ?>
             <script>
                 alert("Verfiy account done, you may sign in now");
                   window.location.replace("home.php");
             </script>
             <?php
        }

    }
?>
</head>
<body>
	<img class="wave" src="assets/img/wave.png">
	<div class="container1">
		<div class="img1">
			<img src="assets/img/bg.svg">
		</div>
		<div class="otp-content">
            <form action="#" method="POST">
                <img src="assets/img/avatar.svg">
                <div class="form-group">
                <h2 class="title">Enter OTP</h2>
                   <div class="input-div one">
                      <div class="i">
                              <i class="fas fa-user"></i>
                      </div>
                      <div class="div">
                              <input type="text" name="otp_code" id="otp" placeholder="Enter OTP..." class="form-control">
                      </div>
                   </div>
                   </div>
                   <span class="otp-error"></span>
                 
                   <input type="submit" class="btn-otp-submit" name="verify"value="Verify OTP">
            
                  <a href="index.php?page=login"> <input type="btn" class="btn" value="Request Another OTP"></a><?php include('./otp-timer.php'); ?>
            
            </form>
        </div>
		
    </div>
   
   
</body>
</html>




