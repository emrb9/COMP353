<?php

class EmployeeController extends Controller
{

    /**
     * Main landing page for the Employees section of the system.
     *
     * This method is adapted to focus on loading employee profiles, potentially including their roles,
     * vaccination status, and other pertinent details rather than general profiles.
     */
    public function index()
    {
        // Check if the user is signed in
        if (isset($_SESSION['user_id'])) {
            $connection = $this->model('Employee');

            // Calling a method from the Connection model to load all employee details
            // This could include roles, vaccination status, etc.
            $connections = $connection->getAllEmployeeDetails();

            // Load the Employee index view with the correct data
            $this->view('Employee/index', $connections);
        } else {
            // Redirect to the Home/Index view if not signed in
            $this->view('Home/Index');
        }
    }
    public function save()
    {
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'error' => 'Not authenticated']);
            exit;
        }
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $connection = $this->model('Employee');
            $data = [
                'SSN' => $_POST['SSN'] ?? '',
                'medicareNumber' => $_POST['medicareNumber'] ?? '',
                'role' => $_POST['role'] ?? '',
            ];
    
            try {
                // Check if the employee exists to decide whether to add or update
                $exists = $connection->checkEmployeeExists($data['SSN']);
    
                if ($exists) {
                    $result = $connection->updateEmployee($data['SSN'], $data);
                } else {
                    $result = $connection->addEmployee($data);
                }
    
                if ($result) {
                    echo json_encode(['success' => true, 'message' => 'Employee saved successfully']);
                } else {
                    echo json_encode(['success' => false, 'error' => 'Failed to save the employee.']);
                }
                exit;
            } catch (Exception $e) {
                http_response_code(500); 
                echo json_encode(['success' => false, 'error' => $e->getMessage()]);
                exit;
            }
        }
    }    

    public function delete($SSN)
{
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false, 'error' => 'Not authenticated']);
        exit;
    }

    $connection = $this->model('Employee');
    if ($connection->deleteEmployee($SSN)) {
        echo json_encode(['success' => true, 'message' => 'Employee deleted successfully']);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => 'Deletion failed. Employee might have related records.']);
    }
    exit;
}

}

?>