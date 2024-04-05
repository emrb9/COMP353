<?php

class NotificationController extends Controller {

    /**
     * Main landing page for the Notifications section of the system.
     *
     * Loads the notification view.
     */
    public function index() {
        if(isset($_SESSION['user_id'])) { // if the user is signed in
            $data = [];
            $invitation = $this->model('Invitation');
            $notification = $this->model('Notification');
            $notification->uid = $_SESSION['user_id'];
            $data['connection'] = $invitation->getAllInvitedProfiles();
            $data['messages'] = $notification->getAllTypeNotificationsForUserID('MESSAGE');
            $data['jobs'] = $notification->getAllTypeNotificationsForUserID('JOB');
            $this->view('Notification/index', $data); // load the notifications view
        } else { // otherwise
            $this->view('Home/index'); // load the homepage view
        }
    }

    public function clearAllChatMessages() {
        $notification = $this->model('Notification');
        $notification->uid = $_SESSION['user_id'];
        $notification->destroyAllTypeNotificationsForUserID('MESSAGE');
        header("Location: /Notification/");
    }
    public function clearAllJobMessages() {
        $notification = $this->model('Notification');
        $notification->uid = $_SESSION['user_id'];
        $notification->destroyAllTypeNotificationsForUserID('JOB');
        header("Location: /Notification/");
    }
}

?>
