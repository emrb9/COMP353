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
            $connection = $this->model('Connection');

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
    /* TO DO: INTEGRATE save() */
    public function save()
    {
        if (!isset($_SESSION['user_id'])) {
            // Respond with JSON if not authenticated
            echo json_encode(['success' => false, 'error' => 'Not authenticated']);
            exit;
        }

        // Check if the request is POST to handle form submission
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $connection = $this->model('Connection');
            $data = [
                'SSN' => $_POST['SSN'] ?? '',
                'firstName' => $_POST['firstName'] ?? '',
                'lastName' => $_POST['lastName'] ?? '',
                'role' => $_POST['role'] ?? '',
                // Add other form fields as needed
                'vaccinationType' => $_POST['vaccinationType'] ?? '',
                'doseNumber' => $_POST['doseNumber'] ?? '',
                'vaccinationDate' => $_POST['vaccinationDate'] ?? '',
            ];

            try {
                if (empty($data['SSN'])) {
                    $connection->addEmployee($data);
                } else {
                    $connection->updateEmployee($data['SSN'], $data);
                }

                // Respond with JSON on success
                echo json_encode(['success' => true]);
            } catch (Exception $e) {
                // Respond with JSON on error
                http_response_code(500); // Set appropriate HTTP status code
                echo json_encode(['success' => false, 'error' => $e->getMessage()]);
            }
            exit;
        }
    }

    public function delete($SSN)
    {
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['error' => 'Not authenticated']);
            exit;
        }

        $connection = $this->model('Connection');
        if ($connection->deleteEmployee($SSN)) {
            echo json_encode(['success' => 'Employee deleted successfully']);
        } else {
            // In case of failure, consider sending a different HTTP status code
            http_response_code(500);
            echo json_encode(['error' => 'Deletion failed']);
        }
        exit;
    }

}

?>