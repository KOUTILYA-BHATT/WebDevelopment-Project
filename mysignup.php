<?php
session_start();
include_once ("config1.php");

//$current_url = urlencode($url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
?>
<?php

if (isset($_POST['name']) && (isset($_POST['email'])) && (isset($_POST['pass'])))
	{
	$dob = '00/00/0000';
	$addr = 'NULL';
	$name = $_POST['name'];

	// $lastname=$_POST['lastname'];

	$email = $_POST['email'];
	$pass = $_POST['pass'];
	$dob = $_POST['dob'];
	$addr = $_POST['addr'];

	$pass=md5($pass);
	// $myemail="siddheysankhe1996@gmail.com";

	$sentOtp = mt_rand(100000, 999999);
	//$dbc = mysqli_connect("localhost", "root", "", "project") or die("Error connecting sql server");
	$query = "INSERT INTO users (Firstname,Email,DOB,Address) VALUES ('$name','$email','$dob','$addr')";
	$_SESSION['signupUser'] = $email;
	$result = mysqli_query($dbc, $query);
	$query="UPDATE users SET OTP=$sentOtp WHERE Email='$email'";
    $result=mysqli_query($dbc,$query);
	$query2="Select * from users where Email='$email'";
	$result2=mysqli_query($dbc,$query2);
	$no_rows=mysqli_num_rows($result2);
	if($no_rows==1)
	{
		$row=mysqli_fetch_array($result2,MYSQLI_ASSOC);
		$verified=$row['Verified'];
		
	}
	if($verified==0)
	{
		$query="UPDATE users SET Password='$pass' WHERE Email='$email'";
		$result=mysqli_query($dbc,$query);
	}
	else
	{
		header("Location:index.php?alreadyPresent=1");
	}
	// //$dbc=mysqli_connect("localhost","root","","online_groc") or die("Error connecting sql server");
	// $results = $mysqli->query("INSERT INTO users (Firstname,Email,Password,Date of Birth,Address) VALUES ('$name','$email','$pass','$dob','$addr')");
	// $query="INSERT INTO users (Firstname,Email,Password,Date of Birth,Address) VALUES ('$name','$email','$pass','$dob','$addr')";
	// $subject="Thank You for signing up";
	// $msg="This is system generated mail please do not reply";

	require 'PHPMailer/PHPMailerAutoload.php';

	$mail = new PHPMailer;

	// $mail->SMTPDebug = 3;                               // Enable verbose debug output

	$mail->isSMTP(); // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
	$mail->SMTPAuth = true; // Enable SMTP authentication
	$mail->Username = 'onlinegrocerystores@gmail.com'; // SMTP username
	$mail->Password = 'nahibatanaja'; // SMTP password
	$mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587; // TCP port to connect to
	$mail->setFrom('onlinegrocerystores@gmail.com', 'Online Grocery Stores');
	$mail->addAddress($email); // Add a recipient

	// $mail->addAddress('siddheysankhe1996@gmail.com');               // Name is optional
	// $mail->addReplyTo('info@example.com', 'Information');
	// $mail->addCC('cc@example.com');
	// $mail->addBCC('bcc@example.com');
	// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

	$mail->isHTML(true); // Set email format to HTML
	$mail->Subject = "Login Authentication";
	$mail->Body = "Thank You for Sign up OTP:$sentOtp";
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	/*if (!$mail->send())
		{
		echo "Message could not be sent to $email";
		echo 'Mailer Error: ' . $mail->ErrorInfo;
		}
	  else
		{
		echo "Message has been sent to $email";
		}
*/
	// mail($email,$subject,$msg,'From:' . $myemail);
	// $result=mysqli_query($dbc,$query);

	/*echo "Hello $name <br />";
	echo "Your Email:$email<br />";
	echo "Please confirm your email id";
	echo "Your DOB:$dob";
	echo "Your addr:$addr";*/

	// mysqli_close($dbc);

	}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Welcome to Shopping mart</title>
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!-- Fontawesome core CSS -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
    <!--GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <!--Slide Show Css -->
    <link href="assets/ItemSlider/css/main-style.css" rel="stylesheet" />
    <!-- custom CSS here -->
    <link href="assets/css/style.css" rel="stylesheet" />

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">


    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="py-1 bg-primary">
  <div class="container">
    <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
      <div class="col-lg-12 d-block">
        <div class="row d-flex">
          <div class="col-md pr-4 d-flex topper align-items-center">
            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
            <span class="text">+91 9909201529</span>
          </div>
          <div class="col-md pr-4 d-flex topper align-items-center">
            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
            <span class="text">suhrad205@gmail.com</span>
          </div>
          <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
            <span class="text">3-5 Business days delivery &amp; Free Returns</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
   <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
  <div class="container">
    <a class="navbar-brand" href="index.php">Vegefoods</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="oi oi-menu"></span> Menu
    </button>

    <div class="collapse navbar-collapse" id="ftco-nav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="shop.php">Shop</a></li>
         
        <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
        <li class="nav-item"><a href="blog.php" class="nav-link">Blog</a></li>
        <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
		<li class="nav-item"><a class="nav-link" href="cart_viewvik.php">Cart</a></li>

		<li>
		<?php
						if(isset($_SESSION['loginUser']))
						{
							$uemail=$_SESSION['loginUser'];
							echo "</li>
        <li class=\"nav-item\"><a href=\"changePass.php\" class=\"nav-link\">Change Password</strong></a></li>
								<li class=\"nav-item\"><a href=\"index.php?logout=1\" class=\"nav-link\">LOGOUT</a></li>
								</li>";
						}
						else
						{
							echo "</li>
        <li class=\"nav-item\"><a href=\"index_login.html\" class=\"nav-link\">Login</a></li>
							<li class=\"nav-item\"><a href=\"index_signup.html\" class=\"nav-link\">Signup</a></li>
							</li>";
						}
					?>
			</li>
			

        

      </ul>
    </div>
  </div>
