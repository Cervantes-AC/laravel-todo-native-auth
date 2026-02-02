# Laravel Todo Application with Native Authentication

## Student Information
- **Name:** Aaron Clyde C. Cervantes
- **Course:** Bachelor of Science in Information Technology
- **University:** Central Mindanao University
- **Activity:** Laboratory Activity 2

## Project Description
This is a full-featured Laravel application with manually coded authentication system, user profile management, and a personal to-do list application. Built from scratch without using any authentication packages, this project demonstrates a deep understanding of Laravel's MVC architecture, security practices, and database operations using SQLite.

## Features

### Authentication System
- ✅ User registration with validation
- ✅ Secure login system
- ✅ Password hashing using bcrypt
- ✅ Session-based authentication
- ✅ Logout functionality
- ✅ Protected routes with custom middleware

### User Profile Management
- 👤 View personal profile information
- ✏️ Edit name and email
- 🔒 Change password securely
- 🛡️ Profile accessible only to authenticated users

### To-Do List Application (CRUD)
- ➕ Create new tasks
- 📋 View all personal tasks
- ✏️ Edit existing tasks
- 🗑️ Delete tasks
- ✅ Mark tasks as complete/incomplete
- 📊 Task statistics dashboard
- 🔐 User-specific tasks (users can only see their own tasks)

### User Interface
- 🎨 Custom unique design
- 📱 Responsive layout
- 🌈 Modern gradient color schemes
- ✨ Smooth animations and transitions
- 💫 Professional card-based layouts

## Technologies Used
- **Laravel:** 10.x/11.x
- **PHP:** 8.1+
- **Database:** SQLite
- **Templating:** Blade Template Engine
- **Frontend:** HTML5, CSS3
- **Version Control:** Git & GitHub

## MVC Architecture Implementation

### Models
- **User Model:** Handles user data and authentication
- **Task Model:** Manages todo items with user relationships

### Views (Blade Templates)
- `auth/register.blade.php` - User registration form
- `auth/login.blade.php` - User login form
- `profile/show.blade.php` - User profile page
- `tasks/index.blade.php` - Task list dashboard
- `tasks/create.blade.php` - Create new task form
- `tasks/edit.blade.php` - Edit task form
- `layouts/app.blade.php` - Main layout template

### Controllers
- **AuthController:** Handles registration, login, and logout
- **ProfileController:** Manages user profile operations
- **TaskController:** Complete CRUD operations for tasks

### Middleware
- **AuthCheck:** Custom middleware for route protection

## Database Schema

### Users Table
```
- id (primary key)
- name
- email (unique)
- password (hashed)
- timestamps
```

### Tasks Table
```
- id (primary key)
- user_id (foreign key)
- title
- description (nullable)
- completed (boolean)
- timestamps
```

## Installation Instructions

### 1. Clone the Repository
```bash
git clone https://github.com/Cervantes-AC/laravel-todo-native-auth.git
cd laravel-todo-native-auth
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Configure Environment
```bash
cp .env.example .env
```

Edit `.env` file and set database to SQLite:
```env
DB_CONNECTION=sqlite
```

### 4. Create SQLite Database
**For Windows:**
```bash
type nul > database/database.sqlite
```

**For Mac/Linux:**
```bash
touch database/database.sqlite
```

### 5. Run Migrations
```bash
php artisan migrate
```

### 6. Generate Application Key
```bash
php artisan key:generate
```

### 7. Start Development Server
```bash
php artisan serve
```

### 8. Access the Application
Visit: `http://localhost:8000`

## Usage Guide

### Getting Started
1. Navigate to the registration page
2. Create a new account with your name, email, and password
3. Login with your credentials
4. Start creating and managing your tasks!

### Managing Tasks
- **Create Task:** Click "Add New Task" button on the dashboard
- **Edit Task:** Click the "Edit" button on any task card
- **Delete Task:** Click the "Delete" button (with confirmation)
- **Toggle Status:** Click "Mark Complete" or "Mark Pending"

### Profile Management
- Click "Profile" in the navigation menu
- Update your name and email
- Optionally change your password
- Click "Update Profile" to save changes

## Security Features

✅ **Password Hashing:** All passwords encrypted using bcrypt  
✅ **CSRF Protection:** Built-in Laravel CSRF tokens on all forms  
✅ **SQL Injection Prevention:** Using Eloquent ORM  
✅ **Session Security:** Secure session management  
✅ **Route Protection:** Custom authentication middleware  
✅ **Data Isolation:** Users can only access their own tasks  

