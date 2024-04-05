<?php

class personController extends Controller
{

    /**
     * Main landing page for the Person section of the system.
     *
     * Retrieves all the companies and loads them into the Index view.
     */
    public function index()
    {
        $person = $this->model('Person'); // get a reference to the Person object model
        $companies = $person->getAllCompanies(); // call the method to retrieve all the companies from the DB
        $this->view('Person/Index', $companies); // load the person index view with the passed data
    }

    /**
     * Allows users to add companies to the system through the Addperson form view.
     *
     * Manages the form actions.
     */
    public function add()
    {
        if (isset($_POST['action'])) { // if the form was posted
            $person = $this->model('Person'); // get a reference to the Person object model
            // set the appropriate fields
            $person->SSN = $_POST['SSN'];
            $person->firstName = $_POST['firstName'];
            $person->lastName = $_POST['lastName'];
            $person->citizenship = $_POST['citizenship'];
            $person->dateOfBirth = $_POST['dateOfBirth'];
            $person->emailAddress = $_POST['emailAddress'];
            $person->occupation = $_POST['occupation'];
            $person->creator_uid = $_SESSION['user_id'];

            $person->addperson(); // call the method to create the person record in the DB
            header("Location: /Person"); // redirect the user to the Person Index page
        }
        $this->view('Person/Addperson'); // load the Addperson form view
    }
    public function edit($id) {
        $personModel = $this->model('Person'); // Assuming this method correctly instantiates your model
        $person = $personModel->getpersonById($id); // Fetch the person by ID
        
        if ($person) {
            $this->view('Person/Editperson', ['person' => $person]); // Pass the person data to the view
        } else {
            // Handle the case where no person was found for the given ID
            header('Location: /Person');
            exit();
        }
    }    

    public function editAction($id)
    {
        if (isset($_POST['action'])) {
            $person = $this->model('Person');
            // Assign updated values from form to the person object
            $person->id = $id;
            $person->SSN = $_POST['SSN'];
            $person->firstName = $_POST['firstName'];
            $person->lastName = $_POST['lastName'];
            $person->citizenship = $_POST['citizenship'];
            $person->dateOfBirth = $_POST['dateOfBirth'];
            $person->emailAddress = $_POST['emailAddress'];
            $person->occupation = $_POST['occupation'];
            // Repeat for other fields
            $person->updateperson(); // Update the person
            header("Location: /Person"); // Redirect to the person list page
        }
    }

    /**
     * Enables the functionality to delete a person from the system based on the passed ID.
     *
     * @param $gid int The ID of the person to delete.
     */
    public function delete($cid)
    {
        $person = $this->model('Person'); // get a reference to the Person object model
        $person->id = $cid; // set the gid field
        $person->creator_uid = $_SESSION['user_id']; // set the creator field
        $person->deleteperson(); // call the method to delete the person record from the DB
        $this->index(); // load the index view
    }
    
    /**
     * Checks whether or not the current user is the creator of the person with the given ID
     *
     * @param $gid int The ID of the person to verify creator status.
     *
     * @return bool True if the current user created the person, false otherwise.
     */
    public function amCreator($cid)
    {
        $person = $this->model('Person'); // get a reference to the Person object model
        $person->id = $cid; // set the person ID field
        $person->creator_uid = $_SESSION['user_id']; // set the creator field
        /* call the method to check if the DB record states that the current user is the creator.
         The output of the method call is passed to a boolean expression method to confirm that at least one record
         was returned. */
        return is_array($person->isCreator());
    }

}

?>