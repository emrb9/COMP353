<?php

class ConnectionController extends Controller {

    /**
     * Main landing page for the Connection section.
     *
     * Fetches a list of all connected profiles and passes it to the Connection/Index View.
     */
    public function index() {
        // if the user is signed in
        if (isset($_SESSION['user_id'])) {
            $connection = $this->model('Connection'); // get a reference to the Connection object model
            $data = $connection->getConnectedProfiles(); // call the method to obtain all profiles connected to me
            $this->view('Connection/index', $data); // load the index view with the passed data
        } else { // if the user is not signed in
            $this->view('Home/Index'); // load the standard homepage view
        }
    }

    /**
     * Creates a connection between the current user and the user in the passed param.
     *
     * @param $sid int the ID of the user to connect.
     */
    public function create($sid) {
        $connection = $this->model('Connection'); // get a reference to the Connection object model
        $connection->master = $sid; // set the slave field to the id of the user to connect
        $connection->slave = $_SESSION['user_id']; // set the slave field to the id of the user to connect
        $connection->create(); // call the method to create the connection in the DB
        $connection->master = $_SESSION['user_id']; // set the slave field to the id of the user to connect
        $connection->slave = $sid; // set the slave field to the id of the user to connect
        $connection->create(); // call the method to create the connection in the DB
        $this->index(); // load the index view
    }

    /**
     * Removes a connection between the current user and the user in the passed param.
     *
     * @param $sid int the ID of the user to disconnect.
     */
    public function remove($sid) {
        $connection = $this->model('Connection'); // get a reference to the Connection object model
        $connection->master = $_SESSION['user_id']; // set the slave field to the id of the user to connect
        $connection->slave = $sid; // set the slave field to the id of the user to connect
        $connection->remove(); // call the method to destroy the connection in the DB
        $connection->master = $sid; // set the slave field to the id of the user to connect
        $connection->slave = $_SESSION['user_id']; // set the slave field to the id of the user to connect
        $connection->remove(); // call the method to destroy the connection in the DB
        $this->index(); // load the index view
    }
}

?>