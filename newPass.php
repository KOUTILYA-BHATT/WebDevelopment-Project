<?php
session_start();
include("config1.php");
if(isset($_SESSION['loginUser']))
{
$uemail=$_SESSION['loginUser'];
}
if(isset($_GET['reus']))
{
	$uemail=$_GET['reus'];
	$_SESSION['forgotUser']=$uemail;
	//$_SESSION['loginUser']=$user;
}
if(isset($_POST['passold']))
{
	$oldPassword=$_POST['passold'];
	$oldPassword=md5($oldPassword);
	$query="select * from users where Email='$uemail'";
	$result=mysqli_query($dbc,$query);
	$no_rows=mysqli_num_rows($result);
	if($no_rows==1)
	{
			$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
			//printf ("%s (%s)\n",$row["Firstname"],$row["DOB"]);
			$opassd=$row["Password"];
			$verify=$row["Verified"];
			//echo "Your password:$passd";
			if($opassd!=$oldPassword)
			{
				header("location:changePass.php?wrongPass=1");
			}
	}
}
if(isset($_POST['passnew']))
{
	$newPassword=$_POST['passnew'];
	$newPassword=md5($newPassword);
	if(isset($_SESSION['forgotUser']))
		$uemail=$_SESSION['forgotUser'];
	$query="update users set Password='$newPassword' where Email='$uemail'";
	$result=mysqli_query($dbc,$query);
	header("location:index.php?passChange=1");
	
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Vegefoods</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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
							echo "
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
			<strong>Change Password</strong>
			 <form method="POST" action="newPass.php">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <input type="Password" class="form-control" required="required" placeholder="New Password" id="passnew" name="passnew">
                            </div>
                        </div>
                        
                    </div>
					<div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
							<div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit Request</button>
                            </div>
							</div>
						</div>
					</div>
					
                </form>
				
		</div>
	</div>

	
</body>
</html>