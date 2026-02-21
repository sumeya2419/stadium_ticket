<?php
include("../config/database.php");
include("../includes/auth_check.php");
include("../includes/header.php");

$user_id = $_SESSION['user_id'];

if(isset($_GET['cancel'])){
    $id = $_GET['cancel'];
    $conn->query("UPDATE orders SET status='cancelled' WHERE id=$id AND user_id=$user_id");
}

$result = $conn->query("
    SELECT o.*, e.title 
    FROM orders o
    JOIN events e ON o.event_id = e.id
    WHERE o.user_id = $user_id
");
?>

<h2>My Orders</h2>

<table class="table table-bordered">
<tr>
    <th>Event</th>
    <th>Total</th>
    <th>Status</th>
    <th>Action</th>
</tr>

<?php while($row = $result->fetch_assoc()){ ?>
<tr>
    <td><?= $row['title']; ?></td>
    <td><?= $row['total_amount']; ?></td>
    <td><?= $row['status']; ?></td>
    <td>
        <?php if($row['status']=='paid'){ ?>
            <a class="btn btn-warning btn-sm" href="?cancel=<?= $row['id']; ?>">Cancel</a>
        <?php } ?>
    </td>
</tr>
<?php } ?>
</table>

<?php include("../includes/footer.php"); ?>