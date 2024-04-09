<?php

class Query10 extends Model
{
    public function getAllQuery10()
    {
        try {
            $sql = "SELECT 
            p.SSN AS employeeSSN,
            CONCAT(p.firstName, ' ', p.lastName) AS employeeFullName,
            f.name AS facilityName,
            DAYOFYEAR(s.date) AS dayOfYear,
            s.startTime,
            s.endTime
        FROM 
            Schedules s
        JOIN 
            Facilities f ON s.address = f.address AND s.postalCode = f.postalCode
        JOIN 
            Employees e ON s.SSN = e.SSN
        JOIN 
            Persons p ON e.SSN = p.SSN
        WHERE 
            s.SSN = 456024090 AND
            s.date >= '2016-04-01' AND
            s.date <= '2023-04-30'
        ORDER BY 
            f.name,
            dayOfYear,
            s.startTime";

            $stmt = $this->_connection->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, "Query10");
            return $stmt->fetchAll();
        } catch (Exception $e) {
            // Log error or handle it as required
            error_log('Error fetching queries10: ' . $e->getMessage());
            return false; // Or any other error handling mechanism
        }
    }
}

?>