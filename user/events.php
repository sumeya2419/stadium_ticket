<?php
include("../config/database.php");
include("../includes/auth_check.php");
include("../includes/header.php");

$result=$conn->query("
    SELECT e.*, v.name as venue 
    FROM events e
    JOIN venues v ON e.venue_id = v.id
    WHERE e.status='scheduled'
");
?>

<h2>Available Events</h2>

<table class="table table-bordered">
<tr>
    <th>Title</th>
    <th>Venue</th>
    <th>Date</th>
    <th>Action</th>
</tr>

<?php while($row=$result->fetch_assoc()){ ?>
<tr>
    <td><?= $row['title']; ?></td>
    <td><?= $row['venue']; ?></td>
    <td><?= $row['event_date']; ?></td>
    <td>
        <a class="btn btn-success btn-sm" href="buy.php?event_id=<?= $row['id']; ?>">
            Buy Ticket
        </a>
    </td>
</tr>
<?php } ?>
</table>

<?php include("../includes/footer.php"); ?>
