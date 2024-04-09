<?php

class query18Controller extends Controller
{
    public function index()
    {
        $query18 = $this->model('Query18');
        $queries18 = $query18->getAllQuery18();
        $this->view('Query18/Index', $queries18);
    }
}

?>