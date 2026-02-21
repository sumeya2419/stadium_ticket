<?php
include("../config/database.php");
include("../includes/admin_check.php");
include("../includes/header.php");

$total_events = $conn->query("SELECT COUNT(*) as total FROM events")->fetch_assoc()['total'];
$total_orders = $conn->query("SELECT COUNT(*) as total FROM orders")->fetch_assoc()['total'];
$total_revenue = $conn->query("SELECT SUM(total_amount) as total FROM orders WHERE status='paid'")->fetch_assoc()['total'];
?>

<h2>Admin Dashboard</h2>

<div class="row">
    <div class="col-md-4">
        <div class="card bg-primary text-white p-3">
            <h5>Total Events</h5>
            <h3><?= $total_events ?></h3>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white p-3">
            <h5>Total Orders</h5>
            <h3><?= $total_orders ?></h3>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-dark text-white p-3">
            <h5>Total Revenue</h5>
            <h3><?= $total_revenue ?? 0 ?></h3>
        </div>
    </div>
</div>

<hr>

<a class="btn btn-primary" href="events.php">Manage Events</a>
<a class="btn btn-secondary" href="ticket_types.php">Manage Ticket Types</a>
<a class="btn btn-info" href="orders.php">View Orders</a>

<?php include("../includes/footer.php"); ?>