## What I Learned

### Technical Skills
- Creating Laravel projects from scratch
- Configuring SQLite database connections
- Implementing manual authentication without packages
- Using password hashing and session management
- Building custom middleware for route protection
- Implementing CRUD operations with Eloquent ORM
- Creating relationships between models (User has many Tasks)
- Using Blade template inheritance and components
- Form validation and error handling
- Working with Git version control

### Conceptual Understanding
- MVC (Model-View-Controller) architecture pattern
- Laravel request lifecycle
- Authentication flow and session handling
- Database migrations and schema design
- RESTful routing conventions
- Security best practices in web development

## Project Structure
```
laravel-todo-native-auth/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php
│   │   │   ├── ProfileController.php
│   │   │   └── TaskController.php
│   │   └── Middleware/
│   │       └── AuthCheck.php
│   └── Models/
│       ├── User.php
│       └── Task.php
├── database/
│   ├── migrations/
│   │   ├── xxxx_create_users_table.php
│   │   └── xxxx_create_tasks_table.php
│   └── database.sqlite
├── resources/
│   └── views/
│       ├── auth/
│       │   ├── login.blade.php
│       │   └── register.blade.php
│       ├── profile/
│       │   └── show.blade.php
│       ├── tasks/
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   └── edit.blade.php
│       └── layouts/
│           └── app.blade.php
└── routes/
    └── web.php
```

## Screenshots

### Login Page
<img width="300" height="394" alt="Screenshot 2026-02-02 112704" src="https://github.com/user-attachments/assets/d1303cd5-0981-48a8-9fc6-60de3147c777" />


### Registration Page
<img width="312" height="416" alt="Screenshot 2026-02-02 112709" src="https://github.com/user-attachments/assets/5ed2d05d-1e3d-4815-8498-6845a6eb4352" />


### Task Dashboard
<img width="1287" height="814" alt="Screenshot 2026-02-02 112609" src="https://github.com/user-attachments/assets/70e6eb56-c6bb-43a7-966b-0f55e40f05d8" />


### Create Task
<img width="627" height="495" alt="Screenshot 2026-02-02 112633" src="https://github.com/user-attachments/assets/ce69e97b-b3b7-4d9e-96e1-3fdf7aa7ed11" />


### Edit Task
<img width="635" height="570" alt="Screenshot 2026-02-02 112644" src="https://github.com/user-attachments/assets/72a37590-4bc0-40c9-9316-d762d637dd44" />


### User Profile
<img width="710" height="771" alt="Screenshot 2026-02-02 112623" src="https://github.com/user-attachments/assets/510d9f72-10d4-4175-a6e9-3b1be161aa19" />


## Challenges Faced and Solutions

1. **Challenge:** Understanding session-based authentication
   - **Solution:** Studied Laravel's session facade and implemented custom session checks

2. **Challenge:** Creating unique UI design
   - **Solution:** Experimented with different gradient colors and card layouts

3. **Challenge:** Implementing user-specific task filtering
   - **Solution:** Used Eloquent where clauses with session user_id

## Future Enhancements
- [ ] Task categories and tags
- [ ] Task priority levels
- [ ] Due dates for tasks
- [ ] Task search functionality
- [ ] Email verification
- [ ] Password reset functionality
- [ ] Dark mode theme
- [ ] Task sharing between users

## Academic Integrity Statement
This project was completed individually as part of Laboratory Activity 2. All code was written manually without copying from other students. The UI design is original and unique to this submission.

## License
This project was created for educational purposes as part of coursework at Central Mindanao University.

## Acknowledgments
- **Laravel Documentation** - For comprehensive framework guidance
- **My Instructor** - For providing clear requirements and support
- **Laravel Community** - For helpful resources and best practices
- **PHP Documentation** - For language-specific features

## Contact Information
- **GitHub:** [Cervantes-AC](https://github.com/Cervantes-AC)
- **Repository:** [laravel-todo-native-auth](https://github.com/Cervantes-AC/laravel-todo-native-auth)

---

**Created with ❤️ by Aaron Clyde C. Cervantes**  
*Central Mindanao University - BS Information Technology*  
*Laboratory Activity 2 - Native Laravel Authentication & To-Do Application*
