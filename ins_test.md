# Kitchenary Deployment Guide

## Project Information

**Project:** Kitchenary

### Platform

* Raspberry Pi Zero 2W
* DietPi
* Apache2
* PHP
* MariaDB

---

# Backend Deployment Guide

## Initial Login

Connect through terminal:

```bash
ssh root@dietpi.local
```

or

```bash
ssh root@169.254.1.1
```

Default password:

```text
dietpi
```

---

## System Update

Update package list:

```bash
sudo apt update
```

Upgrade packages:

```bash
sudo apt upgrade
```

---

## Configure USB Networking

Verify USB interface:

```bash
ip addr show usb0
```

Expected:

```text
169.254.1.1
```

Verify Mac connection:

```bash
ping 169.254.1.1
```

---

## Install Apache

Install:

```bash
sudo apt install apache2
```

Verify installation:

```bash
sudo systemctl status apache2
```

Start Apache:

```bash
sudo systemctl start apache2
```

Enable startup:

```bash
sudo systemctl enable apache2
```

---

## Install PHP

Install PHP packages:

```bash
sudo apt install php libapache2-mod-php php-mysql
```

Verify:

```bash
php -v
```

Restart Apache:

```bash
sudo systemctl restart apache2
```

---

## Apache Testing

Test local server:

```bash
curl http://localhost
```

Expected:

```text
Apache2 Debian Default Page
```

---

## Create Project Directory

Navigate:

```bash
cd /var/www/html
```

Create folder:

```bash
sudo mkdir kitchenary
```

Verify:

```bash
ls
```

---

## Upload Project Files

Project location:

```text
/var/www/html/kitchenary
```

Files:

```text
index.php
login.php
logout.php
members.php
add_recipes.php
recipes_detail.php
db_connect.php
style.css
```

Verify:

```bash
ls /var/www/html/kitchenary
```

---

## Apache Issue Encountered

### Problem

Apache service failed

### Error

```text
AH02291:
Cannot access directory
'/var/log/apache2/'
```

### Diagnosis

```bash
sudo systemctl status apache2
sudo apachectl configtest
```

### Solution

```bash
sudo apt install --reinstall apache2
```

Verify log directory:

```bash
ls -ld /var/log/apache2
```

Restart:

```bash
sudo systemctl restart apache2
```

---

## Verify Kitchenary

### Local Test

```bash
curl http://localhost/kitchenary/index.php
```

### USB Test

```bash
curl http://169.254.1.1/kitchenary/index.php
```

### Browser

```text
http://169.254.1.1/kitchenary/
```

---

## Editing Files

Open file:

```bash
sudo nano filename.php
```

Save:

```text
CTRL + X
Y
ENTER
```

---

## Common Commands

### Check Apache

```bash
sudo systemctl status apache2
```

### Restart Apache

```bash
sudo systemctl restart apache2
```

### Project Directory

```bash
cd /var/www/html/kitchenary
```

### List Files

```bash
ls -la
```

### Current Directory

```bash
pwd
```

---

## MariaDB SetupЖ

Install MariaDB:

```bash
sudo apt install mariadb-server
```

Start service:

```bash
sudo systemctl start mariadb
```

Enable startup:

```bash
sudo systemctl enable mariadb
```

Verify installation:

```bash
sudo systemctl status mariadb
```

---

## Create Database

Login:

```bash
sudo mysql
```

Create database:

```sql
CREATE DATABASE kitchenary;
```

Select database:

```sql
USE kitchenary;
```

---

## Create Tables

### Users Table

```sql
CREATE TABLE users (
id INT AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(50) UNIQUE NOT NULL,
password VARCHAR(255) NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### Recipes Table

```sql
CREATE TABLE recipes (
id INT AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(255) NOT NULL,
category VARCHAR(100),
ingredients TEXT,
instructions TEXT,
image VARCHAR(255),
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

Verify:

```sql
SHOW TABLES;
```

Exit:

```sql
EXIT;
```

---

## Database Connection

Edit:

```bash
sudo nano db_connect.php
```

Connection settings:

```text
Host: localhost
Username: root
Password: (empty)
Database: kitchenary
```

---

## Test Connection

Create test file:

```text
test_db.php
```

Run:

```text
http://169.254.1.1/kitchenary/test_db.php
```

Expected:

```text
Connected successfully!
```

---

## Login Functionality

User login:

```text
login.php
```

User logout:

```text
logout.php
```

Authentication:

```text
PHP sessions and MariaDB
```

Status:

```text
Working successfully
```

---

## Current Status

### Working

* USB networking
* Apache2
* PHP
* CSS
* Kitchenary frontend

### Pending

* Recipe CRUD operations

Reason:

```text
Database schema is maintained separately and has not yet been deployed to the Raspberry Pi.
```

---

# Frontend Deployment & UI Verification Guide

This guide details the frontend architecture of **Kitchenary**, file structure validation, and the step-by-step User Interface (UI) verification process to ensure the responsive design and styling properties are functioning correctly.

---

## 📁 1. Frontend File Structure

Ensure all frontend assets, views, and styles are correctly uploaded to the project root directory on the Raspberry Pi at `/var/www/html/kitchenary/`.

The standard deployment file structure must look like this:

```text
/var/www/html/kitchenary/
├── style.css           # 🔒 Core stylesheet (Handles grids, full-bleed images, and link resets)
├── login.php           # User authentication entry view (Compact Grey-Card design)
├── index.php           # Responsive dashboard (Recipe Auto-Fill Grid System)
├── recipes_detail.php  # Detailed view page for individual recipe strings
├── add_recipes.php     # Custom recipe creation form sheet (With multipart image uploads)
├── members.php         # Group profile showcase view (Symmetrical ID Badges)
├── logout.php          # Session termination and routing handler
└── uploads/            # 📁 Destination folder for uploaded recipe graphics (chmod 777)
```
