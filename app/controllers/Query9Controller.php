<?php

class query9Controller extends Controller
{
    public function index()
    {
        $query9 = $this->model('Query9');
        $queries9 = $query9->getAllQuery9();
        $this->view('Query9/Index', $queries9);
    }
}

?>