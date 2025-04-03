<?php
// appointments.php
// Author: Rick Hayes
// License: MIT
// Version: 1.1

require_once 'db.php';
require_once 'config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function schedule_appointment($patient_id, $date, $time, $reason) {
    $conn = get_db();
    $stmt = $conn->prepare("INSERT INTO appointments (patient_id, date, time, reason) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $patient_id, $date, $time, $reason);
    $stmt->execute();
    $id = $conn->insert_id;
    $stmt->close();
    send_appointment_reminder($patient_id, $date, $time, $reason);
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

function send_appointment_reminder($patient_id, $date, $time, $reason) {
    $conn = get_db();
    $stmt = $conn->prepare("SELECT name FROM patients WHERE id = ?");
    $stmt->bind_param("i", $patient_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $patient = $result->fetch_assoc();
    $stmt->close();

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = EMAIL_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = EMAIL_USER;
        $mail->Password = EMAIL_PASS;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom(EMAIL_USER, 'Patient Management System');
        $mail->addAddress('patient@example.com'); // Replace with actual patient email
        $mail->Subject = "Appointment Reminder";
        $mail->Body = "Dear {$patient['name']},\n\nYou have an appointment on $date at $time for: $reason.\n\nRegards,\nPatient Management System";
        $mail->send();
    } catch (Exception $e) {
        error_log("Reminder email failed: " . $mail->ErrorInfo);
    }
}
