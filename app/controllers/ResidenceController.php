<?php

class residenceController extends Controller
{
    public function index()
    {
        $residence = $this->model('Residence');
        $residences = $residence->getAllResidences();
        $this->view('Residence/Index', $residences);
    }

    public function add()
    {
        if (isset($_POST['action'])) {
            $residence = $this->model('Residence');

            // Basic input validation example
            if (!empty($_POST['address']) && !empty($_POST['postalCode'])) {
                // Sanitizing inputs as an extra layer of security
                $residence->address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
                $residence->postalCode = filter_var($_POST['postalCode'], FILTER_SANITIZE_STRING);
                $residence->city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);
                $residence->province = filter_var($_POST['province'], FILTER_SANITIZE_STRING);
                $residence->type = filter_var($_POST['type'], FILTER_SANITIZE_STRING);
                $residence->phoneNumber = filter_var($_POST['phoneNumber'], FILTER_SANITIZE_STRING);
                $residence->bedroomNumber = filter_var($_POST['bedroomNumber'], FILTER_SANITIZE_NUMBER_INT);

                if($residence->addresidence()) {
                    header("Location: /Residence?message=Addition+Successful");
                } else {
                    header("Location: /Residence/Addresidence?error=Addition+Failed");
                }
            } else {
                header("Location: /Residence/Addresidence?error=Validation+Failed");
            }
            exit();
        }
        $this->view('Residence/Addresidence');
    }

    public function edit() {
        // Check if the form was submitted via POST with the required data
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['address']) && isset($_POST['postalCode'])) {
            // Sanitize the input for security
            $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
            $postalCode = filter_var($_POST['postalCode'], FILTER_SANITIZE_STRING);
    
            // Fetch the residence's details using the provided address and postalCode
            $residenceModel = $this->model('Residence');
            $residence = $residenceModel->getresidenceById($address, $postalCode);
    
            if ($residence) {
                // If the residence is found, pass its details to the view to pre-fill the edit form
                $this->view('Residence/Editresidence', ['residence' => $residence]);
            } else {
                // Redirect with an error if the residence cannot be found
                header('Location: /Residence?error=Residence+Not+Found');
                exit();
            }
        } else {
            // Redirect or handle the case where the necessary POST data wasn't provided
            header('Location: /Residence?error=Missing+Data');
            exit();
        }
    }   

    public function editAction() {
        if (isset($_POST['action'])) {
            $residenceModel = $this->model('Residence');
    
            // Retrieve all the form data
            $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
            $postalCode = filter_var($_POST['postalCode'], FILTER_SANITIZE_STRING);
            $city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);
            $province = filter_var($_POST['province'], FILTER_SANITIZE_STRING);
            $type = filter_var($_POST['type'], FILTER_SANITIZE_STRING);
            $phoneNumber = filter_var($_POST['phoneNumber'], FILTER_SANITIZE_STRING);
            $bedroomNumber = filter_var($_POST['bedroomNumber'], FILTER_SANITIZE_STRING);

    
            // Attempt to update the residence
            if ($residenceModel->updateresidence($address, $postalCode, $city, $province, $type, $phoneNumber, $bedroomNumber)) {
                header("Location: /Residence?message=Update+Successful");
            } else {
                header("Location: /Residence?error=Update+Failed");
            }
            exit();
        }
    }
    

public function delete()
{
    if (isset($_POST['address']) && isset($_POST['postalCode'])) {
        $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
        $postalCode = filter_var($_POST['postalCode'], FILTER_SANITIZE_STRING);

        $residence = $this->model('Residence');
        $residence->address = $address;
        $residence->postalCode = $postalCode;

        if ($residence->deleteresidence()) {
            header("Location: /Residence?message=Deletion+Successful");
        } else {
            header("Location: /Residence?error=Deletion+Failed");
        }
    } else {
        // Redirect or handle the error if address or postalCode aren't provided
        header("Location: /Residence?error=Missing+Data");
    }
    exit();
}
}

?>