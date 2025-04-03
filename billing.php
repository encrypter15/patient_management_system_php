<?php
// billing.php
// Author: Rick Hayes
// License: MIT
// Version: 1.1

require_once 'db.php';
require_once 'vendor/fpdf/fpdf.php';

function create_invoice($patient_id, $amount, $description) {
    $conn = get_db();
    $stmt = $conn->prepare("INSERT INTO billing (patient_id, amount, description) VALUES (?, ?, ?)");
    $stmt->bind_param("ids", $patient_id, $amount, $description);
    $stmt->execute();
    $id = $conn->insert_id;
    $stmt->close();
    generate_pdf_invoice($id, $patient_id, $amount, $description);
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

function generate_pdf_invoice($invoice_id, $patient_id, $amount, $description) {
    $conn = get_db();
    $stmt = $conn->prepare("SELECT name FROM patients WHERE id = ?");
    $stmt->bind_param("i", $patient_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $patient = $result->fetch_assoc();
    $stmt->close();

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Invoice #' . $invoice_id, 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'Patient: ' . $patient['name'], 0, 1);
    $pdf->Cell(0, 10, 'Amount: $' . $amount, 0, 1);
    $pdf->Cell(0, 10, 'Description: ' . $description, 0, 1);
    $pdf->Output('F', "invoices/invoice_$invoice_id.pdf");
}
