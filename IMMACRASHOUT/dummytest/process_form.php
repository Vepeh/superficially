<?php

$conn = new mysqli("localhost", "root", "", "kantin_db");
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
// Prepare and bind
$stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $message);
// Execute and respond
if ($stmt->execute()) {
    echo "Message saved successfully!";
} 
?>