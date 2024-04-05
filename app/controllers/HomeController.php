<?php

class HomeController extends Controller {

    /**
     * The main landing page for the homepage of the system.
     *
     * The entrypoint to the system for all public users.
     */
    public function index() {
        // if the user is signed in
        if (isset($_SESSION['user_id'])) {
            // TODO implement logged in homepage
            $datum = "";
        }
        
        $this->view('Home/Index'); // load the homepage index view
        //header("Location: /Home/Login");
        //$this->view('Home/Login');
    }

    /**
     * Enables users to register an account in the system.
     *
     * Controls the registration form loading and processing.
     */
    public function register() {
        if (isset($_POST['action']) && $_POST['u_type'] != 3 && $_POST['password'] == $_POST['password_confirm']) { // if everything is correct
            $user = $this->model('User'); // get a reference to the user object model
            $user->uname = $_POST['username']; // set the username field
            $user->u_type = $_POST['u_type']; // set the usertype field
            // hash the password and set it
            $user->password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            if ($user->insert()) { // call the method to insert the user to the DB
                header("Location: /Home/Login"); // redirect the user to the login page
            }
            else { //TODO add error message
                header("Location: /Home/Register"); // reload the registration form
            }
        }
        else 
        {
            $user = $this->model('User');
            $data = $user->getAllUserTypes();
            $this->view('Home/Register', $data); // load the registration form
        }
    }

    /**
     * Enables the functionality to delete a user based on a passed username.
     *
     * @param $uname string The username of the user to delete.
     *
     * @return bool True if the user was successfully deleted, false otherwise.
     */
    public function deleteUserByUname($uname) {
        // check that the parameter has been passed
        if (!empty($uname)) {
            $user = $this->model('User'); // get a reference to the user object model
            $user->uname = $uname; // set the username
            if (!$user->deleteByUname()) { // call the delete method to remove the user from the DB
                return true; // if successfully removed, return true
            } else { // otherwise
                return false; // return false
            }
        }
    }


    /**
     * Enables users to login to the system.
     *
     * Manages the login form view and the login behaviour.
     */
    public function login() {
        if (isset($_POST['action'])) { // if the form has been posted
            $user = $this->model('User'); // get a reference to the user object model
            // call the method to retrieve the user with the given username from the DB
            $theUser = $user->getUserByUname($_POST['username']);

            // check that the password entered matches the hashed password in the DB
            if (password_verify($_POST['password'], $theUser->password_hash)) {
                $_SESSION['user_id'] = $theUser->id; // set the session variable for the user_id
                $_SESSION['uname'] = $theUser->uname; // set the session variable for the username
                $_SESSION['u_type'] = $theUser->u_type; // set the session variable for the u_type
                header("Location: /Profile/Index"); // redirect the user to the profile index page
            }
            else { // The passwords do not match
                // TODO add error message to the user
                header("Location: /Home/Login"); // redirect the user to the login form
            }
        }
        else { // the form was not posted
            $this->view('Home/Login'); // load the login form
        }
    }


    /**
     * Enables a user to logout of the system.
     */
    public function logout() {
        unset($_SESSION['user_id']); // unset the user_id session variable
        unset($_SESSION['uname']); // unset the username session variable
        header("Location: /"); // redirect the user to the root of the website
    }
}

?>