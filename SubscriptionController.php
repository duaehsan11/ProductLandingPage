<?php
include "database.php"; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);

    // Validate inputs
    if (empty($name) || empty($email)) {
        echo "<script>alert('Both Name and Email are required!'); window.location.href='index.html';</script>";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format!'); window.location.href='index.html';</script>";
        exit;
    }

    // Check if email already exists
    $check_query = "SELECT * FROM subscribers WHERE email = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('You are already subscribed!'); window.location.href='index.html';</script>";
    } else {
        // Insert subscriber into the database
        $insert_query = "INSERT INTO subscribers (name, email) VALUES (?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("ss", $name, $email);

        if ($stmt->execute()) {
            echo "<script>window.location.href='thank.php';</script>";
        } else {
            echo "<script>alert('Error occurred. Please try again.'); window.location.href='index.html';</script>";
        }
    }

    $stmt->close();
}

$conn->close();
?>
