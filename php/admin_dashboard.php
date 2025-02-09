<?php
include '..\php\db_connection.php';
session_start();

// Check if user is admin
if ($_SESSION['user_type'] !== 'admin') {
    header('Location: ..\php\login.php');
    exit();
}

// Handle CRUD operations
if (isset($_POST['action'])) {
    $action = $_POST['action'];
    switch ($action) {
        case 'add_event':
            
            $stmt = $conn->prepare("INSERT INTO events (name, picture, description, details) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $_POST['name'], $_POST['picture'], $_POST['description'], $_POST['details']);
            $stmt->execute();
            break;
        case 'update_event':
            
            $stmt = $conn->prepare("UPDATE events SET name=?, picture=?, description=?, details=? WHERE id=?");
            $stmt->bind_param("ssssi", $_POST['name'], $_POST['picture'], $_POST['description'], $_POST['details'], $_POST['id']);
            $stmt->execute();
            break;
        case 'delete_event':
            
            $stmt = $conn->prepare("DELETE FROM events WHERE id=?");
            $stmt->bind_param("i", $_POST['id']);
            $stmt->execute();
            break;
        
    }
}

// Fetch events, programs, animals
$events = $conn->query("SELECT * FROM events");
$programs = $conn->query("SELECT * FROM programs");
$animals = $conn->query("SELECT * FROM animals");
?>

<!DOCTYPE html>
<html>
<head>
    <title>ZooParc - Admin Dashboard</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
      
        @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap');
body {
    font-family: "Josefin Sans", sans-serif;
    line-height: 1.6;
    color: #333;
    margin:  0 2px 2px 2px ;
    padding: 0 0px 0 0px;
    background-color: #f4f4f4;
    justify-content: center;
    align-items: center;
}



h1 {
    color: #333;
    margin-bottom: 20px;
    font-family: "Josefin Sans", sans-serif;
}
h2 {
    color: #2718ac;
    margin-bottom: 20px;
    text-align: center;
    font-family: "Josefin Sans", sans-serif;
}

a {
    text-decoration: none;
    color: #007bff;
    font-family: "Josefin Sans", sans-serif;
}

a:hover {
    text-decoration: underline;
}


/* Header and Navbar */
header {
    background-color: #333;
    color: #fff;
    padding: 10px 0;
    text-align: center;
    position: fixed;
    width: 100%;
    top: 0;
    left: 0;
    z-index: 1000; /* Ensures the header stays above other content */
}

header h1 {
    margin: 0;
    font-size: 24px;
}

.navbar {
    background-color: #000;
    overflow: hidden;
    position: fixed; 
    width: 100%; 
    top: 0px; 
    left: 0;
    z-index: 1000; 
}

.navbar a {
    float: left;
    display: block;
    color: #f2f2f2;
    text-align: center;
    padding: 20px 20px;
    text-decoration: none;
    font-size: 15px;
    font-weight: bold;
}

.navbar a:hover {
    text-decoration:underline;
}

.navbar .logo {
    font-weight: bold;
    font-size: 25px;
}

.navbar .links {
    float: right;
}

.adding{
    margin-top: 90px;
  
}


/* Forms */
form {
    background: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    padding: 20px;
    margin-bottom: 20px;
   
   
}

form label {
    font-family: "Josefin Sans", sans-serif;
    display: block;
    margin-bottom: 10px;
    padding-right: 10px;
}

form input, form textarea, form button {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-family: "Josefin Sans", sans-serif;
}

form button {
    background-color: #007bff;
    color: #fff;
    border: none;
    cursor: pointer;
}

form button:hover {
    background-color: #0056b3;
}

/* Tables */
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 10px;
    text-align: left;
    font-family: "Josefin Sans", sans-serif;
}

