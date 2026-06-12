# Recipe-Sharing-Platform

## Project Description
This project is a lightweight, community-driven web application designed for sharing home recipes. Built entirely using **native PHP** without any external frameworks, the system focuses heavily on fundamental web structures, server-side rendering (SSR), and secure CRUD manipulation to strictly limit client-side scripting. 

The application is specifically optimized to run efficiently on a hardware-constrained **Raspberry Pi Zero 2W** environment using link-local networking (WiFi WAN off for demo). It implements an integrated in-app page for member introductions and a streamlined **3rd Normal Form (3NF)** relational database structure (MariaDB/PostgreSQL) optimized for low memory overhead.

## Tech Stack & Runtime
- **Hardware Platform:** Raspberry Pi Zero 2W
- **Web Server:** HTTP Server (Apache/Nginx)
- **Backend Scripting:** Native PHP Engine (Server-Side Rendering)
- **Database:** MariaDB / PostgreSQL (3NF Schema, `utf8mb4` encoding)
- **Network Configuration:** Link-local networking (WiFi off for demo)

## Repository File Structure
- `db_connect.php` - Database connection configuration.
- `login.php` - User authentication page.
- `signup.php` - User register page. 
- `register_action.php` - 
- `logout.php` - User exit page.
- `index.php` - Home dashboard showing the recipe directory.
- `recipes_detail.php` - Single recipe detailed view panel.
- `add_recipe_action.php` - 
- `add_recipes.php` - Server-side data processing and insertion logic and user interface for the add function.
- `edit_recipes.php` - Recipe editing page.
- `edit_recipe_action.php` - 
- `real_edit_page.php` - 
- `delete_recipe_action.php` - Backend side for delete function.
- `members.html` - Introductions for the contributers.
- `style.css` - Style for user interface along side html. 



## Project Documentation
Please refer to the following mandatory files for full configurations:
- `README.md` - Project description.
- `Contributors.md` - List of the members.
- `Installation.md` - Setup and deployment instructions for verification.
- `UserGuide.md` - Instructions on how to use the application.
- `AdminGuide.md` - Guidelines to configure and maintain the application.
