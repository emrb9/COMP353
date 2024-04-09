<?php

class query15Controller extends Controller
{
    public function index()
    {
        $query15 = $this->model('Query15');
        $queries15 = $query15->getAllQuery15();
        $this->view('Query15/Index', $queries15);
    }
}

?>