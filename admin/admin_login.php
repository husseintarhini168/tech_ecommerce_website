<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- link for the font -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
<?php

    if(isset($_GET['flag'])){
        if($_GET['flag']==1)
            echo '
            <div class="message">
            <span>Wrong email or Password!!</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
            ';
        
} 


?>
    <section class="form-container">
        <form action="admin_login_work.php" method="post">
            <h3>Login</h3>
            <p>default email=<span>admin@gmail.com</span> &password=<span>111</span></p>
            <input type="email" name="email" class="box" required placeholder="enter your email
            " >

            <input type="password" name="pass" required placeholder="enter your password"  class="box">
            <input type="submit" value="login now" class="btn" name="submit">


        </form>


    </section>

</body>

</html>