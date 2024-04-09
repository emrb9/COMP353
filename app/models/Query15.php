<?php

class Query15 extends Model
{
    public function getAllQuery15()
    {
        try {
            $sql = "SELECT P.firstName,
            P.lastName,
            MIN(WA.startDate)                                     AS firstDayOfWork,
            P.dateOfBirth,
            P.emailAddress,
            (SELECT COUNT(*)
             FROM Infections I
             WHERE I.SSN = E.SSN
               AND I.type = 'COVID-19')                           AS totalCovidInfections,
            COUNT(DISTINCT Vac.type, Vac.doseNumber)              AS totalVaccines,
            SUM(ABS(TIMESTAMPDIFF(HOUR, S.startTime, S.endTime))) AS totalHoursScheduled,
            COUNT(DISTINCT SR.address)                            AS totalSecondaryResidences
     FROM Employees E
              JOIN Persons P
                   ON E.SSN = P.SSN
              JOIN WorksAt WA
                   ON E.SSN = WA.SSN
                       AND WA.endDate IS NULL
              JOIN Schedules S
                   ON E.SSN = S.SSN
              JOIN Infections Inf
                   ON E.SSN = Inf.SSN
                       AND Inf.type = 'COVID-19'
                       AND Inf.date >= CURDATE() - INTERVAL 2 WEEK
              LEFT JOIN Vaccinations Vac ON E.SSN = Vac.SSN
              LEFT JOIN SecondaryResidences SR ON E.SSN = SR.SSN
     WHERE E.role = 'nurse'
     GROUP BY P.SSN, P.firstName, P.lastName
     HAVING COUNT(DISTINCT WA.address, WA.postalCode) >= 2
     ORDER BY firstDayOfWork, P.firstName, P.lastName";

            $stmt = $this->_connection->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, "Query15");
            return $stmt->fetchAll();
        } catch (Exception $e) {
            // Log error or handle it as required
            error_log('Error fetching queries11: ' . $e->getMessage());
            return false; // Or any other error handling mechanism
        }
    }
}

?>