🎟 Stadium Ticket Management System
📌 Project Overview

The Stadium Ticket Management System is a web-based application developed using Core PHP and MySQL.

The system allows:

Customers to register and purchase tickets for events

Administrators to manage venues, events, ticket types, and orders

Automatic ticket inventory control

Revenue tracking and order monitoring

This project demonstrates full CRUD operations, relational database design, and role-based authentication.

🛠 Technologies Used

PHP (Core PHP)

MySQL (Relational Database)

Bootstrap 5 (UI Styling)

XAMPP (Apache & MySQL Server)

🗂 Project Structure
stadium_ticket/
│
├── admin/
│   ├── dashboard.php
│   ├── events.php
│   ├── venues.php
│   ├── ticket_types.php
│   └── orders.php
│
├── auth/
│   ├── login.php
│   └── register.php
│
├── config/
│   └── database.php
│
├── purchase.php
├── my_orders.php
└── README.md
👥 User Roles
1️⃣ Admin

Admin can:

Create, update, delete venues

Create, update, delete events

Manage ticket types

View all customer orders

Track total revenue

2️⃣ Customer

Customer can:

Register and login

Browse events

Purchase tickets

View their orders

Cancel orders (if allowed)

🗄 Database Design
Tables:

users

venues

events

ticket_types

orders

order_items

Relationships:

One venue → Many events

One event → Many ticket types

One user → Many orders

One order → Many order items

Foreign keys are used to enforce data integrity.

🔐 Security Features

Password hashing using password_hash()

Prepared statements (Prevents SQL Injection)

Session-based authentication

Role-based access control

Foreign key constraints for database integrity
