<?php
require_once "../model/DashboardModel.php";
require_once "../config/database.php"; // Assumes you have a database connection setup here

class DashboardController {
    protected $model;

    public function __construct() {
        $this->model = new DashboardModel(Database::getConnection());
    }

    public function index() {
        $employeeCount = $this->model->getEmployeeCount();
        require_once "../view/dashboard/index.php";
    }
}
