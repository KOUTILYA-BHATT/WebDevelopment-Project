<?php
session_start();
if(!isset($_SESSION['uid'])){
 header("Location: login.php");
 exit;
}else{
$showerror = false;
 if($_SERVER["REQUEST_METHOD"] == "POST"){
   include './includes/dbconnect.php';
   $password = $_POST["password"];
   $cpassword = $_POST["cpassword"];

   if($password == $cpassword){

     $sql = "UPDATE userinfo SET user_password = '$password' WHERE userinfo.user_id = $_SESSION[uid]";
     $result = mysqli_query($conn, $sql);
   	 if($result){
       echo '<script>alert("Password reset was Successfully now login")</script>';
       session_unset();
       session_destroy();
       header("Location:index.php");
     }else{$showerror = "There was a problem in updating the password please try later";}
    } else{$showerror = "passwords does not match";}
  }
}
?>

<!DOCTYPE html>
<html lang="en">
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
  <body class="goto-here">

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
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Shop</a>
          <div class="dropdown-menu" aria-labelledby="dropdown04">
            <a class="dropdown-item" href="shop.php">Shop</a>
            <a class="dropdown-item" href="wishlist.php">Wishlist</a>
            <a class="dropdown-item" href="product-single.php">Single Product</a>
            <a class="dropdown-item" href="cart.php">Cart</a>
            <a class="dropdown-item" href="checkout.php">Checkout</a>
          </div>
        </li>
        <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
        <li class="nav-item"><a href="blog.php" class="nav-link">Blog</a></li>
        <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
        <li class="nav-item"><a href="cart.php" class="nav-link"><span class="icon-shopping_cart"></span>[0]</a></li>

      </ul>
    </div>
  </div>
</nav>

<section style="  height: 150px; display: flex; align-items: center; justify-content: center; background-color: #82ae46;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div style="text-align: center;">
                    <h2 class=" text-white"><strong>Create New Password</strong> </h2>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-light" style="  height: 65px; display: flex;">
  <?php
    if($showerror){
      echo'<div class="alert alert-danger alert-dismissible fade show col-lg-12" role="alert">
            <strong>Error!</strong>'.$showerror.'
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>';}
  ?>
</section>

<section class="login_part section_padding bg-light">
    <div class="container">
        <form class="container col-lg-6 col-lg-offset-3 text-body" action="./resetpass.php" enctype="multipart/form-data" method="post" novalidate="novalidate">

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" value="" placeholder="Password" required>
            </div>

            <div class="form-group">
                <label for="cpassword">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword" value="" placeholder="Password" required>
            </div>

            <button type="submit" class="btn btn-outline-success btn-lg btn-block" value="submit"> Change Password </button>
        </form>
    </div>
</section>

<section class="bg-light" style="  height: 50px; display: flex;">
</section>


<?php require_once("./includes/footer.php"); ?>
