<?php
include 'db_connection.php';

// Fetch programs
$programs = $conn->query("SELECT * FROM programs");
?>

<!DOCTYPE html>
<html>
<head>
    <title> ZooParc - Programs</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
          
       
       @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Josefin Sans", sans-serif;
    list-style: none;
    text-decoration: none;
}

body{
    background-color: rgb(238, 248, 248);
}
header {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 70px;
    background-color: #000;
    z-index: 1000;
    border-radius: 2px;
}

nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1200px;
    height: 4rem;
    padding: 0 1rem;
    margin: 0 auto;
    border-radius: 2px;
   
  
}

.logo {
    font-weight: 1000;
    font-size:40px;
    font-style: bold;
    color: #fff;
    margin-top: 20px;

}

.nav_list {
    display: flex;
    color:floralwhite;
   
}

.nav_item {
    position: relative; 
    margin: 0 1.5rem;
    padding: 1.4rem 0;
    color: #fff;
    
}

.nav_link {
    font-weight: 1000;
    font-family: "Josefin Sans", sans-serif;
    border-radius: 2px;
    font-size: medium;
    color: #eae9ee;
    font-size: 15px;
    
}
.nav_link a{
    
        font-weight: 1000;
        font-family: "Josefin Sans", sans-serif;
        border-radius: 2px;
        font-size: medium;
        color: #eae9ee;
         margin-top: 10px;
    
}

.nav_link:hover {
        color: #3f24ac;
    }
    

.dropdown_link {
    display: flex;
    align-items: center;
  
}

.dropdown_icon {
    font-size: 1rem;
}

.megamenu {
    position: absolute;
    width: 450px;
    height: 200px;
    top: 6rem;
    left: 0;
    display: flex;
    justify-content: center;
    border-radius: 0 0 20px 20px;
    box-shadow: 0 23px -21px rgba(0, 0, 0, 0.25);
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s ease, visibility 0.3s ease;
    background-color:rgb(252, 252, 255);
    z-index: 999;
    
}

.nav_item:hover .megamenu {
    opacity: 1;
    visibility: visible;
    border-radius: 0 0 20px 20px;

}

.content {
    display: flex;
    flex-direction: column;
    padding: 1rem;
    background-color: rgb(252, 252, 255);
    border-radius: 0 0 20px 20px;
   
     
    
}

.megamenu_item {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
}

.header_megamenu {
    font-weight: 800;
    color: rgb(190, 93, 125);
    margin-bottom: 1rem;
   
    
}

.megamenu_links a {
    font-weight: 700;
    color: rgb(12, 13, 119);
    margin-top: 10px;
   
}

.megamenu_links a:hover {
    color: rgb(60, 132, 173);
    text-decoration: underline;
}

.nav_item:hover .dropdown_icon {
    transform: rotate(180deg);
    transition: transform 0.3s ease;
}
.toggle_menu,.close_menu{
    display: none;

}
@media screen and (max-width: 902px) {
    .megamenu {
        justify-content: start;
        flex-wrap: wrap;
    }
}

@media screen and (max-width: 768px) {
    .megamenu {
        flex-direction: column;
        box-shadow: none;
        border-radius: 0;
        height: 100%;
        max-width: 350px;
        overflow: hidden;
    }
    .nav_list {
        position: absolute;
        height: 100vh;
        width: 100%;
        left: 0;
        top: 0;
        background-color: rgb(44, 108, 165);
        flex-direction: column;
        display: block;
        transition: 0.3s;
    }
    
    .toggle_menu, .close_menu {
        display: block;
    }
}


/* Cards */
.program{
    display:flex;
    align-items: center;
    background-color: white;
    border: 1px solid #ccc;
    border-radius: 10px;
    
    padding: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);;
    
}

.program img {
    width: 400px;
    height: 300px;
    border-radius: 10px;
    margin-right: 20px;
    object-fit: cover;
}
.program h2{
    margin-top: 0;
    color: #4CAF50;
}
.program p{
    margin: 5px 0;
color: #333;
font-size:20px;
padding: 5px;
}

. details{
    flex: 1;
}
.hero {
    position: relative;
    text-align: center;
    
}

.hero img {
border-radius: 10px;
padding: 0;
}

