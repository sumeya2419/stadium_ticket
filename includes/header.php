<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Stadium Ticket System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#">Stadium Ticket</a>

    <div>
      <?php if(isset($_SESSION['user_id'])){ ?>
          <?php if($_SESSION['role']=="admin"){ ?>
              <a class="btn btn-outline-light btn-sm" href="/stadium_ticket/admin/dashboard.php">Admin</a>
          <?php } ?>
          <a class="btn btn-outline-light btn-sm" href="/stadium_ticket/user/events.php">Events</a>
          <a class="btn btn-outline-light btn-sm" href="/stadium_ticket/user/orders.php">My Orders</a>
          <a class="btn btn-danger btn-sm" href="/stadium_ticket/auth/logout.php">Logout</a>
      <?php } else { ?>
          <a class="btn btn-outline-light btn-sm" href="/stadium_ticket/auth/login.php">Login</a>
          <a class="btn btn-outline-light btn-sm" href="/stadium_ticket/auth/register.php">Register</a>
      <?php } ?>
    </div>
  </div>
</nav>

<div class="container mt-4">
