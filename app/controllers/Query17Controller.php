<?php

class query17Controller extends Controller
{
    public function index()
    {
        $query17 = $this->model('Query17');
        $queries17 = $query17->getAllQuery17();
        $this->view('Query17/Index', $queries17);
    }
}

?>