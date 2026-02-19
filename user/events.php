<?php
include("../config/database.php");
include("../includes/auth_check.php");

$result=$conn->query("SELECT * FROM events WHERE status='scheduled'");
?>

<h2>Available Events</h2>

<?php while($row=$result->fetch_assoc()){ ?>
<?= $row['title']; ?> -
<a href="buy.php?event_id=<?= $row['id']; ?>">Buy</a>
<br>
<?php } ?>
