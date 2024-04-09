<?php

class Query16 extends Model
{
    public function getAllQuery16()
    {
        try {
            $sql = "SELECT E.role,
            COUNT(DISTINCT E.SSN) AS totalEmployees,
            SUM(CASE
                    WHEN Inf.date >= CURDATE() - INTERVAL 14 DAY THEN 1
                    ELSE 0
                END)              AS totalCurrentInfections
     FROM Employees E
              LEFT JOIN WorksAt WA ON E.SSN = WA.SSN AND WA.endDate IS NULL
              LEFT JOIN Infections Inf ON E.SSN = Inf.SSN AND Inf.type = 'COVID-19'
     GROUP BY E.role
     ORDER BY E.role";

            $stmt = $this->_connection->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, "Query16");
            return $stmt->fetchAll();
        } catch (Exception $e) {
            // Log error or handle it as required
            error_log('Error fetching queries11: ' . $e->getMessage());
            return false; // Or any other error handling mechanism
        }
    }
}

?>