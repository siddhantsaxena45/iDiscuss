# iDiscuss - A PHP Forum Website

## Introduction
**iDiscuss** is a simple and dynamic discussion forum built using PHP and MySQL. It allows users to engage in discussions, post questions, and interact with a community. This project is ideal for learning backend development, database management, and web security.

## 🚀 Features
- User authentication system (Sign up/Login)
- Forum discussion threads
- Commenting system
- Search functionality
- Responsive UI design

## 📌 Setup Instructions
1. Clone the repository:
   ```sh
   git clone https://github.com/your-username/idiscuss.git
   ```
2. Import the database:
   - Locate `idiscuss.sql` in `backend/database/`
   - Import it into your MySQL database
3. Configure database connection:
   - Update `config.php` with your database credentials
4. Start the project:
   - Run a local server using XAMPP, WAMP, or MAMP
   - Access the site at `http://localhost/idiscuss`
  
     
## 📂 Project Structure

```
├── backend/                # Backend-related scripts and APIs
│   ├── apis/               # API endpoints
│   ├── database/           # Database schema and configurations
│   │   ├── idiscuss.sql
│   ├── partials/           # Reusable PHP components
│   ├── config.php          # Configuration file
│
├── frontend/               # Frontend-related files
│   ├── css/                # CSS files
│   ├── js/                 # JavaScript files
│   ├── images/             # Static images
│
├── pages/                  # Individual PHP pages
│   ├── index.php           # Homepage
│   ├── about.php           # About us page
│   ├── contact.php         # Contact page
│   ├── search.php          # Search functionality
│   ├── thread.php          # Thread details page
│   ├── threadlist.php      # List of threads
│
├── LICENSE                 # License information
├── README.md               # Project documentation
```

## Contributing
Pull requests are welcome! If you have suggestions, open an issue or fork the repo and submit a PR.

## License
This project is open-source under the [MIT License](LICENSE).

---
Feel free to contribute and enhance this forum. Happy coding! 🚀
