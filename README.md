# Nebatech Student System

PHP student registration system with role-based registration and login for **admin**, **student**, and **facilitator**.

## Setup

1. Start **Apache** and **MySQL** in XAMPP.
2. Open once: [http://localhost/Nebatech-Student-System/setup.php](http://localhost/Nebatech-Student-System/setup.php)  
   Or import `database/schema.sql` in phpMyAdmin.
3. Register at [register.php](http://localhost/Nebatech-Student-System/register.php)
4. Login at [login.php](http://localhost/Nebatech-Student-System/login.php)

## Roles

| Role | Dashboard | Access |
|------|-----------|--------|
| Admin | `admin_dashboard.php` | Students, Add Student, Courses |
| Student | `student_dashboard.php` | Courses |
| Facilitator | `facilitator_dashboard.php` | Students, Courses |

## Project structure

```
Nebatech-Student-System/
├── index.php                 Redirects to role dashboard or login
├── login.php / register.php  Auth pages
├── authenticate.php          Login handler
├── logout.php
├── dashboard.php             Role router
├── admin_dashboard.php
├── student_dashboard.php
├── facilitator_dashboard.php
├── students.php / add_student.php / courses.php
├── setup.php                 Creates DB + users table
├── database/schema.sql
├── includes/
│   ├── auth.php
│   ├── db.php
│   ├── header.php
│   ├── sidebar.php
│   └── footer.php
└── css/style.css
```
