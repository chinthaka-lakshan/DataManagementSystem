# Data Management System

A robust data management application built with **Laravel 12** and **Vite**, designed to manage administrative divisions, households, citizens, and certificate issuance efficiently.

## 🚀 Features

-   **Division Management**: Manage administrative divisions.
-   **Household Management**: Track households and their details.
-   **Citizen Registry**: Comprehensive database of citizens.
-   **Certificate Issuance**: Manage and issue certificates to citizens.
-   **Secure Authentication**: User login and access control.
-   **Modern UI**: Responsive design using Tailwind CSS and Alpine.js.

## 🛠 Technology Stack

-   **Backend**: [Laravel 12](https://laravel.com) (PHP ^8.2)
-   **Frontend**:
    -   [Vite](https://vitejs.dev) (Build tool)
    -   [Tailwind CSS](https://tailwindcss.com) (Utility-first CSS framework)
    -   [Alpine.js](https://alpinejs.dev) (Lightweight JavaScript framework)
-   **Database**: MySQL (or any Laravel-supported database)

## 📋 Prerequisites

Ensure you have the following installed on your local machine:

-   [PHP](https://www.php.net/) (>= 8.2)
-   [Composer](https://getcomposer.org/)
-   [Node.js](https://nodejs.org/) & NPM

## ⚙️ Installation & Setup

Follow these steps to set up the project locally:

1.  **Clone the repository**
    ```bash
    git clone <your-repo-url>
    cd DataManagementSystem
    ```

2.  **Install PHP dependencies**
    ```bash
    composer install
    ```

3.  **Install JavaScript dependencies**
    ```bash
    npm install
    ```

4.  **Environment Configuration**
    Copy the example environment file and configure it:
    ```bash
    cp .env.example .env
    ```
    Open `.env` and set your database credentials:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```

5.  **Generate Application Key**
    ```bash
    php artisan key:generate
    ```

6.  **Run Migrations**
    Set up the database tables:
    ```bash
    php artisan migrate
    ```

## 🚀 Running the Application

1.  **Start the Backend Server**
    ```bash
    php artisan serve
    ```

2.  **Start the Frontend Development Server** (in a separate terminal)
    ```bash
    npm run dev
    ```

3.  **Access the App**
    Open your browser and visit: `http://localhost:8000`

## 🧪 Testing

To run the application tests:

```bash
php artisan test
```

## 📂 Project Structure

-   `app/Http/Controllers`: Contains the logic for Divisions, Households, Citizens, etc.
-   `routes/web.php`: Defines the application routes.
-   `resources/views`: Blade templates for the UI.
-   `resources/css`: Tailwind CSS entry point.
-   `resources/js`: Application JavaScript logic.

---

**Developed with Laravel 12**
