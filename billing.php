<?php
// billing.php
// Author: Rick Hayes
// License: MIT
// Version: 1.0

require_once 'db.php';

function create_invoice($patient_id, $amount, $description) {
    $conn = get_db();
    $stmt = $conn->prepare("INSERT INTO billing (patient_id, amount, description) VALUES (?, ?, ?)");
    $stmt->bind_param("ids", $patient_id, $amount, $description);
    $stmt->execute();
    $id = $conn->insert_id;
    $stmt->close();
    return $id;
}

function get_invoices($patient_id) {
    $conn = get_db();
    $stmt = $conn->prepare("SELECT id, amount, description, paid FROM billing WHERE patient_id = ?");
    $stmt->bind_param("i", $patient_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $invoices = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $invoices;
}
