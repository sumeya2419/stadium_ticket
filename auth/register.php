<?php
include("../config/database.php");
include("../includes/header.php");

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
        echo "<div class='alert alert-success'>Registered Successfully</div>";
    }
}
?>

<h2>Register</h2>

<form method="POST" class="col-md-6">
    <div class="mb-3">
        <input class="form-control" type="text" name="name" placeholder="Name" required>
    </div>
    <div class="mb-3">
        <input class="form-control" type="email" name="email" placeholder="Email" required>
    </div>
    <div class="mb-3">
        <input class="form-control" type="text" name="phone" placeholder="Phone">
    </div>
    <div class="mb-3">
        <input class="form-control" type="password" name="password" placeholder="Password" required>
    </div>
    <button class="btn btn-primary" name="register">Register</button>
</form>

<?php include("../includes/footer.php"); ?>
