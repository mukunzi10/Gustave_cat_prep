<?php
session_start();
require_once __DIR__ . '/config/db_config.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $gender = $_POST['gender'];
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    if (empty($firstname) || empty($lastname) || empty($email) || empty($password)) {
        $error = 'All fields are required!';
    } elseif ($password !== $confirm_password) {
        $error = 'Passwords do not match!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email format!';
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt = $conn->prepare("INSERT INTO tbl_users (user_firstname, user_lastname, user_gender, user_email, user_password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $firstname, $lastname, $gender, $email, $hashed_password);
        
        if ($stmt->execute()) {
            $success = 'Registration successful! You can now login.';
        } else {
            if ($stmt->errno == 1062) {
                $error = 'Email already exists!';
            } else {
                $error = 'Registration failed. Please try again.';
            }
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration - CODERWANDA</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        max-width: 500px;
        margin: 50px auto;
        padding: 20px;
        background-color: #f4f4f4;
    }

    .container {
        background-color: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        color: #333;
        text-align: center;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        color: #555;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"],
    select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-sizing: border-box;
    }

    button {
        width: 100%;
        padding: 12px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    button:hover {
        background-color: #218838;
    }

    .error {
        color: #dc3545;
        padding: 10px;
        background-color: #f8d7da;
        border-radius: 4px;
        margin-bottom: 15px;
    }

    .success {
        color: #155724;
        padding: 10px;
        background-color: #d4edda;
        border-radius: 4px;
        margin-bottom: 15px;
    }

    .back-link {
        text-align: center;
        margin-top: 15px;
    }

    .back-link a {
        color: #007bff;
        text-decoration: none;
    }
    </style>
</head>

<body>
    <div class="container">
        <h2>User Registration</h2>

        <?php if ($error): ?>
        <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
        <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="firstname">First Name:</label>
                <input type="text" id="firstname" name="firstname" required>
            </div>

            <div class="form-group">
                <label for="lastname">Last Name:</label>
                <input type="text" id="lastname" name="lastname" required>
            </div>

            <div class="form-group">
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>

            <button type="submit">Register</button>
        </form>

        <div class="back-link">
            <a href="index.php">Back to Home</a> |
            <a href="login.php">Already have an account? Login</a>
        </div>
    </div>
</body>

</html>