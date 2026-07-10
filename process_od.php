<?php
// Database configuration
$servername = "localhost";
$username = "root"; // Change as needed
$password = ""; // Change as needed
$dbname = "intranet_db"; // Change as needed

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$applicantName = $_POST['applicantName'];
$accountNumber = $_POST['accountNumber'];
$branch = $_POST['branch'];
$amountRequested = $_POST['amountRequested'];
$purpose = $_POST['purpose'];
$term = $_POST['term'];
$security = $_POST['security'];
$date = $_POST['date'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO overdraft_applications (applicant_name, account_number, branch, amount_requested, purpose, term, security, date_submitted) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $applicantName, $accountNumber, $branch, $amountRequested, $purpose, $term, $security, $date);

// Execute
if ($stmt->execute()) {
    echo "Application submitted successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Close connection
$stmt->close();
$conn->close();
?>