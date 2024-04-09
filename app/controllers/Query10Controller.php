<?php

class query10Controller extends Controller
{
    public function index()
    {
        $query10 = $this->model('Query10');
        $queries10 = $query10->getAllQuery10();
        $this->view('Query10/Index', $queries10);
    }
}

?>