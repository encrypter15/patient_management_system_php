<?php
// add_patient.php
// Author: Rick Hayes
// License: MIT
// Version: 1.1

require_once 'auth.php';
require_once 'db.php';
require_once 'encryption.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!validate_csrf_token($_POST['csrf_token'])) {
        $_SESSION['message'] = "Invalid CSRF token";
        header("Location: index.php");
        exit;
    }

    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $dob = filter_input(INPUT_POST, 'dob', FILTER_SANITIZE_STRING);
    $ssn = filter_input(INPUT_POST, 'ssn', FILTER_SANITIZE_STRING);
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
<head>
    <title>Add Patient</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Add New Patient</h1>
        <form method="POST" class="w-50 mx-auto">
            <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">DOB</label>
                <input type="date" name="dob" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">SSN</label>
                <input type="text" name="ssn" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Patient</button>
            <a href="index.php" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>
</html>
