<?php

class query12Controller extends Controller
{
    public function index()
    {
        $query12 = $this->model('Query12');
        $queries12 = $query12->getAllQuery12();
        $this->view('Query12/Index', $queries12);
    }
}

?>