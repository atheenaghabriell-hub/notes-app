<?php
header("Content-Type: application/json");

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "notes_app";

// Create connection using MySQLi
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Database connection failed"]);
    exit();
}

// Check if request is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve data sent from Android
    $user_id = isset($_POST['user_id']) ? trim($_POST['user_id']) : '';
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $content = isset($_POST['content']) ? trim($_POST['content']) : '';

    // Validate inputs
    if (empty($user_id) || empty($title) || empty($content)) {
        echo json_encode(["status" => "error", "message" => "Please fill in all fields"]);
        exit();
    }

    // Use prepared statements to securely insert the note
    $stmt = $conn->prepare("INSERT INTO notes (user_id, title, content) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $title, $content);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Note created successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to create note"]);
    }

    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
}

$conn->close();
?>