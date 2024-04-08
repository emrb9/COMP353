<?php

class facilityController extends Controller
{
    public function index()
    {
        $facility = $this->model('Facility');
        $facilities = $facility->getAllFacilities();
        $this->view('Facility/Index', $facilities);
    }

    public function add()
    {
        if (isset($_POST['action'])) {
            $facility = $this->model('Facility');

            // Basic input validation example
            if (!empty($_POST['name']) && !empty($_POST['address']) && !empty($_POST['postalCode'])) {
                // Sanitizing inputs as an extra layer of security
                $facility->name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
                $facility->address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
                $facility->postalCode = filter_var($_POST['postalCode'], FILTER_SANITIZE_STRING);
                $facility->city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);
                $facility->province = filter_var($_POST['province'], FILTER_SANITIZE_STRING);
                $facility->type = filter_var($_POST['type'], FILTER_SANITIZE_STRING);
                $facility->phoneNumber = filter_var($_POST['phoneNumber'], FILTER_SANITIZE_STRING);
                $facility->capacity = filter_var($_POST['capacity'], FILTER_SANITIZE_NUMBER_INT);
                $facility->webAddress = filter_var($_POST['webAddress'], FILTER_SANITIZE_URL);
                $facility->managerSSN = filter_var($_POST['managerSSN'], FILTER_SANITIZE_NUMBER_INT);

                if($facility->addfacility()) {
                    header("Location: /Facility?message=Addition+Successful");
                } else {
                    header("Location: /Facility/Addfacility?error=Addition+Failed");
                }
            } else {
                header("Location: /Facility/Addfacility?error=Validation+Failed");
            }
            exit();
        }
        $this->view('Facility/Addfacility');
    }

    public function edit() {
        // Check if the form was submitted via POST with the required data
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['address']) && isset($_POST['postalCode'])) {
            // Sanitize the input for security
            $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
            $postalCode = filter_var($_POST['postalCode'], FILTER_SANITIZE_STRING);
    
            // Fetch the facility's details using the provided address and postalCode
            $facilityModel = $this->model('Facility');
            $facility = $facilityModel->getfacilityById($address, $postalCode);
    
            if ($facility) {
                // If the facility is found, pass its details to the view to pre-fill the edit form
                $this->view('Facility/Editfacility', ['facility' => $facility]);
            } else {
                // Redirect with an error if the facility cannot be found
                header('Location: /Facility?error=Facility+Not+Found');
                exit();
            }
        } else {
            // Redirect or handle the case where the necessary POST data wasn't provided
            header('Location: /Facility?error=Missing+Data');
            exit();
        }
    }   

    public function editAction() {
        if (isset($_POST['action'])) {
            $facilityModel = $this->model('Facility');
    
            // Retrieve all the form data
            $originalAddress = filter_var($_POST['originalAddress'], FILTER_SANITIZE_STRING);
            $originalPostalCode = filter_var($_POST['originalPostalCode'], FILTER_SANITIZE_STRING);
            $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
            $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
            $postalCode = filter_var($_POST['postalCode'], FILTER_SANITIZE_STRING);
            $city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);
            $province = filter_var($_POST['province'], FILTER_SANITIZE_STRING);
            $type = filter_var($_POST['type'], FILTER_SANITIZE_STRING);
            $phoneNumber = filter_var($_POST['phoneNumber'], FILTER_SANITIZE_STRING);
            $capacity = filter_var($_POST['capacity'], FILTER_SANITIZE_STRING);
            $webAddress = filter_var($_POST['webAddress'], FILTER_SANITIZE_STRING);
            $managerSSN = filter_var($_POST['managerSSN'], FILTER_SANITIZE_STRING);
    
            // Attempt to update the facility
            if ($facilityModel->updatefacility($originalAddress, $originalPostalCode, $name, $address, $postalCode, $city, $province, $type, $phoneNumber, $capacity, $webAddress, $managerSSN)) {
                header("Location: /Facility?message=Update+Successful");
            } else {
                header("Location: /Facility?error=Update+Failed");
            }
            exit();
        }
    }
    

public function delete()
{
    if (isset($_POST['address']) && isset($_POST['postalCode'])) {
        $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
        $postalCode = filter_var($_POST['postalCode'], FILTER_SANITIZE_STRING);

        $facility = $this->model('Facility');
        $facility->address = $address;
        $facility->postalCode = $postalCode;

        if ($facility->deletefacility()) {
            header("Location: /Facility?message=Deletion+Successful");
        } else {
            header("Location: /Facility?error=Deletion+Failed");
        }
    } else {
        // Redirect or handle the error if address or postalCode aren't provided
        header("Location: /Facility?error=Missing+Data");
    }
    exit();
}
}

?>