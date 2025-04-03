# Patient Management System (PHP)

**Author**: Rick Hayes  
**License**: MIT  
**Version**: 1.0  

A PHP-based system for managing patient records, appointments, and billing in a doctor's office, with HIPAA-compliant encryption.

## Features
- **HIPAA-Compliant Encryption**: Encrypts sensitive data (e.g., SSN) using `defuse/php-encryption`.
- **Appointment Scheduler**: Manage patient appointments.
- **Invoicing**: Create and track patient invoices.
- **Web Interface**: PHP-driven pages.

## Requirements
- Apache Server (e.g., XAMPP)
- PHP 7.4+ with OpenSSL
- MySQL
- Composer: `composer install`

## Setup
1. Place in `htdocs` (e.g., `C:\xampp\htdocs\patient_management_system_php`).
2. Run `composer install`.
3. Start Apache and MySQL.
4. Access at `http://localhost/patient_management_system_php/`.

## Change Log
- **Version 1.0 (2025-04-03)**: Initial release with core features (encryption, appointments, billing, PHP interface).