.hero-text {
    position: absolute;
    top: 55%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: #77cd60;
    background: rgba(0, 0, 0, 0.75);
    padding: 80px;
    border-radius: 15px;
}
.hero-text h1{
    font-size: 25px;
    margin-bottom: 10px;
}
.hero-text p{
    font-size: 19px;
}
* Media Query for devices with max-width of 480px (mobile devices) */
@media (max-width: 480px) {
    .hero img {
        height: auto; /* Adjust height to maintain aspect ratio */
    }
    
    .hero-text {
        padding: 30px;
        font-size: 16px;
        top: 50%;
    }
    
    .program {
        flex-direction: column;
        align-items: center;
    }
    
    .program img {
        width: 100%;
        height: auto;
    }
    
    .program .details {
        padding: 10px;
    }
    
    .program p {
        font-size: 16px;
    }
}

/* Media Query for devices with max-width of 768px (tablets) */
@media (max-width: 768px) {
    .hero img {
        height: 400px;
    }
    
    .hero-text {
        padding: 40px;
        font-size: 18px;
    }
    
    .program {
        flex-direction: column;
    }
    
    .program img {
        width: 100%;
        height: auto;
    }
    
    .program .details {
        padding: 15px;
    }
    
    .program p {
        font-size: 18px;
    }
}

/* Media Query for devices with max-width of 1024px (small laptops and larger tablets) */
@media (max-width: 1024px) {
    .hero img {
        height: 450px;
    }
    
    .hero-text {
        padding: 50px;
        font-size: 20px;
    }
    
    .program {
        flex-direction: row;
    }
    
    .program img {
        width: 300px;
        height: auto;
    }
    
    .program .details {
        padding: 20px;
    }
    
    .program p {
        font-size: 20px;
    }
}
/* Base styles for small screens */
@media screen and (max-width: 480px) {
    .logo {
        font-size: 28px;
        margin-top: 10px;
    }

    .nav_list {
        display: none; /* Hide the navigation list */
        flex-direction: column;
        width: 100%;
        background-color: #000;
        position: absolute;
        top: 70px;
        left: 0;
    }

    .nav_item {
        margin: 0;
        padding: 1rem 0;
    }

    .nav_link {
        font-size: 14px;
    }

    .toggle_menu, .close_menu {
        display: block;
        font-size: 24px;
        color: #fff;
    }

    .megamenu {
        width: 100%;
        height: auto;
        top: 3rem;
    }

    .content {
        padding: 0.5rem;
    }
}

/* Styles for tablets and small desktops */
@media screen and (max-width: 768px) {
    .logo {
        font-size: 32px;
        margin-top: 15px;
    }

    .nav_list {
        display: none; /* Hide the navigation list */
        flex-direction: column;
        width: 100%;
        background-color: #000;
        position: absolute;
        top: 70px;
        left: 0;
    }

    .nav_item {
        margin: 0;
        padding: 1rem 0;
    }

    .nav_link {
        font-size: 15px;
    }

    .toggle_menu, .close_menu {
        display: block;
        font-size: 20px;
        color: #fff;
    }

    .megamenu {
        width: 100%;
        height: auto;
        top: 3rem;
    }

    .content {
        padding: 0.5rem;
    }
}

/* Styles for larger tablets and small desktops */
@media screen and (max-width: 1024px) {
    .logo {
        font-size: 36px;
        margin-top: 15px;
    }

    .nav_list {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }

    .nav_item {
        margin: 0 1rem;
        padding: 1rem 0;
    }

    .nav_link {
        font-size: 16px;
    }

    .toggle_menu, .close_menu {
        display: none;
    }

    .megamenu {
        width: 300px;
        height: auto;
        top: 5rem;
    }

    .content {
        padding: 1rem;
    }
}

/*footer html*/

