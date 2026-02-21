<?php
include("../config/database.php");
include("../includes/admin_check.php");
include("../includes/header.php");

$result = $conn->query("
    SELECT o.*, u.name, e.title
    FROM orders o
    JOIN users u ON o.user_id = u.id
    JOIN events e ON o.event_id = e.id
");
?>

<h2>All Orders</h2>

<table class="table table-bordered">
<tr>
    <th>User</th>
    <th>Event</th>
    <th>Total</th>
    <th>Status</th>
</tr>

<?php while($row=$result->fetch_assoc()){ ?>
<tr>
    <td><?= $row['name']; ?></td>
    <td><?= $row['title']; ?></td>
    <td><?= $row['total_amount']; ?></td>
    <td><?= $row['status']; ?></td>
</tr>
<?php } ?>
</table>

<?php include("../includes/footer.php"); ?>