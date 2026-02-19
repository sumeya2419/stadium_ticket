<?php
include("../config/database.php");
include("../includes/admin_check.php");

if(isset($_POST['add'])){
    $stmt=$conn->prepare("INSERT INTO events (title,venue_id,event_date,start_time) VALUES (?,?,?,?)");
    $stmt->bind_param("siss",
        $_POST['title'],
        $_POST['venue_id'],
        $_POST['event_date'],
        $_POST['start_time']
    );
    $stmt->execute();
}

$result=$conn->query("SELECT * FROM events");
?>

<h2>Events</h2>

<form method="POST">
Title:<input name="title">
Venue ID:<input name="venue_id">
Date:<input type="date" name="event_date">
Time:<input type="time" name="start_time">
<button name="add">Add Event</button>
</form>

<hr>

<?php while($row=$result->fetch_assoc()){ ?>
<?= $row['title']; ?> - <?= $row['event_date']; ?><br>
<?php } ?>
