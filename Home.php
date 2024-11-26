<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Home - Project Management System</title>
</head>
<style>
/* Additional inline CSS for styling */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f7fa;
}

.navbar {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.navbar-brand {
    font-weight: bold;
    color: #007bff !important;
    transition: color 0.3s;
}

.navbar-brand:hover {
    color: #0056b3 !important;
}

.nav-link {
    color: #343a40;
    font-weight: 500;
    transition: color 0.3s;
}

.nav-link:hover {
    color: #007bff;
}

.carousel-inner {
    height: 400px; /* Adjust as needed */
    background-color: #f8f9fa;
}

.carousel-item {
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 1.5rem;
    color: #343a40;
    transition: transform 0.5s ease;
}

.carousel-item.active {
    transform: scale(1.05);
}

.container {
    max-width: 800px;
    margin-top: 30px;
    animation: fadeIn 1.5s ease;
}

h1 {
    font-size: 2.5rem;
    color: #333;
    margin-bottom: 15px;
}

p.lead {
    font-size: 1.25rem;
    color: #666;
}

/* Button Hover Effect */
.nav-item .nav-link {
    position: relative;
    overflow: hidden;
}

.nav-item .nav-link::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: 0;
    width: 100%;
    height: 2px;
    background-color: #007bff;
    transform: scaleX(0);
    transform-origin: right;
    transition: transform 0.3s ease;
}

.nav-item .nav-link:hover::after {
    transform: scaleX(1);
    transform-origin: left;
}

/* Carousel Button Styles */
.carousel-control-prev-icon,
.carousel-control-next-icon {
    background-color: #007bff;
    border-radius: 50%;
    padding: 10px;
}

/* Fade-in Animation */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Project Management System</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                    <a class="nav-link" href="register.php">Register </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Task Mangement</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="submit_project.php">Submit Project</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="approve_projects.php">Approve Projects</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container text-center mt-5">
        <h1>Welcome to Project Management System</h1>
        <p class="lead">Manage your projects efficiently.</p>
        
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>