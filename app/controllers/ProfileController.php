<?php

class ProfileController extends Controller {

    /**
     * Main landing page for the Profile section of the system.
     *
     * Loads up the current user's profile and passes it to the profile index page.
     *
     * If the user does not have a profile, the system will load the profile creation view.
     */
    public function index() {
        // user signed in
        if (isset($_SESSION['user_id'])) {
            $profile = $this->model('Profile'); // get a reference to the profile object model
            $profile->id = $_SESSION['user_id']; // set the profile ID field
            $data = $profile->getProfile(); // call the method to load the profile from the DB
            if ($data == false) {// if the user does not have a profile
                header("Location: /Profile/Create/"); // redirect the user to the profile creation page
            }
            else {// the user has a profile
                $this->view('Profile/index', $data); // load the profile view with the correct data
            }
        } else { // the user is not signed in
            $this->view('Home/Index'); // load the homepage view
        }
    }

    /**
     * Enables a user to edit their profile.
     *
     * Manages the profile edit form and behaviour.
     */
    public function edit() {
        if(isset($_POST['action'])) { // if the form has been posted
            $profile = $this->model('Profile'); // get a reference to the profile object model

            // Set the appropriate fields
            $profile->id = $_SESSION['user_id'];
            $profile->fname = $_POST['fname'];
            $profile->lname = $_POST['lname'];
            $profile->email = $_POST['email'];
            $profile->job_title = $_POST['job'];
            $profile->skills = $_POST['skills'];
            $profile->about = $_POST['about'];
            $profile->location = $_POST['location'];

            // call the method to update the record in the DB
            $profile->edit();

            // redirect the user to the profile index page
            header("Location: /Profile");
        }
        $this->view('Profile/Edit'); // load the edit profile form
    }

    /**
     * Enables a user to create their profile.
     *
     * Manages the profile creation form and behaviour.
     */
    public function create() {
        if(isset($_POST['action'])) { // if the form has been posted
            $profile = $this->model('Profile'); // get a reference to the profile object model

            // set the appropriate fields
            $profile->id = $_SESSION['user_id'];
            $profile->fname = $_POST['fname'];
            $profile->lname = $_POST['lname'];
            $profile->email = $_POST['email'];
            $profile->job_title = $_POST['job'];
            $profile->location = $_POST['location'];
            $profile->skills = $_POST['skills'];
            $profile->about = $_POST['about'];

            // call the method to create the profile in the DB
            $profile->create();

            // redirect the user to the profile index page
            header("Location: /Profile");
        }
        $this->view('Profile/Edit'); // load the profile edit form
    }

    /**
     * Enables the user to toggle the visibility of their profile to public or private
     *
     * @param $val int Parameter to determine the toggle direction. Should be 0 or 1.
     */
    public function updateVisibility($val) {
        if ($val == 0 || $val == 1) { // if the param is 0 or 1
            $profile = $this->model('Profile'); // get a reference to the profile object model
            $profile->id = $_SESSION['user_id']; // set the profile id field
            $profile->public = $val; // set the visibility status
            $profile->updateVisibility(); // call the method to update the visibility status in the DB
        }
        header("Location: /Profile"); // redirect the user to the profile page
    }
}

?>
