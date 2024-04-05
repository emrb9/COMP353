<?php

class infectionController extends Controller
{

    /**
     * Main landing page for the Infection section of the system.
     *
     * Retrieves all the companies and loads them into the Index view.
     */
    public function index()
    {
        $infection = $this->model('Infection'); // get a reference to the Infection object model
        $companies = $infection->getAllCompanies(); // call the method to retrieve all the companies from the DB
        $this->view('Infection/Index', $companies); // load the infection index view with the passed data
    }

    /**
     * Allows users to add companies to the system through the Addinfection form view.
     *
     * Manages the form actions.
     */
    public function add()
    {
        if (isset($_POST['action'])) { // if the form was posted
            $infection = $this->model('Infection'); // get a reference to the Infection object model
            // set the appropriate fields
            $infection->SSN = $_POST['SSN'];
            $infection->type = $_POST['type'];
            $infection->date = $_POST['date'];
            $infection->creator_uid = $_SESSION['user_id'];

            $infection->addinfection(); // call the method to create the infection record in the DB
            header("Location: /Infection"); // redirect the user to the Infection Index page
        }
        $this->view('Infection/Addinfection'); // load the Addinfection form view
    }
    public function edit($id) {
        $infectionModel = $this->model('Infection'); // Assuming this method correctly instantiates your model
        $infection = $infectionModel->getinfectionById($id); // Fetch the infection by ID
        
        if ($infection) {
            $this->view('Infection/Editinfection', ['infection' => $infection]); // Pass the infection data to the view
        } else {
            // Handle the case where no infection was found for the given ID
            header('Location: /Infection');
            exit();
        }
    }    

    public function editAction($id)
    {
        if (isset($_POST['action'])) {
            $infection = $this->model('Infection');
            // Assign updated values from form to the infection object
            $infection->id = $id;
            $infection->SSN = $_POST['SSN'];
            $infection->type = $_POST['type'];
            $infection->date = $_POST['date'];
            // Repeat for other fields
            $infection->updateinfection(); // Update the infection
            header("Location: /Infection"); // Redirect to the infection list page
        }
    }

    /**
     * Enables the functionality to delete a infection from the system based on the passed ID.
     *
     * @param $gid int The ID of the infection to delete.
     */
    public function delete($cid)
    {
        $infection = $this->model('Infection'); // get a reference to the Infection object model
        $infection->id = $cid; // set the gid field
        $infection->creator_uid = $_SESSION['user_id']; // set the creator field
        $infection->deleteinfection(); // call the method to delete the infection record from the DB
        $this->index(); // load the index view
    }
    
    /**
     * Checks whether or not the current user is the creator of the infection with the given ID
     *
     * @param $gid int The ID of the infection to verify creator status.
     *
     * @return bool True if the current user created the infection, false otherwise.
     */
    public function amCreator($cid)
    {
        $infection = $this->model('Infection'); // get a reference to the Infection object model
        $infection->id = $cid; // set the infection ID field
        $infection->creator_uid = $_SESSION['user_id']; // set the creator field
        /* call the method to check if the DB record states that the current user is the creator.
         The output of the method call is passed to a boolean expression method to confirm that at least one record
         was returned. */
        return is_array($infection->isCreator());
    }

}

?>