<?php

class SettingController extends Controller {

    /**
     * Main landing page for the settings section of the system.
     */
    public function index() {

        if (isset($_SESSION['user_id'])) {
            // user signed in
            $this->view('Setting/index'); // load the settings index view
        } else {
            $this->view('Home/Index'); // load the homepage view
        }
    }
}

?>
