<p align="center">
  <img src="https://raw.githubusercontent.com/luqelha/student-affairs/main/public/images/student-affairs.png" 
       alt="Student Affairs Logo" 
       style="max-width:100%; height:auto;"/>
       &nbsp;
</p>

<div align="center">

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com/)
[![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)](https://developer.mozilla.org/en-US/docs/Web/HTML)
[![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)](https://developer.mozilla.org/en-US/docs/Web/CSS)
[![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)](https://developer.mozilla.org/en-US/docs/Web/JavaScript)
[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)

</div>

## 🎓 Student-Affairs Dashboard

> [!IMPORTANT]
> A comprehensive web-based dashboard for managing student activities, achievements, and scholarships.  
> Built with **Laravel 12**, this system provides role-based access for **Admins** and **Users (students)** to manage data efficiently.

## 🎥 Demo

<p align="center">
  <img src="https://raw.githubusercontent.com/luqelha/student-affairs/main/public/images/demo.gif" alt="Demo Aplikasi" style="max-width:100%; height:auto;"/>
</p>

## ✨ Features

- **👥 Role Management:** Separate login and dashboard views for **Admin** and **User** roles.
- **🎓 Scholarship Management:** Admins can manage, approve, and monitor student scholarship applications.
- **🏆 Achievements:** Record and track student academic and non-academic achievements.
- **🎯 Student Activities (UKM):** Manage student organizations and extracurricular participation.
- **👤 User Management:** Admins can create, edit, and delete user accounts with role-based access control.
- **📄 Export & Reporting:**
  - Export data to **PDF** and **Excel** using `barryvdh/laravel-dompdf` and `maatwebsite/excel`.
  - Supports bulk data import/export via **PhpSpreadsheet**.
- **📊 Dashboard Analytics:** Admin overview of student statistics and performance.
- **🔒 Authentication System:** Secure login, registration, and role-based middleware using Laravel Breeze/Fortify (if included).
- **🧩 Seeders & Factories:** Auto-generate dummy data using **FakerPHP** for testing and demos.

## 🚀 Getting Started

Follow these steps to set up the project locally for development and testing.

### 🧱 Prerequisites

- **PHP >= 8.2**
- **Composer** installed
- **MySQL** or compatible database
- **Laravel 12.x**

### ⚙️ Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/luqelha/student-affairs.git
   cd student-affairs
   ```
2. **Install dependencies via Composer:**
    ```bash
    composer install
    ```
3. **Copy environment file and configure database:**
    ```bash
    cp .env.example .env
    ```
    Then fill in your database configuration in the .env file, for example:
    
    ```env
    DB_DATABASE=student_affairs
    DB_USERNAME=root
    DB_PASSWORD=
    ```
4. **Generate application key:**
    ```bash
    php artisan key:generate
    ```
5. **Run migrations and seeders:**
    ```bash
    php artisan migrate --seed
    ```
6. **Run the application:**
    ```bash
    php artisan serve
    ```
7. **Access Application in Browser:**
    ```bash
    http://127.0.0.1:8000.
    ```

## 📦 Dependencies

### Main Packages

```json
"require": {
  "php": "^8.2",
  "barryvdh/laravel-dompdf": "^3.1",
  "laravel/framework": "^12.0",
  "laravel/tinker": "^2.10.1",
  "maatwebsite/excel": "^3.1",
  "phpoffice/phpspreadsheet": "^1.30"
}
```

### Development Packages

```json
"require-dev": {
  "fakerphp/faker": "^1.23",
  "laravel/pail": "^1.2.2",
  "laravel/pint": "^1.24",
  "laravel/sail": "^1.41",
  "mockery/mockery": "^1.6",
  "nunomaduro/collision": "^8.6",
  "phpunit/phpunit": "^11.5.3"
}
```

## 🤝 Contributing

Contributions are welcome!
If you find a bug or want to improve the system, feel free to open an issue or submit a pull request.

1. Fork the Project
2. Create your Feature Branch (git checkout -b feature/YourFeature)
3. Commit your Changes (git commit -m 'Add some YourFeature')
4. Push to the Branch (git push origin feature/YourFeature)
5. Open a Pull Request

## 📜 License

Distributed under the MIT License. See [LICENSE](https://github.com/luqelha/student-affairs/blob/main/LICENSE) for more information.
