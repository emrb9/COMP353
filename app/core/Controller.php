<?php
class Controller
{
    public function model($model)
    {
        require_once 'app/models/' . $model . '.php';
        return new $model();
    }

    public function view($view, $data = [])
    {
        require_once 'app/views/' . $view . '.php';
    }

    public function notify($type, $content, $uid)
    {
        $notification = $this->model('Notification');
        $notification->type = Notification::_TYPES[$type];
        $notification->content = $content;
        $notification->uid = $uid;

        $notification->create();
    }
    public function notifyAllSeekers($type, $content)
    {
        $users = $this->model('User')->getAllSeekers();
        $notification = $this->model('Notification');
        $notification->type = Notification::_TYPES[$type];
        $notification->content = $content;

        foreach ($users as $seeker) {
            $notification->uid = $seeker->id;
            $notification->create();
        }
    }
}

?>