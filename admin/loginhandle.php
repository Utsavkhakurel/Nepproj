<?php

if($_SERVER['REQUEST_METHOD'] !='POST'){
    header(header: 'Location: login.php');
    exit();
}
$user_email =$_POST['email'];
$user_password= $_POST['password'];



include 'db-conn.php';

$query="SELECT * FROM login WHERE  email=? AND password=?";
$mysql_stmt= mysqli_prepare($conn , $query);
mysqli_stmt_bind_param($mysql_stmt, 'ss',$user_email, $user_password);
mysqli_stmt_execute($mysql_stmt);
$mysqli_result=mysqli_stmt_get_result($mysql_stmt);
$data = mysqli_fetch_assoc($mysqli_result);
 
 echo '<pre>';
  var_dump($data);
 echo '</pre>';
 
 if ($data)
 {
    session_start();
    $_SESSION['is_Loggedin']= true;
    header(header:"Location: home.php");
 }
 else{
    header(header:"location:login.php?error=email or password is incorrect");
 }


?>