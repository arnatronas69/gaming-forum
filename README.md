# Project launch instructions
## Prerequisites
- PHP
- Composer
- Laravel
- MySQL
- XAMPP (optional)
- Git (optional)

## Steps to launch the project
1. **Clone the repo and enter the directory**
- git clone https://github.com/arnatronas69/gaming-forum.git
- cd gaming-forum

2. **Install dependencies**
- composer install

3. **Create a .env file**
- cp .env.example .env

4. **Generate an app encryption key**
- php artisan key:generate

5. **Create an empty database**
- Preferably, use a tool like phpMyAdmin

6. **Configure your .env file**
- Namely, the DB_DATABASE, DB_USERNAME, and DB_PASSWORD variables

7. **Run the database migrations**
- php artisan migrate

8. **Start up the Apache and MySQL server in XAMPP (optional)**

9. **Start the development server**
- php artisan serve

## Additonal notes
- In order for an user to be an admin in the website, the variable isAdmin in the database should be changed from 0 to 1
- In order to add categories, they have to be created in the database
