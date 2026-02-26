<?php
include 'db_conn.php';

// Add the event
$title = "Winne Weds William";
$description = "Wedding celebration";
$event_date = "2026-03-01";
$location = "Rehoboth Christian Fellowship Masindi";

$stmt = $conn->prepare("INSERT INTO events (title, description, event_date, location) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $title, $description, $event_date, $location);

if ($stmt->execute()) {
    echo "✅ Event added successfully!";
    echo "\n📅 Event: " . $title;
    echo "\n📆 Date: " . $event_date;
} else {
    echo "❌ Error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
