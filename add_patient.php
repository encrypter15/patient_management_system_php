<?php
// add_patient.php
// Author: Rick Hayes
// License: MIT
// Version: 1.0

session_start();
require_once 'db.php';
require_once 'encryption.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $ssn = $_POST['ssn'];
    $encrypted_ssn = $encryptor->encrypt($ssn);

    $conn = get_db();
    $stmt = $conn->prepare("INSERT INTO patients (name, dob, encrypted_ssn) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $dob, $encrypted_ssn);
    $stmt->execute();
    $patient_id = $conn->insert_id;
    $stmt->close();

    $_SESSION['message'] = "Patient added with ID: $patient_id";
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>Add Patient</title></head>
<body>
    <h1>Add New Patient</h1>
    <form method="POST">
        <label>Name: <input type="text" name="name" required></label><br>
        <label>DOB: <input type="date" name="dob" required></label><br>
        <label>SSN: <input type="text" name="ssn" required></label><br>
        <input type="submit" value="Add Patient">
    </form>
    <a href="index.php">Back</a>
</body>
</html>
