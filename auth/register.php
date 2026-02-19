<?php
include("../config/database.php");

if(isset($_POST['register'])){

    $stmt = $conn->prepare("INSERT INTO users (name,email,phone,password) VALUES (?,?,?,?)");
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt->bind_param("ssss",
        $_POST['name'],
        $_POST['email'],
        $_POST['phone'],
        $password
    );

    if($stmt->execute()){
        header("Location: login.php");
    } else {
        echo "Error!";
    }
}
?>

<h2>Register</h2>
<form method="POST">
Name:<input type="text" name="name" required><br>
Email:<input type="email" name="email" required><br>
Phone:<input type="text" name="phone"><br>
Password:<input type="password" name="password" required><br>
<button name="register">Register</button>
</form>
