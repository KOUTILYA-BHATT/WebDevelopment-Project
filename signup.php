<?php
  $showalert = false;
  $showerror = false;
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    include './includes/dbconnect.php';
    $name = $_POST["fullname"];
    $mobile = $_POST["mobile"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $dob = $_POST["dob"];
    $gender = $_POST['gender'];
    $sans = $_POST["sans"];
    $address = $_POST["address"];

    $existsql = "SELECT * FROM `userinfo` WHERE `user_email` = '$email'";
    $result = mysqli_query($conn, $existsql);
    $numexistrow = mysqli_num_rows($result);

    if($numexistrow > 0){
      $showerror = "Email already registered";
    }
    elseif($password == $cpassword){

        $filename = $_FILES["file"]["name"];
        $file_basename = substr($filename, 0, strripos($filename, '.'));
        $file_ext = substr($filename, strripos($filename, '.'));
        $filesize = $_FILES["file"]["size"];
        $allowed_file_types = array('.jpeg','.jpg','.jpe','.jif');

        if (in_array($file_ext,$allowed_file_types) && ($filesize < 1000000))
        {
          $sql = "INSERT INTO `userinfo` (`user_name`, `user_email`, `user_password`, `user_mobile`, `user_bdate`, `user_gender`, `user_address`, `user_sa`, `user_dac`, `user_laa`)
          VALUES ('$name', '$email', '$password', '$mobile', '$dob', '$gender', '$address', '$sans', current_timestamp(), current_timestamp());";

          if(mysqli_query($conn, $sql)) {

            $img_name = mysqli_insert_id($conn);
            mysqli_close($conn);

            $newfilename = $img_name . ".jpg";
            move_uploaded_file($_FILES["file"]["tmp_name"], "images/profile_photos/" . $newfilename);
            $showalert = true;
          }
        }
        elseif (empty($file_basename))
        {
          // file selection error
          $showerror = "Please select a file to upload.";
        }
        elseif ($filesize > 1000000)
        {
          // file size error
          $showerror = "The file you are trying to upload is too large.";
        }
        else
        {
          // file type error
          $showerror = "Only these file typs are allowed for upload: " . implode(', ',$allowed_file_types);
          unlink($_FILES["file"]["tmp_name"]);
        }
      }else {
        $showerror = "  password does not match";
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
        <?php
        if(!isset($_SESSION['uid'])){
        echo'<li class="nav-item"><a href="Login.php" class="nav-link">Log in/Sign up</a></li>';
        }
        else{
        echo'<li class="nav-item"><a href="Logout.php" class="nav-link">Log out</a></li>
             <li class="nav-item"><a class="nav-link">'. $_SESSION['uname'] .'</a></li>';
      }
        ?>

      </ul>
    </div>
  </div>
</nav>

<section style="  height: 150px; display: flex; align-items: center; justify-content: center; background-color: #82ae46;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div style="text-align: center;">
                    <h2 class=" text-white"><strong>Sign Up</strong> </h2>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-light" style="  height: 65px; display: flex;">
  <?php
    if($showalert){
      echo'<div class="alert alert-success alert-dismissible fade show col-lg-12" role="alert">
            <strong>Success!</strong> Your account is now created.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>';}
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
            <form class="container col-lg-6 col-lg-offset-3 text-body" action="./signup.php" enctype="multipart/form-data" method="post" novalidate="novalidate">

                <div class="form-group">
                    <label for="fullname">Full Name</label>
                    <input type="text" class="form-control" id="fullname" name="fullname" value=""
                    placeholder="First Name                                    Last Name" required>
                </div>

                <div class="form-group">
                    <label for="mobile">Mobile Number</label>
                    <input type="text" class="form-control" id="mobile" name="mobile" value="" placeholder="Mobile" required>
                </div>

                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" value="" placeholder="adc@xyz.com" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" value="" placeholder="Password" required>
                </div>

                <div class="form-group">
                    <label for="cpassword">Confirm Password</label>
                    <input type="password" class="form-control" id="cpassword" name="cpassword" value="" placeholder="Password" required>
                </div>

                <div class="form-group" >
                    <label for="dob">Date of Birth</label>
                    <input type="date" class="form-control" id="dob" name="dob" value="" placeholder="Enter your date of birth" required>
                </div>

                <div class="form-group">
                    <label for="gender1">Gender   </label>
                    <input type="radio"  id="gender1" name="gender" value="1">   Male
				            <input type="radio" id="gender1" name="gender" value="2">    Female
                    <input type="radio" id="gender1" name="gender" value="3">    Others
                </div>

                <div class="form-group">
                    <label for="file">Upload Profile Picture</label>
                    <input type="file" name="file" class="form-control" id="file" value="" required>
                </div>

                <div class="form-group">
                    <label for="sans">Security Question: What is your favourite color ?</label>
                    <input type="text" class="form-control" id="sans" name="sans" value="" placeholder="Your answer" required>
                </div>

                <div class="form-group">
                    <label for="address">Enter your complete address  </label>
                    <input type="text" class="form-control" id="address" name="address" value="" placeholder="Address" required>
                </div>

                <button type="submit" class="btn btn-outline-success btn-lg btn-block" value="submit"> Signup </button>
            </form>
        </div>
    </section>

    <section class="bg-light" style="  height: 50px; display: flex;">
    </section>

<?php require_once("./includes/footer.php"); ?>
