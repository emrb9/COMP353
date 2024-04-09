<?php

class Query18 extends Model
{
    public function getAllQuery18()
    {
        try {
            $sql = "SELECT F.province,
            COUNT(DISTINCT F.address, F.postalCode)               AS facilities,
            COUNT(DISTINCT WA.SSN)                                AS workingEmployees,
            COUNT(DISTINCT Inf.SSN, Inf.type, Inf.date)           AS workingInfected,
            SUM(DISTINCT F.capacity)                              AS totalCapacity,
            SUM(COALESCE(ABS(TIMESTAMPDIFF(HOUR, S.startTime, S.endTime)), 0)) AS totalHours
     FROM Facilities F
              LEFT JOIN WorksAt WA
                        ON F.address = WA.address
                            AND F.postalCode = WA.postalCode
                            AND WA.endDate IS NULL
              LEFT JOIN Infections Inf
                        ON Inf.SSN = WA.SSN
                            AND Inf.type = 'COVID-19'
                            AND Inf.date >= CURDATE() - INTERVAL 2 WEEK
              LEFT JOIN Schedules S
                        ON S.SSN = WA.SSN
                            AND S.startTime >= '2020-01-01'
                            AND S.endTime <= '2024-01-01'
     GROUP BY F.province";

            $stmt = $this->_connection->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, "Query18");
            return $stmt->fetchAll();
        } catch (Exception $e) {
            // Log error or handle it as required
            error_log('Error fetching queries11: ' . $e->getMessage());
            return false; // Or any other error handling mechanism
        }
    }
}

?>