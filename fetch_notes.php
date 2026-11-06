<?php
header("Content-Type: application/json");

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "notes_app";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Database connection failed"]);
    exit();
}

// Check if user_id is provided via GET request
if (isset($_GET['user_id'])) {
    $user_id = trim($_GET['user_id']);

    $stmt = $conn->prepare("SELECT id, title, content, create_at FROM notes WHERE user_id = ? ORDER BY create_at DESC");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $notes = array();
    while ($row = $result->fetch_assoc()) {
        $notes[] = $row;
    }

    echo json_encode(["status" => "success", "notes" => $notes]);

    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "Missing user_id parameter"]);
}

$conn->close();
?>