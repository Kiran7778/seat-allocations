<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css"> <!-- Link to your custom CSS if needed -->
</head>
<body>
    <style>
      body {
    background-color: #f8f9fa; /* Light background for better contrast */
    font-family: Arial, sans-serif; /* Use a clean font for better readability */
}

.container {
    margin-top: 30px;
}

h1 {
    color: #343a40; /* Darker color for headings */
    font-size: 2.5rem; /* Increase heading size */
    transition: color 0.3s ease; /* Smooth color transition */
}

h1:hover {
    color: #007bff; /* Change color on hover */
}

p {
    font-size: 1.2rem; /* Slightly larger font for better readability */
    color: #6c757d; /* A gray color for the paragraph text */
    transition: color 0.3s ease; /* Smooth color transition */
}

p:hover {
    color: #495057; /* Darker gray on hover */
}

.navbar {
    margin-bottom: 20px; /* Space below the navbar */
    border-radius: 0.5rem; /* Rounded corners for the navbar */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Light shadow for depth */
}

.nav-link {
    transition: color 0.3s ease, background-color 0.3s ease; /* Smooth transition for color and background */
}

.nav-link:hover {
    color: white; /* Change text color on hover */
    background-color: #007bff; /* Primary color background on hover */
    border-radius: 0.25rem; /* Rounded corners on hover */
}

.nav-link.active {
    font-weight: bold; /* Bold the active link */
    color: #fff; /* White color for active link */
    background-color: #007bff; /* Primary color background for active link */
    border-radius: 0.25rem; /* Rounded corners for active link */
}

.card {
    margin: 10px 0; /* Space between cards */
    transition: transform 0.3s ease; /* Smooth transformation */
}

.card:hover {
    transform: scale(1.05); /* Slightly enlarge card on hover */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Shadow on hover for depth */
}

.btn-custom {
    background-color: #28a745; /* Custom button color */
    color: white; /* Button text color */
    transition: background-color 0.3s ease; /* Smooth background color transition */
}

.btn-custom:hover {
    background-color: #218838; /* Darker green on hover */
}


</style>
    <div class="container mt-4">
        <h1>Dashboard</h1>
        <p>Welcome to your Jira Clone Dashboard! Navigate to Projects or Issues to manage tasks.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const path = window.location.pathname;
            const navLinks = document.querySelectorAll('.nav-link');

            navLinks.forEach(link => {
                if (link.href.includes(path)) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>
