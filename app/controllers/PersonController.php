<?php

class personController extends Controller
{
    public function index()
    {
        $person = $this->model('Person'); // get a reference to the Person object model
        $persons = $person->getAllPersons(); // call the method to retrieve all the companies from the DB
        $this->view('Person/Index', $persons); // load the person index view with the passed data
    }

    public function add()
    {
        if (isset($_POST['action'])) {
            $person = $this->model('Person');

            // Basic input validation example
            if (!empty($_POST['SSN'])) {
                // Sanitizing inputs as an extra layer of security
                $person->SSN = filter_var($_POST['SSN'], FILTER_SANITIZE_STRING);
                $person->cellNumber = filter_var($_POST['cellNumber'], FILTER_SANITIZE_STRING);
                $person->firstName = filter_var($_POST['firstName'], FILTER_SANITIZE_STRING);
                $person->lastName = filter_var($_POST['lastName'], FILTER_SANITIZE_STRING);
                $person->citizenship = filter_var($_POST['citizenship'], FILTER_SANITIZE_STRING);
                $person->dateOfBirth = filter_var($_POST['dateOfBirth'], FILTER_SANITIZE_STRING);
                $person->emailAddress = filter_var($_POST['emailAddress'], FILTER_SANITIZE_STRING);
                $person->occupation = filter_var($_POST['occupation'], FILTER_SANITIZE_STRING);

                if($person->addperson()) {
                    header("Location: /Person?message=Addition+Successful");
                } else {
                    header("Location: /Person/Addperson?error=Addition+Failed");
                }
            } else {
                header("Location: /Person/Addperson?error=Validation+Failed");
            }
            exit();
        }
        $this->view('Person/Addperson');
    }

    public function edit() {
        // Check if the form was submitted via POST with the required data
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['SSN'])) {
            // Sanitize the input for security
            $SSN = filter_var($_POST['SSN'], FILTER_SANITIZE_STRING);
    
            // Fetch the person's details using the provided address and postalCode
            $personModel = $this->model('Person');
            $person = $personModel->getpersonById($SSN);
    
            if ($person) {
                // If the person is found, pass its details to the view to pre-fill the edit form
                $this->view('Person/Editperson', ['person' => $person]);
            } else {
                // Redirect with an error if the person cannot be found
                header('Location: /Person?error=Person+Not+Found');
                exit();
            }
        } else {
            // Redirect or handle the case where the necessary POST data wasn't provided
            header('Location: /Person?error=Missing+Data');
            exit();
        }
    }   

    public function editAction() {
        if (isset($_POST['action'])) {
            $personModel = $this->model('Person');
    
            // Retrieve all the form data
            $SSN = filter_var($_POST['SSN'], FILTER_SANITIZE_STRING);
            $cellNumber = filter_var($_POST['cellNumber'], FILTER_SANITIZE_STRING);
            $firstName = filter_var($_POST['firstName'], FILTER_SANITIZE_STRING);
            $lastName = filter_var($_POST['lastName'], FILTER_SANITIZE_STRING);
            $citizenship = filter_var($_POST['citizenship'], FILTER_SANITIZE_STRING);
            $dateOfBirth = filter_var($_POST['dateOfBirth'], FILTER_SANITIZE_STRING);
            $emailAddress = filter_var($_POST['emailAddress'], FILTER_SANITIZE_STRING);
            $occupation = filter_var($_POST['occupation'], FILTER_SANITIZE_STRING);

            // Update related tables here before updating the Persons table (only if you want to change SSN)
            // Example: $personModel->updateLivesWith($originalSSN, $SSN);

    
            // Attempt to update the person
            if ($personModel->updateperson($SSN, $cellNumber, $firstName, $lastName, $citizenship, $dateOfBirth, $emailAddress, $occupation)) {
                header("Location: /Person?message=Update+Successful");
            } else {
                header("Location: /Person?error=Update+Failed");
            }
            exit();
        }
    }
    

public function delete()
{
    if (isset($_POST['SSN'])) {
        $SSN = filter_var($_POST['SSN'], FILTER_SANITIZE_STRING);

        $person = $this->model('Person');
        $person->SSN = $SSN;

        if ($person->deleteperson()) {
            header("Location: /Person?message=Deletion+Successful");
        } else {
            header("Location: /Person?error=Deletion+Failed");
        }
    } else {
        // Redirect or handle the error if address or postalCode aren't provided
        header("Location: /Person?error=Missing+Data");
    }
    exit();
}
}

?>