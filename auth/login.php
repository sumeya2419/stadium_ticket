<?php
include("../config/database.php");

if(isset($_POST['login'])){

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $_POST['email']);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if($user && password_verify($_POST['password'],$user['password'])){
        $_SESSION['user_id']=$user['id'];
        $_SESSION['role']=$user['role'];

        if($user['role']=="admin"){
            header("Location: ../admin/dashboard.php");
        } else {
            header("Location: ../user/events.php");
        }
    } else {
        echo "Invalid login";
    }
}
?>

<h2>Login</h2>
<form method="POST">
Email:<input type="email" name="email"><br>
Password:<input type="password" name="password"><br>
<button name="login">Login</button>
</form>
