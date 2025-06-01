<?php

$conn = new mysqli("localhost", "root", "", "cafetaria");
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
/*CREATE TABLE contacts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    message VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);*/
?>