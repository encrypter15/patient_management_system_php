<?php
// appointments.php
// Author: Rick Hayes
// License: MIT
// Version: 1.0

require_once 'db.php';

function schedule_appointment($patient_id, $date, $time, $reason) {
    $conn = get_db();
    $stmt = $conn->prepare("INSERT INTO appointments (patient_id, date, time, reason) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $patient_id, $date, $time, $reason);
    $stmt->execute();
    $id = $conn->insert_id;
    $stmt->close();
    return $id;
}

function get_appointments($patient_id) {
    $conn = get_db();
    $stmt = $conn->prepare("SELECT id, date, time, reason FROM appointments WHERE patient_id = ?");
    $stmt->bind_param("i", $patient_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $appointments = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $appointments;
}
