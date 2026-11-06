<?php
// Tell the browser/app that we are returning JSON data
header('Content-Type: application/json');

//Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "notes_app";

// 1. Connect to MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if connection failed
if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Database connection failed."]);
    exit();
}

// 2. Get the data sent from the Android app (sent as Post request)
$user = $_POST['username'] ?? '';
$pass = $_POST['password'] ?? '';

// check if fields are empty
if (empty($user) || empty($pass)) {
    echo json_encode(["status" => "error", "message" => "Username and password are required."]);
    exit();
}

// 3. SECURE STEP: Hash the password before storing it in the database
$hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

// 4. Insert the user into the database securily using prepared statements
$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $user, $hashedPassword);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "User registered successfully."]);
} else {
    echo json_encode(["status" => "error", "message" => "Error registering user."]);
}

$stmt->close();
$conn->close();

// Close databse connections

?>