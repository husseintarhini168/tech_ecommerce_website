<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $email = $_POST['email'];
   $address = $_POST['address'];
   $pass1 = $con->prepare("SELECT password FROM users WHERE id = ? and status=0");
   $pass1->execute([$user_id]);
   $result = $pass1->fetch(); 
   $update_profile = $con->prepare("UPDATE `users` SET name = ?, email = ?,address=? WHERE id = ?");
   $update_profile->execute([$name, $email,$address, $user_id]);
   $prev_pass = $_POST['prev_pass'];
   $old_pass = $_POST['old_pass'];
   $new_pass = $_POST['new_pass'];
   $confirm_pass = $_POST['confirm_pass'];

   if ($old_pass === '') {
      echo '
      <div class="message">
      <span>please enter old password!</span>
   </div>
      ';
   } elseif ($old_pass !== $result['password']) {
      echo '
      <div class="message">
      <span>old password not matched!</span>
   </div>
      ';
   } elseif ($new_pass !== $confirm_pass) {
      echo '
      <div class="message">
      <span>confirm password not matched!</span>
   </div>
      ';
   } else {
      if ($new_pass !== '') {
         $update_admin_pass = $con->prepare("UPDATE `users` SET password = ? WHERE id = ? and status=0");
         $update_admin_pass->execute([$new_pass, $user_id]);
         echo '
         <div class="message">
         <span>password updated successfully!</span>
        
      </div>
         ';
      } else {
         echo '
         <div class="message">
         <span>please enter a new password!</span>
       
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
   <title>register</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css//style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="form-container">

   <form action="" method="post">
      <h3>update now</h3>
      <input type="hidden" name="prev_pass" value="<?= $fetch_profile["password"]; ?>">
      <input type="text" name="name" required placeholder="enter your username" maxlength="20"  class="box" value="<?= $fetch_profile["name"]; ?>">
      <input type="email" name="email" required placeholder="enter your email" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')" value="<?= $fetch_profile["email"]; ?>">
      <input type="text" name="address" required placeholder="enter your address"  class="box" <?= $fetch_profile["address"]; ?>">
      <input type="password" name="old_pass" placeholder="enter your old password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="new_pass" placeholder="enter your new password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="confirm_pass" placeholder="confirm your new password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="update now" class="btn" name="submit">
   </form>

</section>













<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>