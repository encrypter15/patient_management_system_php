<?php
// index.php
// Author: Rick Hayes
// License: MIT
// Version: 1.1

require_once 'auth.php';
require_once 'db.php';
init_db();
require_login();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Patient Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Welcome to Patient Management System</h1>
        <div class="text-center">
            <a href="add_patient.php" class="btn btn-success">Add New Patient</a>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-info mt-3"><?php echo htmlspecialchars($_SESSION['message']); unset($_SESSION['message']); ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
