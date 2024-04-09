<?php

class Query9 extends Model
{
    public function getAllQuery9()
    {
        try {
            $sql = "SELECT 
            p.firstName,
            p.lastName,
            MIN(w.startDate) AS workStartDate, 
            p.dateOfBirth,
            e.medicareNumber,
            p.cellNumber AS telephoneNumber,
            pr.address AS primaryAddress,
            r.city, 
            r.province,
            pr.postalCode AS primaryPostalCode,
            p.citizenship,
            p.emailAddress,
            COUNT(sr.SSN) AS numSecondaryResidences
        FROM 
            WorksAt w
        INNER JOIN 
            Employees e ON w.SSN = e.SSN
        INNER JOIN 
            Persons p ON w.SSN = p.SSN
        INNER JOIN 
            PrimaryResidences pr ON p.SSN = pr.SSN
        INNER JOIN 
            Residences r ON pr.address = r.address AND pr.postalCode = r.postalCode 
        LEFT JOIN 
            SecondaryResidences sr ON w.SSN = sr.SSN
        WHERE 
            w.address = '56 Oak Grove Way' -- Query9 address, from works_at
        GROUP BY 
            p.SSN, p.firstName, p.lastName, pr.address, r.city, r.province, pr.postalCode, p.dateOfBirth, e.medicareNumber, p.cellNumber, p.citizenship, p.emailAddress
        HAVING 
            numSecondaryResidences >= 1
        ORDER BY 
            MIN(w.startDate) DESC, p.firstName, p.lastName";

            $stmt = $this->_connection->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, "Query9");
            return $stmt->fetchAll();
        } catch (Exception $e) {
            // Log error or handle it as required
            error_log('Error fetching queries9: ' . $e->getMessage());
            return false; // Or any other error handling mechanism
        }
    }
}

?>