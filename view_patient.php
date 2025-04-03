<?php
// view_patient.php
// Author: Rick Hayes
// License: MIT
// Version: 1.1

require_once 'auth.php';
require_once 'db.php';
require_once 'encryption.php';
require_once 'appointments.php';
require_once 'billing.php';
require_login();

$patient_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$patient_id) {
    $_SESSION['message'] = "No patient ID provided";
    header("Location: index.php");
    exit;
}

$conn = get_db();
$stmt = $conn->prepare("SELECT id, name, dob, encrypted_ssn FROM patients WHERE id = ?");
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$result = $stmt->get_result();
$patient = $result->fetch_assoc();
$stmt->close();

if (!$patient) {
    $_SESSION['message'] = "Patient not found";
    header("Location: index.php");
    exit;
}

$patient['ssn'] = $encryptor->decrypt($patient['encrypted_ssn']);
$appointments = get_appointments($patient_id);
$invoices = get_invoices($patient_id);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Patient Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Patient: <?php echo htmlspecialchars($patient['name']); ?></h1>
        <p><strong>DOB:</strong> <?php echo htmlspecialchars($patient['dob']); ?></p>
        <p><strong>SSN:</strong> <?php echo htmlspecialchars($patient['ssn']); ?></p>
        
        <h2>Appointments</h2>
        <ul class="list-group mb-3">
        <?php foreach ($appointments as $appt): ?>
            <li class="list-group-item"><?php echo htmlspecialchars($appt['date'] . ' at ' . $appt['time'] . ' - ' . $appt['reason']); ?></li>
        <?php endforeach; ?>
        </ul>
        
        <h2>Invoices</h2>
        <ul class="list-group mb-3">
        <?php foreach ($invoices as $invoice): ?>
            <li class="list-group-item"><?php echo htmlspecialchars($invoice['description'] . ' - $' . $invoice['amount'] . ' (' . ($invoice['paid'] ? 'Paid' : 'Unpaid') . ')'); ?></li>
        <?php endforeach; ?>
        </ul>
        
        <a href="index.php" class="btn btn-secondary">Back</a>
    </div>
</body>
</html>
