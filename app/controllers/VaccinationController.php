<?php

class vaccinationController extends Controller
{
    public function index()
    {
        $vaccination = $this->model('Vaccination'); // get a reference to the Vaccination object model
        $vaccinations = $vaccination->getAllVaccinations(); // call the method to retrieve all the companies from the DB
        $this->view('Vaccination/Index', $vaccinations);
    }

    public function add()
    {
        if (isset($_POST['action'])) {
            $vaccination = $this->model('Vaccination');

            // Basic input validation example
            if (!empty($_POST['SSN']) && !empty($_POST['doseNumber']) && !empty($_POST['type'])) {
                // Sanitizing inputs as an extra layer of security
                $vaccination->SSN = filter_var($_POST['SSN'], FILTER_SANITIZE_STRING);
                $vaccination->doseNumber = filter_var($_POST['doseNumber'], FILTER_SANITIZE_STRING);
                $vaccination->type = filter_var($_POST['type'], FILTER_SANITIZE_STRING);
                $vaccination->date = filter_var($_POST['date'], FILTER_SANITIZE_STRING);
                $vaccination->address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
                $vaccination->postalCode = filter_var($_POST['postalCode'], FILTER_SANITIZE_STRING);

                if($vaccination->addvaccination()) {
                    header("Location: /Vaccination?message=Addition+Successful");
                } else {
                    header("Location: /Vaccination/Addvaccination?error=Addition+Failed");
                }
            } else {
                header("Location: /Vaccination/Addvaccination?error=Validation+Failed");
            }
            exit();
        }
        $this->view('Vaccination/Addvaccination');
    }

    public function edit() {
        // Check if the form was submitted via POST with the required data
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['SSN']) && isset($_POST['doseNumber']) && isset($_POST['type'])) {
            // Sanitize the input for security
            $SSN = filter_var($_POST['SSN'], FILTER_SANITIZE_STRING);
            $doseNumber = filter_var($_POST['doseNumber'], FILTER_SANITIZE_STRING);
            $type = filter_var($_POST['type'], FILTER_SANITIZE_STRING);
            // Fetch the vaccination's details using the provided address and postalCode
            $vaccinationModel = $this->model('Vaccination');
            $vaccination = $vaccinationModel->getvaccinationById($SSN, $doseNumber, $type);
    
            if ($vaccination) {
                // If the vaccination is found, pass its details to the view to pre-fill the edit form
                $this->view('Vaccination/Editvaccination', ['vaccination' => $vaccination]);
            } else {
                // Redirect with an error if the vaccination cannot be found
                header('Location: /Vaccination?error=Vaccination+Not+Found');
                exit();
            }
        } else {
            // Redirect or handle the case where the necessary POST data wasn't provided
            header('Location: /Vaccination?error=Missing+Data');
            exit();
        }
    }   

    public function editAction() {
        if (isset($_POST['action'])) {
            $vaccinationModel = $this->model('Vaccination');
    
            // Retrieve all the form data
            $SSN = filter_var($_POST['SSN'], FILTER_SANITIZE_STRING);
            $doseNumber = filter_var($_POST['doseNumber'], FILTER_SANITIZE_STRING);
            $type = filter_var($_POST['type'], FILTER_SANITIZE_STRING);
            $date = filter_var($_POST['date'], FILTER_SANITIZE_STRING);
            $type = filter_var($_POST['type'], FILTER_SANITIZE_STRING);
            $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
            $postalCode = filter_var($_POST['postalCode'], FILTER_SANITIZE_STRING);

    
            // Attempt to update the vaccination
            if ($vaccinationModel->updatevaccination($SSN, $doseNumber, $type, $date, $address, $postalCode)) {
                header("Location: /Vaccination?message=Update+Successful");
            } else {
                header("Location: /Vaccination?error=Update+Failed");
            }
            exit();
        }
    }
    

public function delete()
{
    if (isset($_POST['SSN']) && isset($_POST['doseNumber'])&& isset($_POST['type'])) {
        $SSN = filter_var($_POST['SSN'], FILTER_SANITIZE_STRING);
        $doseNumber = filter_var($_POST['doseNumber'], FILTER_SANITIZE_STRING);
        $type = filter_var($_POST['type'], FILTER_SANITIZE_STRING);

        $vaccination = $this->model('Vaccination');
        $vaccination->SSN = $SSN;
        $vaccination->doseNumber = $doseNumber;
        $vaccination->type = $type;

        if ($vaccination->deletevaccination()) {
            header("Location: /Vaccination?message=Deletion+Successful");
        } else {
            header("Location: /Vaccination?error=Deletion+Failed");
        }
    } else {
        // Redirect or handle the error if address or postalCode aren't provided
        header("Location: /Vaccination?error=Missing+Data");
    }
    exit();
}
}

?>