<?php

class Query12 extends Model
{
    public function getAllQuery12()
    {
        try {
            $sql = "SELECT P.firstName,
            P.lastName,
            I.date AS infectionDate,
            F.name AS facilityName,
            COUNT(SR.SSN) AS numberOfSecondaryResidences
     FROM Infections I
     JOIN Employees E ON I.SSN = E.SSN AND E.role = 'Doctor'
     JOIN Persons P ON E.SSN = P.SSN
     JOIN WorksAt WA ON E.SSN = WA.SSN AND WA.endDate IS NULL
     JOIN Facilities F ON WA.address = F.address AND WA.postalCode = F.postalCode
     LEFT JOIN SecondaryResidences SR ON E.SSN = SR.SSN
     WHERE I.type = 'COVID-19'
     AND I.date >= CURDATE() - INTERVAL 14 DAY
     GROUP BY P.SSN, P.firstName, P.lastName, I.date, F.name
     ORDER BY F.name ASC, COUNT(SR.SSN) ASC";

            $stmt = $this->_connection->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, "Query12");
            return $stmt->fetchAll();
        } catch (Exception $e) {
            // Log error or handle it as required
            error_log('Error fetching queries11: ' . $e->getMessage());
            return false; // Or any other error handling mechanism
        }
    }
}

?>