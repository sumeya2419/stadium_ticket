<?php
include("../config/database.php");
include("../includes/header.php");

if(isset($_POST['login'])){
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $_POST['email']);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if($user && password_verify($_POST['password'],$user['password'])){
        $_SESSION['user_id']=$user['id'];
        $_SESSION['role']=$user['role'];
        header("Location: ../user/events.php");
    } else {
        echo "<div class='alert alert-danger'>Invalid Login</div>";
    }
}
?>

<h2>Login</h2>

<form method="POST" class="col-md-6">
    <div class="mb-3">
        <input class="form-control" type="email" name="email" placeholder="Email">
    </div>
    <div class="mb-3">
        <input class="form-control" type="password" name="password" placeholder="Password">
    </div>
    <button class="btn btn-primary" name="login">Login</button>
</form>

<?php include("../includes/footer.php"); ?>
