<?php
// config.php
// Author: Rick Hayes
// License: MIT
// Version: 1.1

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', ''); // Set your MySQL password
define('DB_NAME', 'patient_management');
define('ENCRYPTION_KEY', base64_encode(openssl_random_pseudo_bytes(32))); // In production, store securely (e.g., .env)
define('SITE_URL', 'https://yourdomain.com/patient_management_system_php_enhanced/'); // Update for HTTPS deployment
define('EMAIL_HOST', 'smtp.example.com'); // Update with your SMTP host
define('EMAIL_USER', 'your-email@example.com'); // Update with your email
define('EMAIL_PASS', 'your-email-password'); // Update with your email password
