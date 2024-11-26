<?php
require_once 'db_connect.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $project_id = $_POST['project_id'];
    $assigned_to = $_POST['assigned_to'];
    $priority = $_POST['priority'];
    
    $stmt = $pdo->prepare("INSERT INTO issues (title, description, project_id, assigned_to, priority) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$title, $description, $project_id, $assigned_to, $priority]);
}

// Fetch issues with project and user information
$stmt = $pdo->query("
    SELECT i.*, p.name as project_name, u.username as assigned_user
    FROM issues i
    LEFT JOIN projects p ON i.project_id = p.id
    LEFT JOIN users u ON i.assigned_to = u.id
    ORDER BY i.id DESC
");
$issues = $stmt->fetchAll();

// Fetch projects for the dropdown
$projects = $pdo->query("SELECT id, name FROM projects")->fetchAll();

// Fetch users for the dropdown
$users = $pdo->query("SELECT id, username FROM users")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jira-like Interface</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <style>
        /* Navbar Styling */
.custom-navbar {
    font-family: Arial, sans-serif;
    padding: 1rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    background: linear-gradient(90deg, #0d6efd, #6610f2, #6f42c1);
}

/* Navbar Brand Styling */
.custom-navbar .navbar-brand {
    font-weight: bold;
    font-size: 1.5rem;
    color: #f8f9fa;
    transition: color 0.3s;
}

.custom-navbar .navbar-brand:hover {
    color: #ffc107;
    text-shadow: 0 0 10px rgba(255, 193, 7, 0.7);
}

/* Navbar Link Styling - Base */
.custom-navbar .nav-link {
    font-size: 1rem;
    color: #adb5bd;
    padding: 8px 15px;
    transition: color 0.3s, background-color 0.3s;
    border-radius: 5px;
}

/* Unique Colors for Each Link */
.custom-navbar .nav-link.dashboard-link:hover {
    color: #0d6efd;
    background-color: rgba(13, 110, 253, 0.1);
}

.custom-navbar .nav-link.projects-link:hover {
    color: #6610f2;
    background-color: rgba(102, 16, 242, 0.1);
}

.custom-navbar .nav-link.issues-link:hover {
    color: #fd7e14;
    background-color: rgba(253, 126, 20, 0.1);
}

/* Active Link Styling */
.custom-navbar .nav-link.active {
    color: #f8f9fa;
    background-color: #20c997;
    border-radius: 5px;
}

/* Toggler Styling */
.custom-navbar .navbar-toggler {
    border-color: #adb5bd;
}

.custom-navbar .navbar-toggler-icon {
    filter: brightness(0) invert(1);
}

/* Mobile Responsive Styles */
@media (max-width: 992px) {
    .custom-navbar .nav-link {
        font-size: 1.2rem;
        text-align: center;
        margin: 5px 0;
    }
}
</style>
<!-- Navbar HTML -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark custom-navbar">
    <div class="container-fluid">
        <a class="navbar-brand" href="dashboard.php">Jira Clone</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link dashboard-link active" href="dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link projects-link" href="projects.php">Projects</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link issues-link" href="issues.php">Issues</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


    <div class="container mt-4">
        <h1>Welcome to Your Jira Clone</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Create New Issue
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label for="title" class="form-label">Issue Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="project_id" class="form-label">Project</label>
                                <select class="form-control" id="project_id" name="project_id" required>
                                    <?php foreach ($projects as $project): ?>
                                        <option value="<?= $project['id'] ?>"><?= htmlspecialchars($project['name']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="assigned_to" class="form-label">Assign To</label>
                    
                                <select class="form-control" id="assigned_to" name="assigned_to" required>
                                    <?php foreach ($users as $user): ?>
                                        <option value="<?= $user['id'] ?>"><?= htmlspecialchars($user['username']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="priority" class="form-label">Priority</label>
                                <select class="form-control" id="priority" name="priority" required>
                                    <option value="Low">Low</option>
                                    <option value="Medium" selected>Medium</option>
                                    <option value="High">High</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Create Issue</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Issue List
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <?php foreach ($issues as $issue): ?>
                                <li class="list-group-item">
                                    <h5><?= htmlspecialchars($issue['title']) ?></h5>
                                    <p><?= htmlspecialchars($issue['description']) ?></p>
                                    <small>
                                        Project: <?= htmlspecialchars($issue['project_name']) ?> |
                                        Assigned to: <?= htmlspecialchars($issue['assigned_user']) ?> |
                                        Priority: <?= htmlspecialchars($issue['priority']) ?> |
                                        Status: <?= htmlspecialchars($issue['status']) ?>
                                    </small>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="scripts.js"></script>
</body>
</html>