
<?php

class query14Controller extends Controller
{
    public function index()
    {
        $query14 = $this->model('Query14');
        $queries14 = $query14->getAllQuery14();
        $this->view('Query14/Index', $queries14);
    }
}

?>