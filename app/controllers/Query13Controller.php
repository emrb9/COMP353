
<?php

class query13Controller extends Controller
{
    public function index()
    {
        $query13 = $this->model('Query13');
        $queries13 = $query13->getAllQuery13();
        $this->view('Query13/Index', $queries13);
    }
}

?>