th {
    background-color: #f4f4f4;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

/* Media Queries */

/* For screens smaller than 480px */
@media (max-width: 480px) {
    .navbar a {
        float: none;
        display: block;
        text-align: left;
    }

    .navbar .links {
        float: none;
        text-align: center;
    }

    form input, form textarea, form button {
        width: 100%;
        font-size: 14px;
    }

    table th, table td {
        font-size: 14px;
    }

    img {
        width: 80px; 
    }
}

/* For screens between 481px and 768px */
@media (min-width: 481px) and (max-width: 768px) {
    .navbar a {
        float: left;
        display: block;
        text-align: center;
    }

    .navbar .links {
        float: right;
    }

    form input, form textarea, form button {
        width: 100%;
        font-size: 16px;
    }

    table th, table td {
        font-size: 16px;
    }

    img {
        width: 100px; 
    }
}

/* For screens between 769px and 1024px */
@media (min-width: 769px) and (max-width: 1024px) {
    .navbar a {
        float: left;
        display: block;
        text-align: center;
    }

    .navbar .links {
        float: right;
    }

    form input, form textarea, form button {
        width: 100%;
        font-size: 18px;
    }

    table th, table td {
        font-size: 18px;
    }

    img {
        width: 120px; 
    }
}

footer {
    background-color:#5c5a5a;
    color: #fff;
    padding: 20px;
    font-family: "Josefin Sans", sans-serif;
}

.footer-content {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}

.footer-logo {
    max-width: 500px;
}



.footer-logo h2 {
    margin: 10px 0;
    color: #f2f2f2;
}

.footer-links {
    max-width: 300px;

}

.footer-links h3 {
    margin-bottom: 10px;
}

.footer-links ul {
    list-style: none;
    padding: 0;
}

.footer-links ul li {
    margin-bottom: 5px;
}

.footer-links ul li a {
    color: #fff;
    text-decoration: none;
}

.footer-links ul li a:hover {
    text-decoration: underline;
}

.footer-social {
    max-width: 300px;
}

.footer-social h3 {
    margin-bottom: 10px;
}

.footer-social .social-icon {
    margin-right: 20px;
    color: #419741;
    font-size: 30px;
}



.footer-bottom {
    text-align: center;
    margin-top: 30px;
}

/* General adjustments for mobile devices */
@media (max-width: 480px) {
    .footer-content {
        flex-direction: column;
        text-align: center;
    }

    .footer-links, .footer-social {
        margin-top: 20px;
    }

    
}
/* Adjustments for tablets or large smartphones */
@media (max-width: 768px) {
    .footer-content {
        flex-direction: column;
        text-align: center;
    }

    .footer-links, .footer-social {
        margin-top: 30px;
    }

    
}
/* Adjustments for smaller laptops or tablets */
@media (max-width: 1024px) {
    .footer-content {
        flex-direction: column;
        text-align: center;
    }

    .footer-links, .footer-social {
        margin-top: 20px;
    }

    
}


    </style>
</head>
<body>
<div class="navbar">
        <a href="#" class="logo">Admin Dashboard</a>
        <div class="links">
            <a href="..\html\home.html">Log Out</a>
           
        </div>
    </div>
   <section class="adding">
    <!-- Forms and Tables for CRUD operations -->
    <h2> Manage Events</h2>
    <!-- Add Event Form -->
    <form action="..\php\admin_dashboard.php" method="post">
        <input type="hidden" name="action" value="add_event">
        <label>Name: <input type="text" name="name" required></label>
        <label>Picture: <input type="text" name="picture"></label>
        <label>Description: <textarea name="description"></textarea></label>
        <label>Details: <textarea name="details"></textarea></label>
        <button type="submit">Add Event</button>
    </form>

    <!-- Event List -->
    <table>
        <tr>
            <th>Name</th>
            <th>Picture</th>
            <th>Description</th>
            <th>Details</th>
            <th>Actions</th>
        </tr>
        <?php while ($event = $events->fetch_assoc()) { ?>
        <tr>
            <td><?php echo htmlspecialchars($event['name']); ?></td>
            <td><img src="<?php echo htmlspecialchars($event['picture']); ?>" alt="Event Picture" width="100"></td>
            <td><?php echo htmlspecialchars($event['description']); ?></td>
            <td><?php echo htmlspecialchars($event['details']); ?></td>
            <td>
                <!-- Update Form -->
                <form action="..\php\admin_dashboard.php" method="post">
                    <input type="hidden" name="action" value="update_event">
                    <input type="hidden" name="id" value="<?php echo $event['id']; ?>">
                    <button type="submit">Update</button>
                </form>
                <!-- Delete Form -->
                <form action="..\php\admin_dashboard.php" method="post">
                    <input type="hidden" name="action" value="delete_event">
                    <input type="hidden" name="id" value="<?php echo $event['id']; ?>">
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>

    

    <h2> Manage Programs</h2>
    <!-- Add program Form -->
    <form action="..\php\admin_dashboard.php" method="post">
        <input type="hidden" name="action" value="add_program">
        <label>Name: <input type="text" name="name" required></label>
        <label>Picture: <input type="text" name="picture"></label>
        <label>Description: <textarea name="description"></textarea></label>
        <label>Details: <textarea name="details"></textarea></label>
        <button type="submit">Add program</button>
    </form>

    <!-- program List -->
    <table>
        <tr>
            <th>Name</th>
            <th>Picture</th>
            <th>Description</th>
            <th>Details</th>
            <th>Actions</th>
        </tr>
        <?php while ($program = $programs->fetch_assoc()) { ?>
        <tr>
            <td><?php echo htmlspecialchars($program['name']); ?></td>
            <td><img src="<?php echo htmlspecialchars($program['picture']); ?>" alt="program Picture" width="100"></td>
            <td><?php echo htmlspecialchars($program['description']); ?></td>
            <td><?php echo htmlspecialchars($program['details']); ?></td>
            <td>
                <!-- Update Form -->
                <form action="..\php\admin_dashboard.php" method="post">
                    <input type="hidden" name="action" value="update_program">
                    <input type="hidden" name="id" value="<?php echo $program['id']; ?>">
                    <button type="submit">Update</button>
                </form>
                <!-- Delete Form -->
                <form action="..\php\admin_dashboard.php" method="post">
                    <input type="hidden" name="action" value="delete_program">
                    <input type="hidden" name="id" value="<?php echo $program['id']; ?>">
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>

    <h2> Manage Animals</h2>
    <!-- Add animal Form -->
    <form action="..\php\admin_dashboard.php" method="post">
        <input type="hidden" name="action" value="add_animal">
        <label>Name: <input type="text" name="name" required></label>
        <label>Picture: <input type="text" name="picture"></label>
        <label>Description: <textarea name="description"></textarea></label>
        <label>Details: <textarea name="details"></textarea></label>
        <button type="submit">Add animal</button>
    </form>

    <!--animal List -->
    <table>
        <tr>
            <th>Name</th>
            <th>Picture</th>
            <th>Description</th>
            <th>Details</th>
            <th>Actions</th>
        </tr>
        <?php while ($animal = $animals->fetch_assoc()) { ?>
        <tr>
            <td><?php echo htmlspecialchars($animal['name']); ?></td>
            <td><img src="<?php echo htmlspecialchars($animal['picture']); ?>" alt="animal Picture" width="100"></td>
            <td><?php echo htmlspecialchars($animal['description']); ?></td>
            <td><?php echo htmlspecialchars($animal['details']); ?></td>
            <td>
                <!-- Update Form -->
                <form action="..\php\admin_dashboard.php" method="post">
                    <input type="hidden" name="action" value="update_animal">
                    <input type="hidden" name="id" value="<?php echo $animal['id']; ?>">
                    <button type="submit">Update</button>
                </form>
                <!-- Delete Form -->
                <form action="..\php\admin_dashboard.php" method="post">
                    <input type="hidden" name="action" value="delete_animal">
                    <input type="hidden" name="id" value="<?php echo $animal['id']; ?>">
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>
    </section> 
    <footer>
    <div class="footer-content">
        <div class="footer-logo">
           
            <h2>  <i class="fas fa-paw"> ZooParc Adventures</i></h2>
        </div>
        <div class="footer-links">
            <h3>Quick Access</h3>
            <ul>
                <li><a href="..\php\animals.php">Animals</a></li>
                <li><a href="..\html\volunteer.html">Volunteer</a></li>
                <li><a href="..\php\events.php">Events</a></li>
                <li><a href="..\html\food.html">Food Outlets</a></li>
                <li><a href="..\html\donation.html">Donations</a></li>
                <li><a href="..\html\visit.html">Visit</a></li>
                <li><a href="..\php\register.php">Register</a></li>
                <li><a href="..\php\programs.php">Educational programs</a></li>
                <li><a href="..\html\volunteer.html">Our Online Community</a></li>
            </ul>
        </div>
        <div class="footer-social">
            <h3>Follow Us</h3>
            <a href="#follow" target="_blank" class="social-icon">
                <i class='bx bxl-facebook-square'></i>
            </a>
            <a href="#follow" target="_blank" class="social-icon">
                <i class='bx bxl-twitter'></i>
            </a>
            <a href="#follow" target="_blank" class="social-icon">
                <i class='bx bxl-instagram-alt'></i>
            </a>
            <a href="#follow" target="_blank" class="social-icon">
                <i class='bx bxl-linkedin-square'></i>
            </a>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2024 ZooParc Adventures. All rights reserved.</p>
    </div>
</footer>
</body>
</html>
