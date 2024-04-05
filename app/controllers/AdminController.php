<?php

class AdminController extends Controller {

    /**
     * Main landing page for the Admin section of the system.
     *
     * Retrieves the necessary data and loads them into the Index view.
     */
    public function index() {
        $data = [];

        $user = $this->model('User');


        $data['user_list'] = $user->getAllUsers();

        $this->view('Admin/Index', $data);
    }

    /**
     * Main landing page for the Admin section of the system.
     *
     * Retrieves the necessary data and loads them into the Index view.
     */
    public function history($sid) {
        $data = [];

        $user = $this->model('User');
        $chat = $this->model('Chat');
        $chat->sid = $sid;

        $data['user_list'] = $user->getAllUsers();
        $data['chat_history'] = $chat->getAllMessagesBySenderId();

        $this->view('Admin/Index', $data);
    }
}

?>