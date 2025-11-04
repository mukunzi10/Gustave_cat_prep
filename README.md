# CODERWANDA Share Ride System

A web application for ride-sharing management system built with PHP, MySQL, Docker, and Jenkins CI/CD pipeline.

## Project Structure


YOUR-FIRSTNAME/
├── src/
│   ├── index.php           # Home page with navigation
│   ├── registration.php    # User registration page
│   ├── login.php          # User login page
│   ├── dashboard.php      # User dashboard
│   ├── logout.php         # Logout handler
│   └── db_config.php      # Database configuration
├── Dockerfile             # Docker image configuration
├── docker-compose.yml     # Multi-container Docker setup
├── init.sql              # Database initialization script
├── Jenkinsfile           # CI/CD pipeline configuration
└── README.md             # Project documentation


## Prerequisites

- Git
- Docker & Docker Compose
- Jenkins
- PHP 8.1 or higher
- MySQL 8.0
- GitHub account

## Installation & Setup

### 1. Clone or Create Project

mkdir Gustave
cd Gustave
git init


### 2. Create Project Structure

mkdir src

### 3. Add All Files

Copy all the provided PHP, Docker, and configuration files to their respective locations.

### 4. Update Configuration

Replace the following placeholders:
- `Gustave` → Your actual first name
- `24rp14238` → Your registration number
- `24rp14238` → Your registration number

### 5. Initialize Git Repository


git add .
git commit -m "Initial commit: Complete ride-sharing application"


## Running the Application

### Using Docker Compose

1. **Start the application:**

docker-compose up -d


2. **Access the application:**
- Web Application: http://localhost:8080
- phpMyAdmin: http://localhost:8081
  - Username: root
  - Password: rootpassword

3. **Stop the application:**

docker-compose down


### Manual Setup (Without Docker)

1. **Create Database:**

mysql -u root -p < init.sql


2. **Configure Database:**
Edit `src/db_config.php` with your local database credentials.

3. **Run PHP Server:**

cd src
php -S localhost:8080


## Features

### User Registration
- First name and last name fields
- Gender selection (Male/Female/Other)
- Email validation
- Password confirmation
- Secure password hashing
- Duplicate email prevention

### User Login
- Email and password authentication
- Session management
- Secure password verification
- Error handling

### Dashboard
- Welcome message with user name
- User information display
- Logout functionality

### Security Features
- Password hashing using PHP's password_hash()
- SQL injection prevention using prepared statements
- XSS protection with htmlspecialchars()
- Session-based authentication

## Database Schema

### tbl_users

| Field | Type | Description |
|-------|------|-------------|
| user_id | INT | Primary key, auto-increment |
| user_firstname | VARCHAR(50) | User's first name |
| user_lastname | VARCHAR(50) | User's last name |
| user_gender | ENUM | Male, Female, or Other |
| user_email | VARCHAR(100) | Unique email address |
| user_password | VARCHAR(255) | Hashed password |
| created_at | TIMESTAMP | Registration timestamp |

## Docker Services

### 1. yourregno-web
- PHP 8.1 with Apache
- Runs the web application
- Port: 8080

### 2. yourregno-db
- MySQL 8.0
- Stores application data
- Port: 3306

### 3. yourregno-phpmyadmin
- phpMyAdmin interface
- Database management tool
- Port: 8081

## CI/CD Pipeline (Jenkins)

### Pipeline Stages

1. **Checkout** - Clone repository
2. **Build** - Build Docker images
3. **Test** - Run unit tests
4. **Code Quality Analysis** - Analyze code quality
5. **Security Scan** - Check for vulnerabilities
6. **Deploy** - Deploy to environment
7. **Integration Test** - Test deployed application
8. **Monitoring Setup** - Configure monitoring

### Setting Up Jenkins Pipeline

1. Create new Pipeline job in Jenkins
2. Configure SCM:
   - Repository URL: Your GitHub repo
   - Branch: main
3. Pipeline script from SCM
4. Save and run

## Git Workflow

### Branches Used

- `main/master` - Main branch
- `add-registration-branch` - Registration feature
- `add-login-branch` - Login feature

### Commit History

git log --oneline


Expected commits:
1. "index page is created"
2. "registration page is created"
3. "login page is created"
4. "Dockerization is done"
5. "registration and login functionalities have been integrated"
6. "Jenkinsfile added with DevOps stages"

## Push to GitHub


# Create repository on GitHub first, then:
git remote add origin https://github.com/yourusername/your-repo.git
git branch -M main
git push -u origin main


## Testing the Application

### Test Registration
1. Navigate to http://localhost:8080
2. Click "Register"
3. Fill in the form:
   - First Name: John
   - Last Name: Doe
   - Gender: Male
   - Email: john@example.com
   - Password: password123
   - Confirm Password: password123
4. Submit the form
5. Verify success message

### Test Login
1. Click "Login" from home page
2. Enter credentials:
   - Email: john@example.com
   - Password: password123
3. Submit the form
4. Verify redirect to dashboard

### Test Logout
1. From dashboard, click "Logout"
2. Verify redirect to home page
3. Try accessing dashboard.php directly
4. Verify redirect to login page

## Troubleshooting

### Docker Issues

**Problem:** Port already in use

# Check what's using the port
lsof -i :8080

# Change port in docker-compose.yml
ports:
  - "8081:80"  # Use different port


**Problem:** Database connection failed

# Check if database container is running
docker-compose ps

# View database logs
docker-compose logs yourregno-db


### Jenkins Issues

**Problem:** Permission denied

# Add Jenkins user to Docker group
sudo usermod -aG docker jenkins
sudo systemctl restart jenkins


**Problem:** Pipeline fails at build stage

# Ensure Docker is running
sudo systemctl status docker

# Check Jenkins has Docker access
docker ps


## Development

### Adding New Features

1. Create a new branch:

git checkout -b feature/new-feature


2. Make changes and commit:

git add .
git commit -m "Add new feature"


3. Merge to main:

git checkout main
git merge feature/new-feature


### Database Migrations

To add new tables or modify schema:
1. Update `init.sql`
2. Rebuild database:

docker-compose down -v
docker-compose up -d


## Security Considerations

- Always use prepared statements
- Hash passwords with password_hash()
- Validate and sanitize user input
- Use HTTPS in production
- Keep dependencies updated
- Regular security audits

## License

This project is for educational purposes as part of CODERWANDA Ltd training.

## Support

For issues or questions, contact your DevOps team or instructor.



**Note:** Remember to replace all placeholder values (yourregno, myregnumber, YOUR-FIRSTNAME) with your actual information before deploying.