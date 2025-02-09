<?php
session_start();

// Include the database connection file
require '..\php\db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type'];

    // Input validation
    $errors = [];

    if (empty($email)) {
        $errors['email'] = "Email is required";
    }

    if (empty($password)) {
        $errors['password'] = "Password is required";
    }

    if (empty($user_type)) {
        $errors['user_type'] = "User type is required";
    }

    // Proceed only if there are no validation errors
    if (empty($errors)) {
        // Prepare the SQL query
        $sql = "SELECT * FROM users WHERE email = ? AND user_type = ? LIMIT 1";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ss", $email, $user_type);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if the user exists
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();

                // Verify the password
                if (password_verify($password, $user['password'])) {
                    // Start the session and set session variables
                    $_SESSION['user_type'] = $user['user_type'];
                    $_SESSION['username'] = $user['username'];

                    // Redirect based on user type
                    if ($user['user_type'] == 'admin') {
                        header("Location: ..\php\admin_dashboard.php");
                    } elseif ($user['user_type'] == 'member') {
                        header("Location: ..\php\member_dashboard.php");
                    } elseif ($user['user_type'] == 'volunteer') {
                        header("Location: ..\php\member_dashboard.php");
                    }
                    exit();
                } else {
                    $errors['password'] = "Incorrect password";
                }
            } else {
                $errors['login'] = "No user found with the provided email and user type.";
            }

            $stmt->close();
        } else {
            $errors['query'] = "Failed to prepare the SQL statement.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZooParc - Login</title>
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
    background-color: #060930;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* Form Container */
form {
    background-color: #8a8fce;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 500px;
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
    margin-bottom: 8px;
    font-weight: bold;
    color: #000;
    font-size: 15px;
}

/* Input Fields */
input[type="email"],
input[type="password"],
select {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #cccccc;
    border-radius: 5px;
    font-size: 16px;
    color: #000;
}
i{
    font-size: 20px;
}
/* Submit Button */
button[type="submit"] {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: #ffffff;
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
    margin: 60px;
    color: #fff;
    font-size: 17px;
    }
/* Error Messages */
.error {
    background-color: #f8d7da;
    color: #721c24;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #f5c6cb;
    border-radius: 5px;
    font-size: 14px;
}


    </style>
</head>
<body>
    <form method="POST" action="..\php\login.php">
        <h2>Login - <i class="fas fa-paw"> ZooParc Adventures</i></h2>

        <!-- Display Errors -->
        <?php if (!empty($errors)): ?>
            <div class="error">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>

        <label for="user_type">User Type</label>
        <select name="user_type" id="user_type" required>
            <option value="admin">Admin</option>
            <option value="member">Member</option>
            <option value="volunteer">Volunteer</option>
        </select>

        <button type="submit">Login</button>
        <a href="..\html\home.html">Back to Home</a>
        <a href="..\php\register.php">Register Now</a>
    </form>
</body>
</html>
