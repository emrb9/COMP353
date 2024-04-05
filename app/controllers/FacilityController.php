<?php

class facilityController extends Controller
{

    /**
     * Main landing page for the Facility section of the system.
     *
     * Retrieves all the facilities and loads them into the Index view.
     */
    public function index()
    {
        $facility = $this->model('Facility'); // get a reference to the Facility object model
        $facilities = $facility->getAllFacilities(); // call the method to retrieve all the facilities from the DB
        $this->view('Facility/Index', $facilities); // load the facility index view with the passed data
    }

    /**
     * Allows users to add facilities to the system through the Addfacility form view.
     *
     * Manages the form actions.
     */
    public function add()
    {
        if (isset($_POST['action'])) { // if the form was posted
            $facility = $this->model('Facility'); // get a reference to the Facility object model
            // set the appropriate fields
            $facility->name = $_POST['name'];
            $facility->address = $_POST['address'];
            $facility->postalCode = $_POST['postalCode'];
            $facility->city = $_POST['city'];
            $facility->province = $_POST['province'];
            $facility->type = $_POST['type'];
            $facility->phoneNumber = $_POST['phoneNumber'];
            $facility->capacity = $_POST['capacity'];
            $facility->webAddress = $_POST['webAddress'];
            $facility->managerSSN = $_POST['managerSSN'];
            $facility->creator_uid = $_SESSION['user_id'];

            $facility->addfacility(); // call the method to create the facility record in the DB
            header("Location: /Facility"); // redirect the user to the Facility Index page
        }
        $this->view('Facility/Addfacility'); // load the Addfacility form view
    }
    public function edit($id) {
        $facilityModel = $this->model('Facility'); // Assuming this method correctly instantiates your model
        $facility = $facilityModel->getfacilityById($id); // Fetch the facility by ID
        
        if ($facility) {
            $this->view('Facility/Editfacility', ['facility' => $facility]); // Pass the facility data to the view
        } else {
            // Handle the case where no facility was found for the given ID
            header('Location: /Facility');
            exit();
        }
    }    

    public function editAction($id)
    {
        if (isset($_POST['action'])) {
            $facility = $this->model('Facility');
            // Assign updated values from form to the facility object
            $facility->id = $id;
            $facility->name = $_POST['name'];
            $facility->address = $_POST['address'];
            $facility->postalCode = $_POST['postalCode'];
            $facility->city = $_POST['city'];
            $facility->province = $_POST['province'];
            $facility->type = $_POST['type'];
            $facility->phoneNumber = $_POST['phoneNumber'];
            $facility->capacity = $_POST['capacity'];
            $facility->webAddress = $_POST['webAddress'];
            $facility->managerSSN = $_POST['managerSSN'];
            // Repeat for other fields
            $facility->updatefacility(); // Update the facility
            header("Location: /Facility"); // Redirect to the facility list page
        }
    }

    /**
     * Enables the functionality to delete a facility from the system based on the passed ID.
     *
     * @param $gid int The ID of the facility to delete.
     */
    public function delete($cid)
    {
        $facility = $this->model('Facility'); // get a reference to the Facility object model
        $facility->id = $cid; // set the gid field
        $facility->creator_uid = $_SESSION['user_id']; // set the creator field
        $facility->deletefacility(); // call the method to delete the facility record from the DB
        $this->index(); // load the index view
    }

    /**
     * Checks whether or not the current user is following the facility with given ID.
     *
     * @param $cid int The ID of the facility to verify membership.
     *
     * @return bool True if the current user is following the facility, false otherwise.
     */
    public function amFollowing($cid)
    {
        $facility = $this->model('Facility'); // get  a reference to the facility object model
        $facility->id = $cid; // set the facility id field
        /* call the method to check if the subscription record exists in the DB
         the output of the method call is passed to a boolean expression method to confirm that at least one record
         was returned. */
        return is_array($facility->isFollowing());
    }

    /**
     * Checks whether or not the current user is the creator of the facility with the given ID
     *
     * @param $gid int The ID of the facility to verify creator status.
     *
     * @return bool True if the current user created the facility, false otherwise.
     */
    public function amCreator($cid)
    {
        $facility = $this->model('Facility'); // get a reference to the Facility object model
        $facility->id = $cid; // set the facility ID field
        $facility->creator_uid = $_SESSION['user_id']; // set the creator field
        /* call the method to check if the DB record states that the current user is the creator.
         The output of the method call is passed to a boolean expression method to confirm that at least one record
         was returned. */
        return is_array($facility->isCreator());
    }

    /**
     * Enables the current to follow a facility with the given ID.
     *
     * @param $gid int The ID of the facility to join.
     */
    public function follow($cid)
    {
        $facility = $this->model('Facility'); // get a reference to the Facility object model
        $facility->id = $cid; // set the facility id field
        $facility->followfacility(); // call the method to join the user to the facility in the DB
        $this->index(); // load the index view
    }

    /**
     * Enables the current user to leave the facility with the given ID.
     *
     * @param $gid int The ID of the facility to leave.
     */
    public function unfollow($cid)
    {
        $facility = $this->model('Facility'); // get a reference to the Facility object model
        $facility->id = $cid; // set the facility ID field
        $facility->unfollowfacility(); // call the method to destroy the record in the DB
        $this->index(); // load the index view
    }
}

?>