# Employee Appreciation Voting System

This is a simple PHP-based voting system where employees can vote for one another in various categories.

## Features
- Categories: Makes Work Fun, Team Player, Culture Champion, Difference Maker
- Tracks votes, comments, and timestamps
- Prevents self-voting
- Ensures unique voting per category per voter

## Installation

### Prerequisites
- PHP
- MySQL
- A local server (e.g., XAMPP)

### Setup
1. Clone the repository:
   ```bash
   git clone https://github.com/dinostojkoski/employee-voting-system
   cd voting-system
   ```

### Set Up the Database

1. Open your MySQL client (like phpMyAdmin, MySQL Workbench, or command line).
2. Create the `voting_system` database (if not already done by the script):
    ```sql
    CREATE DATABASE IF NOT EXISTS voting_system;
    ```
3. Import the database schema by running the following command in your MySQL client:
    ```bash
    mysql -u root -p < path/to/your/project/db/database.sql
    ```
   - This will create the necessary tables (`employees`, `nominee_categories`, `votes`) and insert some sample data.
   - If you're using phpMyAdmin or MySQL Workbench, you can also import the `.sql` file directly through their interfaces.

### Configure the Database Connection

1. In your project folder, locate the `db.php` file (or the PHP file responsible for the database connection).
2. Update the database connection details to match your MySQL setup:
   ```php
   $host = 'localhost';  // Database host (usually 'localhost')
   $username = 'root';   // Your MySQL username
   $password = 'root';       // Your MySQL password
   $database = 'voting_system';  // The database name you created
   ```

### Test the Project

Open your browser and navigate to the project's index file (e.g., `http://localhost/your-project-folder/index.php`).
