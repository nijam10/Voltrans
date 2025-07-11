# Voltrans - Eco-Friendly Electric Vehicle Rental 🚗⚡️

![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel)
![Livewire](https://img.shields.io/badge/Livewire-3-4d55ea?style=for-the-badge&logo=livewire)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3-38B2AC?style=for-the-badge&logo=tailwind-css)
![Project Status](https://img.shields.io/badge/status-in_development-brightgreen?style=for-the-badge)

A modern, eco-friendly web application for renting electric vehicles. Built with a powerful TALL stack for a seamless user experience. This project is our final submission for **Project-Based Learning (PBL)**.

![voltrans](https://voltransbucket.s3.ap-southeast-1.amazonaws.com/icons/voltrans-home.png)


## 🧑‍💻 Our Team

This project was brought to life by a dedicated team of students:

| NIM        | Name              |
| :--------- | :---------------- |
| 3312401033 | Khairul Nizam     |
| 3312401032 | Aruna Fajar P     |
| 3312401042 | Muhammad Danial   |
| 3312401052 | Maulana Ramadan   |

---

## 🌳 About The Project

**Voltrans** is a web platform designed to make renting electric vehicles simple, fast, and accessible. Our mission is to promote sustainable transportation by providing a reliable service for users who want to reduce their carbon footprint.

This application was developed as a final project for our Project-Based Learning course, showcasing our ability to build a full-featured, production-ready web application from the ground up using modern tools and best practices.

---

## ✨ Core Features

Our platform comes packed with features to ensure a complete and satisfying user experience for both renters and administrators.

-   👤 **User Authentication**: Secure registration and login system powered by **Laravel Jetstream**.
-   📅 **Seamless Booking System**: An intuitive, multi-step process for users to find and reserve a vehicle.
-   💳 **Integrated Payments**: Safe and reliable payment processing with **Midtrans Payment Gateway**.
-   ⭐ **Customer Reviews & Ratings**: A feedback system to build community trust and improve service quality.
-   ⚙️ **Powerful Admin Dashboard**: A comprehensive admin panel built with **Filament** for managing users, vehicles, bookings, and payments.
-   📧 **Email Notifications**: Automated email confirmations for bookings, payments, and account activities.

---

## 🛠️ Tech Stack

We used a curated set of modern and powerful technologies to build this application.

-   **Backend**: Laravel 12, MySQL
-   **Frontend**: Tailwind CSS, Alpine.js, Blade
-   **Full-stack Tooling**: Livewire
-   **Admin Panel**: Filament
-   **Authentication**: Laravel Jetstream
-   **UI Components**: SweetAlert2 for beautiful alerts.
-   **Payment**: Midtrans

---

## 🚀 Getting Started

To get a local copy up and running, follow these simple steps.

### Prerequisites

-   PHP 8.2+
-   Composer
-   Node.js & NPM
-   MySQL

### Installation

1.  **Clone the repository**
    ```sh
    git clone [https://github.com/your-username/your-repository-name.git](https://github.com/your-username/your-repository-name.git)
    cd your-repository-name
    ```

2.  **Install dependencies**
    ```sh
    composer install
    npm install
    ```

3.  **Setup your environment**
    ```sh
    cp .env.example .env
    ```
    *Next, open the `.env` file and configure your database (`DB_*`) and Midtrans API keys (`MIDTRANS_*`).*

4.  **Generate application key**
    ```sh
    php artisan key:generate
    ```

5.  **Run database migrations and seeders**
    ```sh
    php artisan migrate --seed
    ```

6.  **Build frontend assets**
    ```sh
    npm run dev
    ```

7.  **Start the development server**
    ```sh
    php artisan serve
    ```
    Your application will be available at `http://127.0.0.1:8000`.

---



## 📄 License

Distributed under the MIT License. See `LICENSE` for more information.
