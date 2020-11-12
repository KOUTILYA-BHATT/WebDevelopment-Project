<?php
session_start();
include_once("config1.php");
$current_url = urlencode($url=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
$id=$_GET["no"];
$user="anon_user";
if(isset($_SESSION['loginUser']))
{
$user=$_SESSION['loginUser'];
}
//$quantity=$_POST["Quantity"];
//$id=$_POST["id"];
$mysqli->query("Delete FROM cart where id=$id and Username='$user'");
//echo "In delete";
header("location:cart_viewvik.php");
?>