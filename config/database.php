<?php
$conn = new mysqli("localhost","root","","stadium_ticket_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
?>
