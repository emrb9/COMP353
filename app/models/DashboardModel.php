<?php
class DashboardModel {
    protected $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Example function to get the count of employees
    public function getEmployeeCount() {
        $query = "SELECT COUNT(*) as count FROM employees";
        $result = $this->db->query($query);
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['count'];
        }
        return 0;
    }
}
