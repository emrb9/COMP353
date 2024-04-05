<?php

class SchedulingController extends Controller {

    /**
     * Main landing page for the Scheduling section of the system.
     *
     * Loads all of the profiles in the system, checks if they are connected to the current user.
     */
    public function index() {
        // user signed in
        if (isset($_SESSION['user_id'])) {
            // load the index view with the correct data
            $this->view('Scheduling/index');
        } else {
            $this->view('Home/Index');
        }
    }
}

?>
