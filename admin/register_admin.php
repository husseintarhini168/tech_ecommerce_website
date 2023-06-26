
<?php
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['user_info']['id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $email = $_POST['email'];
   $pass = $_POST['pass'];
   $cpass =$_POST['cpass'];
   $address=$_POST['address'];

   $select_admin = $con->prepare("SELECT * FROM `users` WHERE email = ? ");
   $select_admin->execute([$email]);
   
   if($select_admin->rowCount() > 0){
      echo '
      <div class="message">
      <span>Email already exsist</span>
      <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
   </div>
      ';}
   else{
      if($pass != $cpass){
         echo '
      <div class="message">
      <span>confirm password not matched!</span>
      <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
   </div>
      ';
        
      }
      else{

   

         $insert_admin = $con->prepare("INSERT INTO `users`(name,email,password,address,status) VALUES(?,?,?,?,1)");
         $insert_admin->execute([$name,$email, $cpass,$address]);
         echo '
         <div class="message">
         <span>new admin registered successfully!</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
         ';
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
   <title>register admin</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>






<section class="form-container">

   <form action="" method="post">
      <h3>register now</h3>
      <input type="text" name="name" required placeholder="enter your name"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="text" name="address" required placeholder="enter your address"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="email" name="email" required placeholder="enter your email"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="enter your password"   class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" required placeholder="confirm your password"   class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      
      <input type="submit" value="register now" class="btn" name="submit">
   </form>

</section>












<script src="../js/admin_script.js"></script>
   
</body>
</html>