<?php 
    include 'dbcon.php';
    require 'Account/mail/PHPMailerAutoload.php';

    $mail = new PHPMailer;

    if(isset($_POST['register'])){
        $user_fullname = $_POST['user_fullname'];
        $user_email = $_POST['user_email'];
        $user_name = $_POST['user_name'];
        $user_pass = $_POST['user_pass'];
        $rand=rand('111111','999999');
        $code = $rand;

        $sql = "INSERT INTO user_accounts (user_fullname,user_email,user_name,user_pass,code) VALUES (?,?,?,?,?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sssss",$user_fullname,$user_email,$user_name,$user_pass,$code);
        $stmt->execute();
        
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'ejquiambao11@gmail.com';                 // SMTP username
            $mail->Password = 'shzbzmjpiwutldyx';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            $mail->setFrom('ejquiambao11@gmail.com', 'Edgar Jhem C. Quiambao');
            $mail->addAddress($user_email, $user_fullname);     // Add a recipient

            $mail->Subject = 'Registration Verification';
            $mail->Body    = '<a href="http://localhost/FinalProject/Account/verifier.php?code='.$code.'">Click this link to verify your email address</a>
            <p>Your Reset Password Verification Code is: <h2>'.$code.'</h2></p>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            if(!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo "<script>
                alert('Registered Successfully, Check your Email To Verifiy your account');
                window.location.href='Account/login.php';
                </script>";
            }
    
    }

?>
 $sql = "SELECT * FROM banner";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
            $name = $row['name'];
        }
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="Account/RegStyle.css">
</head>
<body>
<div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form login-form">
                    <h2 class="text-center">Resistration Form</h2><br>
            <form action="index.php" method="POST">
            <div class="form-group">
                <input class="form-control" type="text" name="user_fullname" placeholder="Enter Full Name"/> 
            </div>
            <div class="form-group">
                <input class="form-control" type="email" name="user_email" placeholder="Enter Email"/>
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="user_name" placeholder="Enter Username"/>
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="user_pass" placeholder="Enter Password"/>
            </div>
            <div class="form-group">
            Registered already? <a id = "registernow" href="Account/login.php">Click to Login</a><br><br>
                <button class="form-control button" type="submit" name="register">Register</button>
            </div>
            </form>
        </div>
    </div>
</div>
    
</body>
</html>