footer {
    background-color:#333;
    color: #fff;
    padding: 20px;
    font-family: Arial, sans-serif;
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

    .search input[type="text"] {
        width: 60%;
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

    .search input[type="text"] {
        width: 70%;
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

    .search input[type="text"] {
        width: 80%;
    }
}

    </style>
  
</head>
<body>

<header>
        <nav>
              <div class="logo">ZooParc Adventures</div>
              <div class="toggle_menu">
                <i class='bx bxs-grid-alt'></i>
              </div>
              <ul class="nav_list">
                <div class="close_menu">
                    <i class='bx bx-x'></i>
                </div>
                <li class="nav_item "dropdown ><a href="..\html\home.html" class="nav_link dropdown_link">Home <i class='bx bxs-chevron-down dropdown_icon'></i></a>
                  <div class="megamenu">
                    <ul class="content">
                        <li class="megamenu_items header_megamenu">Visit</li>
                        <li class="megamenu_item ">
                            <div class="menu_icon">

                            </div>
                            <div class="megamenu_links">
                                <a href="..\html\zoomap.html">zoo map</a>
                                <p></p>
                            </div>
                        </li>
                        <li class="megamenu_item ">
                            <div class="menu_icon">

                            </div>
                            <div class="megamenu_links">
                                <a href="..\html\tickects.html">hours and tickects</a>
                                <p></p>
                            </div>
                        </li>
                        <li class="megamenu_item ">
                            <div class="menu_icon">

                            </div>
                            <div class="megamenu_links">
                                <a href="..\html\food.html">food and shops</a>
                                <p></p>
                            </div>
                        </li>
                        <li class="megamenu_item ">
                            <div class="menu_icon">

                            </div>
                            <div class="megamenu_links">
                                <a href="..\html\visit.html">plan to visit</a>
                                <p></p>
                            </div>
                        </li>
                    </ul>
                    <ul class="content">
                        <li class="megamenu_items header_megamenu">Animals</li>
                        <li class="megamenu_item ">
                            <div class="menu_icon">

                            </div>
                            <div class="megamenu_links">
                                <a href="..\php\animals.php">Gallery</a>
                                <p></p>
                            </div>
                        </li>
                        <li class="megamenu_item ">
                            <div class="menu_icon">

                            </div>
                            <div class="megamenu_links">
                                <a href="..\html\mammals.html">Mammals & fishes</a>
                                <p></p>
                            </div>
                        </li>
                        <li class="megamenu_item ">
                            <div class="menu_icon">

                            </div>
                            <div class="megamenu_links">
                                <a href="..\html\reptlies.html">amphibious & reptelious</a>
                                <p></p>
                            </div>
                        </li>
                        <li class="megamenu_item ">
                            <div class="menu_icon">

                            </div>
                            <div class="megamenu_links">
                                <a href="..\html\birds.html">birds</a>
                                <p></p>
                            </div>
                        </li>
                    </ul>
                    <ul class="content">
                        <li class="megamenu_items header_megamenu">Education & Events</li>
                        <li class="megamenu_item ">
                            <div class="menu_icon">

                            </div>
                            <div class="megamenu_links">
                                <a href="..\php\programs.php">Educational Programs</a>
                                <p></p>
                            </div>
                        </li>
                        <li class="megamenu_item ">
                            <div class="menu_icon">

                            </div>
                            <div class="megamenu_links">
                                <a href="..\php\events.php">Events</a>
                                <p></p>
                            </div>
                        </li>
                        
                    </ul>
                    <ul class="content">
                        <li class="megamenu_items header_megamenu"> Support</li>
                        <li class="megamenu_item ">
                            <div class="menu_icon">

                            </div>
                            <div class="megamenu_links">
                                <a href="..\html\volunteer.html">Volunteer</a>
                                <p></p>
                            </div>
                        </li>
                        <li class="megamenu_item ">
                            <div class="menu_icon">

                            </div>
                            <div class="megamenu_links">
                                <a href="..\html\member.html">Member</a>
                                <p></p>
                            </div>
                        </li>
                        <li class="megamenu_item ">
                            <div class="menu_icon">

                            </div>
                            <div class="megamenu_links">
                                <a href="..\html\donation.html">Donate</a>
                                <p></p>
                            </div>
                        </li>
                        <li class="megamenu_item ">
                            <div class="menu_icon">

                            </div>
                            <div class="megamenu_links">
                                <a href="..\php\register.php">Register</a>
                                <p></p>
                            </div>
                        </li>
                    </ul>
                    
                  </div>
                </li>
                <li class="nav_item"><a href="..\php\register.php" class="nav_link ">Register</a></li>
                <li class="nav_item"><a href="..\html\donation.html" class="nav_link">Donate</a></li>
                <li class="nav_item"><a href="..\php\login.php" class="nav_link">Login</a></li>
                <li class="nav_item"><a href="..\html\visit.html" class="nav_link">Plan to visit</a></li>
              </ul>
        </nav>
    </header>  
          
    <section class="hero">
        <img src="..\img\program.png" alt="event" width="100%" height="500">
        <div class="hero-text">
            <h1> Discover, Learn and Explore with Our Educational Programs!</h1>
            <p>Join us at ZooParc to inspire curiosity, connect with nature and learn about wildlife  through hands-on experiences and engaging activities.
            </p>
        </div>
    </section> 
   

    <div class="program-list">
        <?php while ($program = $programs->fetch_assoc()) { ?>
        <div class="program">
           
            <img src="<?php echo htmlspecialchars($program['picture']); ?>" alt="Program Picture">
            <div class="details">
            <h2><?php echo htmlspecialchars($program['name']); ?></h2>
           <div> <p><?php echo htmlspecialchars($program['description']); ?></p>
            <p><?php echo htmlspecialchars($program['details']); ?></p></div></div>
        </div>
        <?php } ?>
    </div>
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
