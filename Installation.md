Raspberry Pi Backend Deployment Guide

Project Information

Project: Kitchenary

Platform:

* Raspberry Pi Zero 2W
* DietPi
* Apache2
* PHP
* MariaDB

⸻

Initial Login

Connect through terminal:

ssh root@dietpi.local
or
ssh root@169.254.1.1

Default password:
dietpi

⸻

System Update

Update package list:
sudo apt update

Upgrade packages:
sudo apt upgrade

⸻

Configure USB Networking

Verify USB interface
ip addr show usb0

Expected:
169.254.1.1

Verify Mac connection:
ping 169.254.1.1

⸻

Install Apache

Install:
sudo apt install apache2

Verify installation:
sudo systemctl status apache2

Start Apache:
sudo systemctl start apache2

Enable startup:
sudo systemctl enable apache2

⸻

Install PHP

Install PHP packages:
sudo apt install php libapache2-mod-php php-mysql

Verify:
php -v

Restart Apache:
sudo systemctl restart apache2

⸻

Apache Testing

Test local server:
curl http://localhost

Expected:
Apache2 Debian Default Page

⸻

Create Project Directory

Navigate:
cd /var/www/html

Create folder:
sudo mkdir kitchenary

Verify:
ls

⸻

Upload Project Files

Project location:
/var/www/html/kitchenary

Files:

index.php
login.php
logout.php
members.php
add_recipes.php
recipes_detail.php
db_connect.php
style.css

Verify:
ls /var/www/html/kitchenary

⸻

Apache Issue Encountered

Problem:
Apache service failed

Error:
AH02291:
Cannot access directory
'/var/log/apache2/'

Diagnosis:
sudo systemctl status apache2
sudo apachectl configtest

Solution:
sudo apt install --reinstall apache2

Verify log directory:
ls -ld /var/log/apache2

Restart:
sudo systemctl restart apache2

⸻

Verify Kitchenary
Local test:
curl http://localhost/kitchenary/index.php

USB test:
curl http://169.254.1.1/kitchenary/index.php

Browser:
http://169.254.1.1/kitchenary/

⸻

Editing Files

Open file:
sudo nano filename.php

Save:
CTRL + X
Y
ENTER

⸻

Common Commands
Check Apache:
sudo systemctl status apache2

Restart Apache:
sudo systemctl restart apache2

Project directory:
cd /var/www/html/kitchenary

List files:
ls -la

Current directory:
pwd

⸻

Current Status

Working:
* USB networking
* Apache2
* PHP
* CSS
* Kitchenary frontend

Pending:
* MariaDB installation
* Database import
* Database connection
* Login functionality
* Recipe CRUD operations

Reason:
Database schema is maintained separately and has not yet been deployed to the Raspberry Pi.
