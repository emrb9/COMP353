<?php

class vaccinationController extends Controller
{

    /**
     * Main landing page for the Vaccination section of the system.
     *
     * Retrieves all the companies and loads them into the Index view.
     */
    public function index()
    {
        $vaccination = $this->model('Vaccination'); // get a reference to the Vaccination object model
        $companies = $vaccination->getAllCompanies(); // call the method to retrieve all the companies from the DB
        $this->view('Vaccination/Index', $companies); // load the vaccination index view with the passed data
    }

    /**
     * Allows users to add companies to the system through the Addvaccination form view.
     *
     * Manages the form actions.
     */
    public function add()
    {
        if (isset($_POST['action'])) { // if the form was posted
            $vaccination = $this->model('Vaccination'); // get a reference to the Vaccination object model
            // set the appropriate fields
            $vaccination->SSN = $_POST['SSN'];
            $vaccination->doseNumber = $_POST['doseNumber'];
            $vaccination->type = $_POST['type'];
            $vaccination->date = $_POST['date'];
            $vaccination->address = $_POST['address'];
            $vaccination->postalCode = $_POST['postalCode'];
            $vaccination->creator_uid = $_SESSION['user_id'];

            $vaccination->addvaccination(); // call the method to create the vaccination record in the DB
            header("Location: /Vaccination"); // redirect the user to the Vaccination Index page
        }
        $this->view('Vaccination/Addvaccination'); // load the Addvaccination form view
    }
    public function edit($id) {
        $vaccinationModel = $this->model('Vaccination'); // Assuming this method correctly instantiates your model
        $vaccination = $vaccinationModel->getvaccinationById($id); // Fetch the vaccination by ID
        
        if ($vaccination) {
            $this->view('Vaccination/Editvaccination', ['vaccination' => $vaccination]); // Pass the vaccination data to the view
        } else {
            // Handle the case where no vaccination was found for the given ID
            header('Location: /Vaccination');
            exit();
        }
    }    

    public function editAction($id)
    {
        if (isset($_POST['action'])) {
            $vaccination = $this->model('Vaccination');
            // Assign updated values from form to the vaccination object
            $vaccination->id = $id;
            $vaccination->SSN = $_POST['SSN'];
            $vaccination->doseNumber = $_POST['doseNumber'];
            $vaccination->type = $_POST['type'];
            $vaccination->date = $_POST['date'];
            $vaccination->address = $_POST['address'];
            $vaccination->postalCode = $_POST['postalCode'];
            // Repeat for other fields
            $vaccination->updatevaccination(); // Update the vaccination
            header("Location: /Vaccination"); // Redirect to the vaccination list page
        }
    }

    /**
     * Enables the functionality to delete a vaccination from the system based on the passed ID.
     *
     * @param $gid int The ID of the vaccination to delete.
     */
    public function delete($cid)
    {
        $vaccination = $this->model('Vaccination'); // get a reference to the Vaccination object model
        $vaccination->id = $cid; // set the gid field
        $vaccination->creator_uid = $_SESSION['user_id']; // set the creator field
        $vaccination->deletevaccination(); // call the method to delete the vaccination record from the DB
        $this->index(); // load the index view
    }
    
    /**
     * Checks whether or not the current user is the creator of the vaccination with the given ID
     *
     * @param $gid int The ID of the vaccination to verify creator status.
     *
     * @return bool True if the current user created the vaccination, false otherwise.
     */
    public function amCreator($cid)
    {
        $vaccination = $this->model('Vaccination'); // get a reference to the Vaccination object model
        $vaccination->id = $cid; // set the vaccination ID field
        $vaccination->creator_uid = $_SESSION['user_id']; // set the creator field
        /* call the method to check if the DB record states that the current user is the creator.
         The output of the method call is passed to a boolean expression method to confirm that at least one record
         was returned. */
        return is_array($vaccination->isCreator());
    }

}

?>