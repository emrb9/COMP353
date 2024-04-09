<?php

class Query14 extends Model
{
    public function getAllQuery14()
    {
        try {
            $sql = "SELECT P.SSN,
            P.firstName,
            P.lastName,
            E.role,
            COUNT(SR.SSN) AS numberOfSecondaryResidences
     FROM Employees E
              JOIN Persons P ON E.SSN = P.SSN
              JOIN WorksAt WA ON E.SSN = WA.SSN AND WA.endDate IS NULL
              JOIN Facilities F ON WA.address = F.address AND WA.postalCode = F.postalCode
              JOIN Schedules S ON E.SSN = S.SSN
              JOIN SecondaryResidences SR ON E.SSN = SR.SSN
     WHERE F.name = 'CLSC Deevy'
       AND S.date >= CURDATE() - INTERVAL 4 WEEK
     GROUP BY E.SSN, E.role
     HAVING COUNT(SR.SSN) >= 3
     ORDER BY E.role, COUNT(SR.SSN)";

            $stmt = $this->_connection->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, "Query14");
            return $stmt->fetchAll();
        } catch (Exception $e) {
            // Log error or handle it as required
            error_log('Error fetching queries11: ' . $e->getMessage());
            return false; // Or any other error handling mechanism
        }
    }
}

?>