</nav>



	<div class="col-md-4 text-center col-sm-6 col-xs-6">
	</div>
	<div class="col-md-4 text-center col-sm-6 col-xs-6">
        <div class="thumbnail product-box">
			<strong>Verification</strong><b>
			<form method="GET" action="mysignup.php">
					<div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <input type="text" class="form-control" required="required" placeholder="OTP" id="otp" name="otp">
                            </div>
							<div>
								<?php
								if (isset($_POST['name']) && (isset($_POST['email'])) && (isset($_POST['pass'])))
								{
									if (!$mail->send())
									{
										echo "Sorry. The Mail could not be sent to $email Due to some network Issues. Please Try Again From The SignUp Process";
									}
									else
									{
										echo "Message has been sent to $email";
									}
								}
								if (isset($_GET['otp']))
									{
										
									//$dbc=mysqli_connect("localhost","root","","online_groc") or die("Error connecting sql server");
									$sentOtp=123;
									$currentUser=$_SESSION['signupUser'];
									$query="select  * from users where Email='$currentUser'";
									$result=mysqli_query($dbc,$query);
									$no_rows=mysqli_num_rows($result);
									if($no_rows==1)
									{
										$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
										$sentOtp=$row["OTP"];
									}	
									$checkOtp = $_GET['otp'];
									if ($checkOtp == $sentOtp)
										{
										$query="UPDATE users SET Verified='1' WHERE Email='$currentUser'";
                                        $result=mysqli_query($dbc,$query);
										$message = "Sucessfully Signed Up. Now Login";
                                        echo "<script type='text/javascript'>alert('$message');</script>";	
										header("location:index.php?login=1");
										}
									  else
										{
										echo "Invalid Otp try again!!";
										}
									}

								?>
							</div>
                        </div>
                    </div>
					<div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
							<div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
							</div>
						</div>
					</div>
					
            </form>
	</div>
</body>