# DShare 📨 : A File Storing and Sharing WebApp

## Overview
Dshare is a web application designed for storing and sharing files. It provides user-friendly interfaces for file uploads, sharing, user authentication, and more. The application is built with HTML, CSS, PHP, and utilizes a database(MySql) for data management.

## Features
1. **Login and Authentication**
   - Secure user authentication system with login and logout functionality.

2. **User Registration**
   - Easy-to-use registration form for new users.

3. **File Upload and Sharing**
   - Upload files and share them securely with others.

4. **Dashboard and File Management**
   - Intuitive dashboard for managing uploaded files.

5. **Contact Form**
   - Built-in contact form for user inquiries and support.

6. **Styling**
   - Responsive and visually appealing design.

## Tech Stack
- **Frontend**: HTML, CSS
- **Backend**: PHP
- **Database**: MySQL
- **Web Server**: Apache or Nginx

## Getting Started
### Prerequisites
- A web server with PHP support (e.g., Apache using Xampp).
- A MySQL database for storing user and file data. (e.g. MySql using Xampp)

### Installation
1. Clone or download the repository.
2. Place the `Dshare` directory in your web server's root directory(C:\xampp\htdocs).
3. Import the database schema (not included in this structure) into your MySQL server. (import.db file contains SQL commands)
4. Update `db.php` with your database credentials.

### Usage
- Navigate to `index.html` or `http://localhost/Dshare/` to access the landing page.
- Register a new account using `signup.html`.
- Log in using `login.html`.
- Use the dashboard to upload, share, and manage files.

## Contribution
Contributions are welcome! Please fork the repository and create a pull request with your changes.

## License
This project is licensed under the [MIT License](./LICENSE).


## File Structure

dshare/
    login.html → login.php
        - login.html: Provides the login form interface.
        - login.php: Handles login form submission (backend logic).
        
    signup.html → register.php
        - signup.html: Displays the user registration form.
        - register.php: Processes user registration form submissions.

    contact.html → submit_contact.php
        - contact.html: A contact form for users to send inquiries.
        - submit_contact.php: Processes and sends the submitted contact information.

    upload-form.html → upload.php
        - upload-form.html: A form for file uploads.
        - upload.php: Handles the file upload process.

    dashboard.php → styledashboard.css
        - dashboard.php: Displays the user dashboard interface.
        - styledashboard.css: Styles the dashboard page.

    index.html → style.css
        - index.html: The main landing page for the application.
        - style.css: General styles applied to the application.

    share_file.php
        - Handles sharing of uploaded files, likely used within the dashboard or upload-form.html.
        
    logout.php
        - Logs out the user and clears session data.

    available-files.php
        - Displays or retrieves a list of files available for download or sharing.

    db.php
        - Manages database connections and queries (used internally by many other PHP scripts).

    import.db
        - Stores SQL commands to structure the database


---   

For any issues or suggestions, feel free to contact us by opening an issue on the repository.
