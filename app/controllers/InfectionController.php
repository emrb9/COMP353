<?php

class infectionController extends Controller
{
    public function index()
    {
        $infection = $this->model('Infection');
        $infections = $infection->getAllInfections();
        $this->view('Infection/Index', $infections);
    }

    public function add()
    {
        if (isset($_POST['action'])) {
            $infection = $this->model('Infection');

            // Basic input validation example
            if (!empty($_POST['SSN']) && !empty($_POST['type'])&& !empty($_POST['date'])) {
                // Sanitizing inputs as an extra layer of security
                $infection->SSN = filter_var($_POST['SSN'], FILTER_SANITIZE_STRING);
                $infection->type = filter_var($_POST['type'], FILTER_SANITIZE_STRING);
                $infection->date = filter_var($_POST['date'], FILTER_SANITIZE_STRING);
                if($infection->addinfection()) {
                    header("Location: /Infection?message=Addition+Successful");
                } else {
                    header("Location: /Infection/Addinfection?error=Addition+Failed");
                }
            } else {
                header("Location: /Infection/Addinfection?error=Validation+Failed");
            }
            exit();
        }
        $this->view('Infection/Addinfection');
    }

    public function edit() {
        // Check if the form was submitted via POST with the required data
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['SSN']) && isset($_POST['type'])&& isset($_POST['date'])) {
            // Sanitize the input for security
            $SSN = filter_var($_POST['SSN'], FILTER_SANITIZE_STRING);
            $type = filter_var($_POST['type'], FILTER_SANITIZE_STRING);
            $date = filter_var($_POST['date'], FILTER_SANITIZE_STRING);
    
            // Fetch the infection's details using the provided address and postalCode
            $infectionModel = $this->model('Infection');
            $infection = $infectionModel->getinfectionById($SSN, $type, $date);
    
            if ($infection) {
                // If the infection is found, pass its details to the view to pre-fill the edit form
                $this->view('Infection/Editinfection', ['infection' => $infection]);
            } else {
                // Redirect with an error if the infection cannot be found
                header('Location: /Infection?error=Infection+Not+Found');
                exit();
            }
        } else {
            // Redirect or handle the case where the necessary POST data wasn't provided
            header('Location: /Infection?error=Missing+Data');
            exit();
        }
    }   

    public function editAction() {
        if (isset($_POST['action'])) {
            $infectionModel = $this->model('Infection');
    
            // Retrieve all the form data
            $SSN = filter_var($_POST['SSN'], FILTER_SANITIZE_STRING);
            $type = filter_var($_POST['type'], FILTER_SANITIZE_STRING);
            $date = filter_var($_POST['date'], FILTER_SANITIZE_STRING);

    
            // Attempt to update the infection
            if ($infectionModel->updateinfection($SSN, $type, $date)) {
                header("Location: /Infection?message=Update+Successful");
            } else {
                header("Location: /Infection?error=Update+Failed");
            }
            exit();
        }
    }
    

public function delete()
{
    if (isset($_POST['SSN']) && isset($_POST['type'])&& isset($_POST['date'])) {
        $SSN = filter_var($_POST['SSN'], FILTER_SANITIZE_STRING);
        $type = filter_var($_POST['type'], FILTER_SANITIZE_STRING);
        $date = filter_var($_POST['date'], FILTER_SANITIZE_STRING);

        $infection = $this->model('Infection');
        $infection->SSN = $SSN;
        $infection->type = $type;
        $infection->date = $date;

        if ($infection->deleteinfection()) {
            header("Location: /Infection?message=Deletion+Successful");
        } else {
            header("Location: /Infection?error=Deletion+Failed");
        }
    } else {
        // Redirect or handle the error if address or postalCode aren't provided
        header("Location: /Infection?error=Missing+Data");
    }
    exit();
}
}

?>