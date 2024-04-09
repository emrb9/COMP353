<?php

class query16Controller extends Controller
{
    public function index()
    {
        $query16 = $this->model('Query16');
        $queries16 = $query16->getAllQuery16();
        $this->view('Query16/Index', $queries16);
    }
}

?>