<?php
session_start();

// Check if the user is an admin
if (!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] !== true) {
    header("Location: error.php");
    exit();
}

// Database connection
$host = 'localhost';
$db = 'jira'; // Replace with your actual database name
$user = 'your_username'; // Replace with your actual username
$pass = 'your_password'; // Replace with your actual password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Fetching project data
    $stmt = $pdo->query("SELECT project_name, student_name, marks FROM projects");
    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Projects</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <style>
        /* General body styling */
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        /* Container styling */
        .container {
            margin-top: 50px;
            max-width: 900px;
        }

        /* Header styling */
        h1 {
            color: #343a40;
            font-size: 2.5rem;
            text-align: center;
            margin-bottom: 30px;
        }

        /* Table styling */
        table {
            margin-top: 20px;
            background-color: #fff;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            padding: 15px;
            text-transform: uppercase;
        }
        
        td {
            padding: 12px 15px;
            text-align: center;
            color: #333;
        }

        /* Hover effect for rows */
        tr:hover {
            background-color: #f1f1f1;
        }

        /* Zebra striping */
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Button styles */
        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .btn-primary:hover {
            background-color: #0056b3;
        }

        /* Responsive table styling */
        @media (max-width: 768px) {
            table {
                font-size: 0.9rem;
            }
  }
  body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 50px;
            max-width: 900px;
        }

        h1 {
            color: #343a40;
            font-size: 2.5rem;
            text-align: center;
            margin-bottom: 30px;
        }

        /* Table styling */
        table {
            margin-top: 20px;
            background-color: #fff;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        th {
            background-color: #007bff;
            color: Blue;
            font-weight: bold;
            padding: 15px;
            text-transform: uppercase;
        }

        /* Column-specific colors */
        .project-name {
            color: #ff5733; /* Project Name color (orange) */
        }

        .student-name {
            color: #33c3ff; /* Student Name color (light blue) */
        }

        .marks {
            color: #28a745; /* Marks color (green) */
        }

        /* Row hover effect */
        tr:hover {
            background-color: #f1f1f1;
        }

        /* Zebra striping */
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
  


               
    </style>
</head>
<body>
    <div class="container">
        <h1>Project Management</h1>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Project Name</th>
                    <th>Student Name</th>
                    <th>Marks</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($projects) > 0): ?>
                    <?php foreach ($projects as $project): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($project['project_name']); ?></td>
                            <td><?php echo htmlspecialchars($project['student_name']); ?></td>
                            <td><?php echo htmlspecialchars($project['marks']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center">No projects found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS for responsiveness -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
