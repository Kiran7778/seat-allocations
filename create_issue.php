<?php
// Include the database connection file
require_once 'db_connect.php';

// Set the content type to JSON
header('Content-Type: application/json');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the raw POST data and decode the JSON
    $data = json_decode(file_get_contents('php://input'), true);

    // Validate input data
    if (isset($data['title'], $data['description'], $data['project_id'], $data['assigned_to'], $data['priority'])) {
        $title = $data['title'];
        $description = $data['description'];
        $project_id = $data['project_id'];
        $assigned_to = $data['assigned_to'];
        $priority = $data['priority'];

        try {
            // Prepare the SQL statement to insert the new issue
            $stmt = $pdo->prepare("INSERT INTO issues (title, description, project_id, assigned_to, priority) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$title, $description, $project_id, $assigned_to, $priority]);
            
            // Fetch the newly created issue
            $issueId = $pdo->lastInsertId();
            $stmt = $pdo->prepare("
                SELECT i.*, p.name as project_name, u.username as assigned_user
                FROM issues i
                LEFT JOIN projects p ON i.project_id = p.id
                LEFT JOIN users u ON i.assigned_to = u.id
                WHERE i.id = ?
            ");
            $stmt->execute([$issueId]);
            $issue = $stmt->fetch(PDO::FETCH_ASSOC);

            // Return the success response with the created issue
            echo json_encode(['success' => true, 'issue' => $issue]);
        } catch (PDOException $e) {
            // Return error response in case of a database error
            echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
        }
    } else {
        // Return error response if required fields are missing
        echo json_encode(['success' => false, 'message' => 'Invalid input data']);
    }
} else {
    // Return error response if the request method is not POST
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>