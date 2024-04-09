<?php

class Query17 extends Model
{
    public function getAllQuery17()
    {
        try {
            $sql = "SELECT E.role,
            COUNT(DISTINCT E.SSN)                                    AS totalCurrentlyWorking,
            COUNT(DISTINCT CASE WHEN Inf.SSN IS NULL THEN E.SSN END) AS totalNeverInfected
     FROM Employees E
              LEFT JOIN WorksAt WA ON E.SSN = WA.SSN AND WA.endDate IS NULL
              LEFT JOIN (SELECT DISTINCT SSN
                         FROM Infections
                         WHERE type = 'COVID-19') AS Inf ON E.SSN = Inf.SSN
     GROUP BY E.role
     ORDER BY E.role ASC";

            $stmt = $this->_connection->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, "Query17");
            return $stmt->fetchAll();
        } catch (Exception $e) {
            // Log error or handle it as required
            error_log('Error fetching queries11: ' . $e->getMessage());
            return false; // Or any other error handling mechanism
        }
    }
}

?>