<?php

class Query11 extends Model
{
    public function getAllQuery11()
    {
        try {
            $sql = "SELECT R.address,
            R.postalCode,
            R.type,
            P.firstName,
            P.lastName,
            P.occupation,
            LW.relationship
     FROM Employees E
     JOIN PrimaryResidences PR ON E.SSN = PR.SSN
     JOIN Residences R ON PR.address = R.address AND PR.postalCode = R.postalCode
     JOIN LivesWith LW ON E.SSN = LW.employeeSSN
     JOIN Persons P ON LW.personSSN = P.SSN
     WHERE E.SSN = 127185305
     
     ORDER BY
         address";

            $stmt = $this->_connection->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, "Query11");
            return $stmt->fetchAll();
        } catch (Exception $e) {
            // Log error or handle it as required
            error_log('Error fetching queries11: ' . $e->getMessage());
            return false; // Or any other error handling mechanism
        }
    }
}

?>