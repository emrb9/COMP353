<?php

class residenceController extends Controller
{

    /**
     * Main landing page for the Residence section of the system.
     *
     * Retrieves all the companies and loads them into the Index view.
     */
    public function index()
    {
        $residence = $this->model('Residence'); // get a reference to the Residence object model
        $companies = $residence->getAllCompanies(); // call the method to retrieve all the companies from the DB
        $this->view('Residence/Index', $companies); // load the residence index view with the passed data
    }

    /**
     * Allows users to add companies to the system through the Addresidence form view.
     *
     * Manages the form actions.
     */
    public function add()
    {
        if (isset($_POST['action'])) { // if the form was posted
            $residence = $this->model('Residence'); // get a reference to the Residence object model
            // set the appropriate fields
            $residence->address = $_POST['address'];
            $residence->postalCode = $_POST['postalCode'];
            $residence->city = $_POST['city'];
            $residence->province = $_POST['province'];
            $residence->type = $_POST['type'];
            $residence->phoneNumber = $_POST['phoneNumber'];
            $residence->bedroomNumber = $_POST['bedroomNumber'];
            $residence->creator_uid = $_SESSION['user_id'];

            $residence->addresidence(); // call the method to create the residence record in the DB
            header("Location: /Residence"); // redirect the user to the Residence Index page
        }
        $this->view('Residence/Addresidence'); // load the Addresidence form view
    }
    public function edit($id) {
        $residenceModel = $this->model('Residence'); // Assuming this method correctly instantiates your model
        $residence = $residenceModel->getresidenceById($id); // Fetch the residence by ID
        
        if ($residence) {
            $this->view('Residence/Editresidence', ['residence' => $residence]); // Pass the residence data to the view
        } else {
            // Handle the case where no residence was found for the given ID
            header('Location: /Residence');
            exit();
        }
    }    

    public function editAction($id)
    {
        if (isset($_POST['action'])) {
            $residence = $this->model('Residence');
            // Assign updated values from form to the residence object
            $residence->id = $id;
            $residence->address = $_POST['address'];
            $residence->postalCode = $_POST['postalCode'];
            $residence->city = $_POST['city'];
            $residence->province = $_POST['province'];
            $residence->type = $_POST['type'];
            $residence->phoneNumber = $_POST['phoneNumber'];
            $residence->bedroomNumber = $_POST['bedroomNumber'];
            // Repeat for other fields
            $residence->updateresidence(); // Update the residence
            header("Location: /Residence"); // Redirect to the residence list page
        }
    }

    /**
     * Enables the functionality to delete a residence from the system based on the passed ID.
     *
     * @param $gid int The ID of the residence to delete.
     */
    public function delete($cid)
    {
        $residence = $this->model('Residence'); // get a reference to the Residence object model
        $residence->id = $cid; // set the gid field
        $residence->creator_uid = $_SESSION['user_id']; // set the creator field
        $residence->deleteresidence(); // call the method to delete the residence record from the DB
        $this->index(); // load the index view
    }
    
    /**
     * Checks whether or not the current user is the creator of the residence with the given ID
     *
     * @param $gid int The ID of the residence to verify creator status.
     *
     * @return bool True if the current user created the residence, false otherwise.
     */
    public function amCreator($cid)
    {
        $residence = $this->model('Residence'); // get a reference to the Residence object model
        $residence->id = $cid; // set the residence ID field
        $residence->creator_uid = $_SESSION['user_id']; // set the creator field
        /* call the method to check if the DB record states that the current user is the creator.
         The output of the method call is passed to a boolean expression method to confirm that at least one record
         was returned. */
        return is_array($residence->isCreator());
    }

}

?>