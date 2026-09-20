# 🎮 GameKart - Online Gaming E-Commerce Portal

A full-featured gaming e-commerce and store management web application built with **PHP**, **MySQL**, **Bootstrap 5**, and **JavaScript**.

---

## 🌟 Key Features

### 👤 Customer (Client) Portal
- **Interactive Storefront**: Browse gaming consoles, accessories, monitors, GPUs, and peripherals.
- **Product Details**: High-resolution image previews, specs, pricing, and stock status.
- **Dynamic Shopping Cart**: Real-time quantity adjustments, cart totals, and item management.
- **UPI & Payment Gateway**: Dynamic QR Code generation for seamless UPI payments.
- **Order Management**: View order status, order history, tracking IDs, and order details.
- **User Authentication**: Secure customer registration and login with session management.
- **User Profile**: Update personal profile information and contact details.

### 🛡️ Admin Management Panel
- **Admin Dashboard**: Real-time sales statistics, revenue, total orders, and user counts.
- **Product Catalog Management**: Add, update, view, and delete products with image upload support.
- **Order Processing**: Manage orders, approve/update shipment status, and monitor payments.
- **User Management**: View registered users, account details, and activity.

---

## 🛠️ Tech Stack

- **Backend**: PHP (Procedural & Object-Oriented MySQLi)
- **Database**: MySQL (`kmart.sql`)
- **Frontend**: HTML5, CSS3, JavaScript (jQuery, Bootstrap 5)
- **Styling**: Custom Modern Glassmorphic Dark UI & Responsive Layouts
- **Server Environment**: Apache / XAMPP / WAMP

---

## 🚀 Getting Started

### 1. Prerequisites
- [XAMPP](https://www.apachefriends.org/) (PHP 7.4+ or PHP 8.x, Apache & MySQL)
- Web Browser (Chrome, Edge, Firefox)

### 2. Installation Steps
1. Clone or download this repository into your XAMPP web root directory:
   ```bash
   # Windows default XAMPP path
   cd C:\xampp\htdocs\
   git clone https://github.com/samarth163-cloud/gamekart.git php
   ```
2. Start **Apache** and **MySQL** from the XAMPP Control Panel.

### 3. Database Configuration
1. Open your browser and navigate to `http://localhost/phpmyadmin/`.
2. Create a new database named `kmart`.
3. Import the SQL file located at:
   ```
   assets/kmart.sql
   ```
4. Verify database connection credentials in `conn.php`:
   ```php
   $hostname = "127.0.0.1";
   $username = "root";
   $password = "";
   $database = "kmart";
   ```

### 4. Running the Website
Open your browser and visit:
```
http://localhost/php/index.php
```

---

## 🔐 Default Access & Credentials

- **Client Portal**: `http://localhost/php/clogin.php`
- **Admin Portal**: `http://localhost/php/aLogin.php`
- **Admin Username**: `admin`
- **Admin Password**: `admin123` *(or check users table in `kmart.sql`)*

---

## 📁 Project Structure

```
├── assets/                  # CSS, JavaScript libraries, and database SQL dump
│   ├── bootstrap.min.css
│   ├── bootstrap.min.js
│   ├── jquery.min.js
│   └── kmart.sql            # Database schema and sample data
├── images/                  # Product photos, icons, and hero banners
├── screenshots/             # Application screenshots & UI previews
├── doc_images/              # System architecture, ER, DFD, and Flowcharts
├── conn.php                 # MySQL Database Connection Script
├── index.php                # Landing / Gateway Page
├── chome.php                # Main Customer Storefront
├── clogin.php               # Customer Login
├── cregister.php            # Customer Registration
├── cart.php                 # Shopping Cart & Checkout
├── placeorder.php           # Order Processing Backend
├── orders.php               # Customer Order History
├── cviewproduct.php         # Product Detail View
├── ccontact.php             # Contact Us Page
├── aLogin.php               # Admin Login
├── dashboard.php            # Admin Dashboard
├── products.php             # Admin Products Management
├── aorder.php               # Admin Orders Management
└── users.php                # Admin Users Management
```

---

## 📜 License
This project is open-source and available under the [MIT License](LICENSE).
