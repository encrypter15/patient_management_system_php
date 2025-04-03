<?php
// config.php
// Author: Rick Hayes
// License: MIT
// Version: 1.0

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', ''); // Set your MySQL password
define('DB_NAME', 'patient_management');
define('ENCRYPTION_KEY', base64_encode(openssl_random_pseudo_bytes(32))); // 256-bit key
