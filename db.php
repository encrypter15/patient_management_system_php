<?php
// db.php
// Author: Rick Hayes
// License: MIT
// Version: 1.0

require_once 'config.php';

function init_db() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS);
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

    $conn->query("CREATE DATABASE IF NOT EXISTS " . DB_NAME);
    $conn->select_db(DB_NAME);

    $conn->query("CREATE TABLE IF NOT EXISTS patients (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        dob DATE NOT NULL,
        encrypted_ssn BLOB NOT NULL
    )");

    $conn->query("CREATE TABLE IF NOT EXISTS appointments (
        id INT AUTO_INCREMENT PRIMARY KEY,
        patient_id INT,
        date DATE NOT NULL,
        time TIME NOT NULL,
        reason TEXT,
        FOREIGN KEY (patient_id) REFERENCES patients(id)
    )");

    $conn->query("CREATE TABLE IF NOT EXISTS billing (
        id INT AUTO_INCREMENT PRIMARY KEY,
        patient_id INT,
        amount DECIMAL(10,2) NOT NULL,
        description TEXT,
        paid TINYINT DEFAULT 0,
        FOREIGN KEY (patient_id) REFERENCES patients(id)
    )");

    return $conn;
}

function get_db() {
    static $conn = null;
    if ($conn === null) $conn = init_db();
    return $conn;
}
