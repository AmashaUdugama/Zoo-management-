<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $conn = new mysqli("localhost", "root", "", "zp_final");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize and validate input
    $donor_name = htmlspecialchars(trim($_POST['donor_name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $amount = floatval($_POST['amount']);
    $message = htmlspecialchars(trim($_POST['message']));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        $conn->close();
        exit();
    }

    if ($amount <= 0) {
        echo "Donation amount must be greater than zero";
        $conn->close();
        exit();
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO donations (donor_name, email, amount, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $donor_name, $email, $amount, $message);

    // Execute and check if successful
    if ($stmt->execute()) {
        echo "Thank you for your donation!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connections
    $stmt->close();
    $conn->close();
}
