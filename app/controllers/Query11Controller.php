<?php

class query11Controller extends Controller
{
    public function index()
    {
        $query11 = $this->model('Query11');
        $queries11 = $query11->getAllQuery11();
        $this->view('Query11/Index', $queries11);
    }
}

?>