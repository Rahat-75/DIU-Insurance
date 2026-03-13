1. # DIU-Insurance

A simple web-based insurance management system built with PHP and MySQL.

## What I Did in This Project

This project is an insurance management application with three main user roles: Admin, Staff, and User. It allows managing insurance policies, categories, sub-categories, user accounts, staff assignments, and support tickets. The system includes features like policy approval/denial, reporting, email notifications, and PDF generation for policies.

### Key Features
- **Admin Panel**: Manage policies, categories, staff, users, tickets, and system settings.
- **Staff Panel**: View assigned tasks, manage tickets, and update profiles.
- **User Panel**: Apply for policies, view applications, and submit support tickets.
- **Ticket System**: Create, assign, and close support tickets.
- **Reports**: Generate general reports and policy downloads.
- **Email Integration**: Send notifications using SMTP.
- **PDF Generation**: Create policy documents using TCPDF.

## Technologies Used
- PHP
- MySQL
- HTML, CSS, JavaScript
- TCPDF (for PDF generation)
- PHPMailer (for email)

## Installation

1. Download or clone the repository.
2. Set up XAMPP or similar local server with PHP and MySQL.
3. Create a database named `diu-insurance` in phpMyAdmin.
4. Import the `Database.sql` file from the `MySQL` folder.
5. Place the project in your web server's root directory (e.g., `htdocs`).
6. Run the project by visiting: `http://localhost/DIU-Insurance/Script/`

## Usage

- **Admin Login**: Use admin credentials to access the admin dashboard.
- **Staff Login**: Staff can log in to manage assigned tasks.
- **User Registration/Login**: Users can register, apply for policies, and view their applications.
