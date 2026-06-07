AdminGuide.md

Kitchenary Administrator Guide

OVERVIEW

-Kitchenary is a PHP-based recipe sharing platform hosted on a Raspberry Pi running DietPi.

Technology Stack:
* Raspberry Pi Zero 2W
* DietPi
* Apache2
* PHP
* MariaDB
* HTML/CSS
* USB Ethernet Access (169.254.1.1)

Project Location: /var/www/html/kitchenary

Default Access URL: http://169.254.1.1/kitchenary/

Directory Structure :
/var/www/html/kitchenary
│
├── index.php
├── login.php
├── logout.php
├── members.php
├── add_recipes.php
├── recipes_detail.php
├── db_connect.php
├── style.css
│
└── uploads/

___________________________________________

STARTING APACHE2

Check Apache status:
=> sudo systemctl status apache2

Start Apache:
=> sudo systemctl start apache2

Restart Apache:
=> sudo systemctl restart apache2

Stop Apache:
=> sudo systemctl stop apache2

___________________________________________

Verify Website Availability

Local test:
=> curl http://localhost

Project test
=> curl http://localhost/kitchenary/index.php

USB Network test:
=> curl http://169.254.1.1/kitchenary/index.php

____________________________________________

Common Apache Problems

Apache Not Running

Check status:
=> sudo systemctl status apache2

Check configuration:
=> sudo apachectl configtest

Expected output:
=> Syntax OK

____________________________________________

Missing Apache Log Directory

Error:
AH02291: Cannot access directory '/var/log/apache2/'

Fix:
=> sudo mkdir -p /var/log/apache2
=> sudo touch /var/log/apache2/error.log
=> sudo touch /var/log/apache2/access.log

Restart Apache:
=> sudo systemctl restart apache2

____________________________________________

PHP Testing

Create test page:

<?php
phpinfo();
?>

Save as:
=> info.php

Access:
=> http://169.254.1.1/info.php

Remove after testing.

_____________________________________________

Database Setup

Install MariaDB:
=> sudo apt update
=> sudo apt install mariadb-server

Start MariaDB:
=> sudo systemctl start mariadb

Check status:
=> sudo systemctl status mariadb

______________________________________________

Import Database

Import database schema:
=> mysql -u root -p < database.sql

Verify databases:

mysql -u root -p
SHOW DATABASES;

____________________________________________

Database Connection File

File:

db_connect.php

Example:

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kitchenary";
$conn = new mysqli(
    $servername,
    $username,
    $password,
    $dbname
);
if ($conn->connect_error) {
    die("Connection failed: "
        . $conn->connect_error);
}
?>

⸻

Updating Website Files

Navigate to project:
=> cd /var/www/html/kitchenary

Edit file:
=> sudo nano filename.php

Save:
CTRL + X
Y
ENTER

PHP changes take effect immediately.

Apache restart is usually NOT required.

___________________________________________

USB Network Access

Current Raspberry Pi USB IP:
=> 169.254.1.1

Mac should verify connectivity:
=> ping 169.254.1.1

Expected output:
=> 64 bytes from 169.254.1.1

___________________________________________

Backup Procedure

Create backup:
=> cp -r \
=> /var/www/html/kitchenary \
=> /var/www/html/kitchenary_backup

Recommended:
Store source code on GitHub.

____________________________________________

Useful Commands

Current directory:
=> pwd

List files:
=> ls -la

View file:
=> cat filename.php

Search project:
=> find . -name "*.php"

Apache logs:
=> sudo tail -f /var/log/apache2/error.log

System updates:
=> sudo apt update
=> sudo apt upgrade

____________________________________________

Deployment Checklist

Before submission:

* Apache running
* PHP working
* MariaDB connected
* Database imported
* Recipe listing functional
* Add Recipe functional
* Login functional
* Logout functional
* Members page functional
* CSS loading correctly
* GitHub backup completed

⸻

Known Issues Encountered During Development

1. Apache failed due to missing:
=> /var/log/apache2

2. USB networking confusion between:
=> 172.x.x.x
and
=> 169.254.1.1

3. Duplicate file creation caused by filename typos:
=> add_recipes.php
=> add_reicpes.php

4. Blank pages caused by:
* Missing database
* Empty PHP files
* Incorrect includes

5. Safari cache occasionally required hard refresh:

=> Cmd + Shift + R

____________________________________________

Maintainer:
Kitchenary Development Team

Platform:
DietPi + Apache2 + PHP + MariaDB
