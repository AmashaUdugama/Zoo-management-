<?php
include '..\php\config.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $user_type = $_POST['user_type'];

    // Validate username
    if (empty($username)) {
        $errors['username'] = "Username is required";
    }

    // Validate email
    if (empty($email)) {
        $errors['email'] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    }

    // Validate password
    if (empty($password)) {
        $errors['password'] = "Password is required";
    }

    // Validate confirm password
    if ($password !== $confirm_password) {
        $errors['confirm_password'] = "Passwords do not match";
    }

    // If no errors, hash password and insert into database
    if (count($errors) == 0) {
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $conn->prepare("INSERT INTO users (username, email, password, user_type) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $password_hash, $user_type);

        if ($stmt->execute()) {
            header("Location: ..\php\login.php");
        } else {
            $errors['database'] = "Error inserting into database: " . $conn->error;
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
    <title>ZooParc - Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap');
        /* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Josefin Sans", sans-serif;
}

/* Body Styling */
body {
    background-color:#060930;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}
i{
    font-size: 20px;
}
/* Form Container */
form {
    background-color:#8a8fce;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 600px;
}

/* Form Title */
h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #000;
    font-size: 20px;
}

/* Labels */
label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #000;
    font-size: 15px;
}

/* Input Fields */
input[type="text"],
input[type="password"],
select {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    color: #000;
}

/* Error Messages */
.error {
    color: #d9534f;
    font-size: 14px;
    margin-top: -10px;
    margin-bottom: 10px;
}

/* Submit Button */
button[type="submit"] {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
    margin-bottom: 20px;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}
a{
    padding: 30px;
    color:  #fff;
    font-size: 17px;
    
    

    }
    </style>
    <script src="validation.js"></script>
</head>
<body>
 
    <form id="registerForm" method="POST" action="..\php\register.php">
        <h2>Registation - <i class="fas fa-paw"> ZooParc Adventures</i></h2>
        <label>Username:</label>
        <input type="text" name="username" id="username">
        <span class="error"><?= $errors['username'] ?? '' ?></span>

        <label>Email:</label>
        <input type="text" name="email" id="email">
        <span class="error"><?= $errors['email'] ?? '' ?></span>

        <label>Password:</label>
        <input type="password" name="password" id="password">
        <span class="error"><?= $errors['password'] ?? '' ?></span>

        <label>Confirm Password:</label>
        <input type="password" name="confirm_password" id="confirm_password">
        <span class="error"><?= $errors['confirm_password'] ?? '' ?></span>

        <label>User Type:</label>
        <select name="user_type" id="user_type">
            <option value="admin">Admin</option>
            <option value="member">Member</option>
            <option value="volunteer">Volunteer</option>
        </select>

        <button type="submit">Register</button>
        <span class="error"><?= $errors['database'] ?? '' ?></span>
        <a href="..\html\home.html">Back to Home</a>
    </form>
    
</body>
</html>
