<?php
// index.php
// Author: Rick Hayes
// License: MIT
// Version: 1.0

session_start();
require_once 'db.php';
init_db();
?>
<!DOCTYPE html>
<html>
<head><title>Patient Management System</title></head>
<body>
    <h1>Welcome to Patient Management System</h1>
    <a href="add_patient.php">Add New Patient</a>
    <?php if (isset($_SESSION['message'])): ?>
        <p><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></p>
    <?php endif; ?>
</body>
</html>
