# Citizen Voice - Secure Government Services 🏛️

A secure, high-availability backend system designed for government citizen services. This platform handles sensitive citizen complaints, service requests, and delivers real-time status updates via multiple notification channels.

## 🔒 Security & Architecture

- **Secure Core:** Implemented strict validation and sanitation to protect sensitive citizen data (SQL Injection/XSS protection).
- **Authentication:** Token-based authentication ensuring only verified citizens and authorized government employees access specific endpoints.
- **Audit Logging:** Tracks all actions taken on complaints for transparency and accountability.

## 📡 Real-Time Notifications

This system guarantees citizens are informed at every step using a multi-channel approach:

1.  **SMS Services:** Integrated SMS gateway to send instant text alerts for urgent updates.
2.  **Firebase Cloud Messaging (FCM):** Push notifications for the mobile application.
3.  **Email System:** Uses **Mailtrap** for testing and reliable SMTP delivery for official correspondence.

## 🛠️ Tech Stack

- **Backend:** Laravel (PHP)
- **Database:** MySQL
- **Notifications:** Firebase FCM, SMS driver, Mailtrap
- **Testing:** Postman (API Endpoint Validation)

## 🚀 Installation

1.  **Clone the Repo**
    ```bash
    git clone (https://github.com/hasan-devtech/citizen-voice.git)
    cd citizen-voice
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    ```

3.  **Setup Environment**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    *Configure `FIREBASE_CREDENTIALS` and `SMS_API_KEY` in your .env file.*

4.  **Run Migrations**
    ```bash
    php artisan migrate
    ```

## 👥 Contributors

- **Hasan Hasan** - Lead Backend Architecture & Security
- **Omran-Al-samkrie** - full-stack 

---
*Built for safe and efficient government-citizen communication.*
