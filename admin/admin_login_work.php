
<?php
    include('../components/connect.php');
    session_start();
    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = $_POST['pass'];
        $query = "SELECT * FROM users WHERE email=:email AND password=:password AND status=1";
        $stmt = $con->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['user_info'] = $row;
            header('location:dashboard.php');
        } else {
            header("location:admin_login.php?flag=1");
        }
    }
?>




