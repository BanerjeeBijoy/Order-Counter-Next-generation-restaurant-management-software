<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $user_type = $_POST['user_type'];

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'user already exist!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         mysqli_query($conn, "INSERT INTO `users`(name, email, password, user_type) VALUES('$name', '$email', '$cpass', '$user_type')") or die('query failed');
         $message[] = 'registered successfully!';
         header('location:index.php');
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- font awesome cdn link  
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">-->

   <!-- custom css file link
   <link rel="stylesheet" href="css/style.css">-->
   <link rel="stylesheet" href="style1.css">

</head>
<body>



<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
   
<div class="form-container">
<form action="" method="post">
   <h3>REGISTER NEW USER</h3>
   <h5>(USE BY THE ADMIN ONLY)</h5>
   <br>
   <input type="text" name="name" placeholder="ENTER NAME" required class="box">
   <input type="text" name="email" placeholder="ENTER USER ID" required class="box">
   <input type="password" name="password" placeholder="ENTER PASSWORD" required class="box">
   <input type="password" name="cpassword" placeholder="CONFIRM PASSWORD" required class="box">
   <select name="user_type" class="box">
      <option value="user">ATTENDANT</option>
      <option value="admin">MANAGER</option>
   </select>
   <input type="submit" name="submit" value=" REGISTER " class="btn">
   <br>
   <p>already have an account? <a class="reg" href="index.php">LOGIN NOW</a></p>
</form>
</div>

</body>
</html>