# iDiscuss - A PHP Forum Website

## Introduction
**iDiscuss** is a simple and dynamic discussion forum built using PHP and MySQL. It allows users to engage in discussions, post questions, and interact with a community. This project is ideal for learning backend development, database management, and web security.

## Features
- User authentication system (Login & Signup)
- Categories-based discussion forum
- Post new questions and reply to existing ones
- Admin panel for managing categories and discussions
- Secure password hashing and user session management
- Responsive UI using Bootstrap

## Installation
### Prerequisites
Ensure you have the following installed on your system:
- XAMPP (or any PHP & MySQL environment)
- PHP 7 or above
- MySQL Database

### Steps
1. Clone the repository:
   ```sh
   git clone https://github.com/yourusername/iDiscuss.git
   ```
2. Move the project folder to the XAMPP `htdocs` directory:
   ```sh
   mv iDiscuss /xampp/htdocs/
   ```
3. Start Apache and MySQL in XAMPP.
4. Create a database named `idiscuss` in phpMyAdmin.
5. Import the `idiscuss.sql` file into the database.
6. Update the database credentials in `dbconnect.php`:
   ```php
   $servername = "localhost";
   $username = "root";
   $password = "";
   $database = "idiscuss";
   ```
7. Open your browser and go to:
   ```
   http://localhost/iDiscuss/
   ```

## Folder Structure
```
📂 iDiscuss/
├── 📁 assets/            # CSS, JS, Images
├── 📁 includes/          # Header, Footer, Database connection
├── 📁 templates/         # Forum templates
├── index.php            # Homepage
├── thread.php           # Discussion threads
├── login.php            # User authentication
├── signup.php           # User registration
└── dbconnect.php        # Database connection file
```

## Contributing
Pull requests are welcome! If you have suggestions, open an issue or fork the repo and submit a PR.

## License
This project is open-source under the [MIT License](LICENSE).

---
Feel free to contribute and enhance this forum. Happy coding! 🚀
