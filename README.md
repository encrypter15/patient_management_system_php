# Patient Management System (PHP Enhanced)
![Patient Management System Logo](https://github.com/encrypter15/patient_management_system_php/blob/main/logo.jpg)
**Author**: Rick Hayes  
**License**: MIT  
**Version**: 1.1  

A PHP-based system for managing patient records, appointments, and billing in a doctor's office, with HIPAA-compliant encryption and enhanced features.

## Features
- **HIPAA-Compliant Encryption**: Encrypts sensitive data (e.g., SSN) using `defuse/php-encryption`.
- **Authentication**: User login with PHP sessions.
- **Security**: CSRF protection and input validation.
- **Appointment Scheduler**: Manage patient appointments with email reminders via PHPMailer.
- **Invoicing**: Create and track patient invoices with PDF generation via FPDF.
- **Web Interface**: PHP-driven pages with Bootstrap styling.

## Requirements
- Apache Server (e.g., XAMPP) with HTTPS enabled
- PHP 7.4+ with OpenSSL
- MySQL
- Composer: `composer install`

## Setup
1. Place in `htdocs` (e.g., `C:\xampp\htdocs\patient_management_system_php_enhanced`).
2. Run `composer install`.
3. Configure `config.php` with your SMTP and database credentials.
4. Enable HTTPS in Apache (see Deployment section).
5. Start Apache and MySQL.
6. Access at `https://localhost/patient_management_system_php_enhanced/`.
7. Login with default credentials: `admin` / `password123`.

## Deployment
- **HTTPS**: Configure Apache with an SSL certificate (e.g., self-signed or via Let's Encrypt).
  - Edit `httpd-ssl.conf` and set `SSLCertificateFile` and `SSLCertificateKeyFile`.
  - Update `SITE_URL` in `config.php`.
- **Secure Encryption Key**: Move `ENCRYPTION_KEY` to a `.env` file and load with a library like `vlucas/phpdotenv`.
- Create an `invoices/` directory writable by the web server for PDF storage.

## Change Log
- **Version 1.1 (2025-04-03)**:
  - Added user authentication with PHP sessions.
  - Implemented CSRF protection and input validation.
  - Added appointment reminders with PHPMailer.
  - Added PDF invoice generation with FPDF.
  - Improved UI with Bootstrap.
  - Updated for HTTPS deployment.
- **Version 1.0 (2025-04-03)**: Initial release with core features.
