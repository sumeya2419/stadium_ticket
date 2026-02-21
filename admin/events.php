<?php
session_start();
require_once("../config/database.php");

// Redirect if not admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

$edit = false;
$event = [];

// ADD EVENT
if (isset($_POST['add'])) {

    $title = $_POST['title'];
    $venue_id = $_POST['venue_id'];
    $event_date = $_POST['event_date'];
    $start_time = $_POST['start_time'];

    $stmt = $conn->prepare("INSERT INTO events (title, venue_id, event_date, start_time, status) VALUES (?, ?, ?, ?, 'scheduled')");
    $stmt->bind_param("siss", $title, $venue_id, $event_date, $start_time);
    $stmt->execute();

    header("Location: events.php");
    exit();
}

// LOAD EVENT FOR EDITING
if (isset($_GET['edit'])) {
    $edit = true;
    $id = $_GET['edit'];

    $stmt = $conn->prepare("SELECT * FROM events WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $event = $result->fetch_assoc();
}

// UPDATE EVENT
if (isset($_POST['update'])) {

    $id = $_POST['id'];
    $title = $_POST['title'];
    $venue_id = $_POST['venue_id'];
    $event_date = $_POST['event_date'];
    $start_time = $_POST['start_time'];

    $stmt = $conn->prepare("UPDATE events SET title=?, venue_id=?, event_date=?, start_time=? WHERE id=?");
    $stmt->bind_param("sissi", $title, $venue_id, $event_date, $start_time, $id);
    $stmt->execute();

    header("Location: events.php");
    exit();
}

// DELETE EVENT
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $stmt = $conn->prepare("DELETE FROM events WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header("Location: events.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Events</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <h2 class="mb-4">Manage Events</h2>

    <!-- EVENT FORM -->
    <div class="card mb-4">
        <div class="card-body">

            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">Event Title</label>
                    <input type="text" name="title" class="form-control"
                        value="<?php echo $edit ? $event['title'] : ''; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Venue</label>
                    <select name="venue_id" class="form-control" required>
                        <?php
                        $venues = $conn->query("SELECT * FROM venues");
                        while ($row = $venues->fetch_assoc()) {
                        ?>
                            <option value="<?php echo $row['id']; ?>"
                                <?php if ($edit && $row['id'] == $event['venue_id']) echo 'selected'; ?>>
                                <?php echo $row['name']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Event Date</label>
                    <input type="date" name="event_date" class="form-control"
                        value="<?php echo $edit ? $event['event_date'] : ''; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Start Time</label>
                    <input type="time" name="start_time" class="form-control"
                        value="<?php echo $edit ? $event['start_time'] : ''; ?>" required>
                </div>

                <?php if ($edit): ?>
                    <input type="hidden" name="id" value="<?php echo $event['id']; ?>">
                    <button type="submit" name="update" class="btn btn-primary">Update Event</button>
                    <a href="events.php" class="btn btn-secondary">Cancel</a>
                <?php else: ?>
                    <button type="submit" name="add" class="btn btn-success">Add Event</button>
                <?php endif; ?>

            </form>

        </div>
    </div>

    <!-- EVENTS TABLE -->
    <div class="card">
        <div class="card-body">

            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Venue</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                $result = $conn->query("SELECT events.*, venues.name AS venue_name 
                                        FROM events 
                                        JOIN venues ON events.venue_id = venues.id
                                        ORDER BY events.id DESC");

                while ($row = $result->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['venue_name']; ?></td>
                        <td><?php echo $row['event_date']; ?></td>
                        <td><?php echo $row['start_time']; ?></td>
                        <td>
                            <a href="events.php?edit=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="events.php?delete=<?php echo $row['id']; ?>" 
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>

        </div>
    </div>

</div>

</body>
</html>