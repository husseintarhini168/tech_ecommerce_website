<?php
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['user_info']['id'];



if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['submit'])){
   // Update profile code

   $name = $_POST['name'];
   $email = $_POST['email'];
   $address=$_POST['address'];
   $pass1 = $con->prepare("SELECT password FROM users WHERE id = ?");
   $pass1->execute([$admin_id]);
   $result = $pass1->fetch(); 
   $update_profile_name = $con->prepare("UPDATE `users` SET name = ? WHERE id = ? and status=1");
   $update_profile_name->execute([$name, $admin_id]);

   $update_profile_email= $con->prepare("UPDATE `users` SET email = ? WHERE id = ? and status=1");
   $update_profile_email->execute([$email, $admin_id]);

   $update_profile_address = $con->prepare("UPDATE `users` SET address = ? WHERE id = ? and status=1");
   $update_profile_address->execute([$address, $admin_id]);

   $prev_pass = $_POST['prev_pass'];
   $old_pass = $_POST['old_pass'];
   $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
   $new_pass = $_POST['new_pass'];
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   $confirm_pass = $_POST['confirm_pass'];
   $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

   if ($old_pass === '') {
      echo '
      <div class="message">
      <span>please enter old password!</span>
      <i class="fas fa-times" ></i>
   </div>
      ';
   } elseif ($old_pass !== $result['password']) {
      echo '
      <div class="message">
      <span>old password not matched!</span>
      <i class="fas fa-times" ></i>
   </div>
      ';
   } elseif ($new_pass !== $confirm_pass) {
      echo '
      <div class="message">
      <span>confirm password not matched!</span>
      <i class="fas fa-times" ></i>
   </div>
      ';
   } else {
      if ($new_pass !== '') {
         $update_admin_pass = $con->prepare("UPDATE `users` SET password = ? WHERE id = ? and status=1");
         $update_admin_pass->execute([$new_pass, $admin_id]);
         echo '
         <div class="message">
         <span>password updated successfully!</span>
         <i class="fas fa-times" ></i>
      </div>
         ';
      } else {
         echo '
         <div class="message">
         <span>please enter a new password!</span>
         <i class="fas fa-times" ></i>
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
   <title>update profile</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="form-container">

   <form action="" method="post">
      <h3>update profile</h3>
      <input type="hidden" name="prev_pass" value="<?= $fetch_profile['password']; ?>">
      <input type="text" name="name"  required placeholder="enter your username" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="email" name="email"  required placeholder="enter your email"   class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="text" name="address"  required placeholder="enter your address"   class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="old_pass" placeholder="enter old password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="new_pass" placeholder="enter new password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="confirm_pass" placeholder="confirm new password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="update now" class="btn" name="submit">
   </form>

</section>












<script src="../js/admin_script.js"></script>
   
</body>
</html>