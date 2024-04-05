<?php

class Connection extends Model
{
    public $master; // me
    public $slave; // users connected to me

    /**
     * Fetches all the profiles from the DB. For profiles who are connected to the current user,
     * the system adds a boolean field to the appropriate profile element.
     *
     * @return array Array of all the profiles in the system, including connection status to the current user.
     */
    public function getAllEmployeeDetails()
    {
        // Fetch employee details - adjust on actual DB structure
        $stmt = $this->_connection->prepare("
            SELECT e.SSN, p.firstName, p.lastName, e.role, v.type AS vaccinationType, v.doseNumber, v.date AS vaccinationDate
            FROM Employees e
            JOIN Persons p ON e.SSN = p.SSN
            LEFT JOIN Vaccinations v ON e.SSN = v.SSN
            ORDER BY p.lastName, p.firstName, v.date DESC
        ");

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ); // Fetching as objects for easier access in PHP
    }
    /* -------------------- TO DO: PROPERLY INTEGRATE addEmployee -------------------- */
    public function addEmployee($data)
    {
        $this->_connection->beginTransaction();
        try {
            // Insert into Persons table
            $stmt1 = $this->_connection->prepare("
                INSERT INTO Persons (SSN, firstName, lastName, cellNumber, citizenship, dateOfBirth, emailAddress, occupation)
                VALUES (:SSN, :firstName, :lastName, :cellNumber, :citizenship, :dateOfBirth, :emailAddress, :occupation);
            ");

            $stmt1->execute([
                ':SSN' => $data['SSN'],
                ':firstName' => $data['firstName'],
                ':lastName' => $data['lastName'],
                ':cellNumber' => $data['cellNumber'],
                ':citizenship' => $data['citizenship'],
                ':dateOfBirth' => $data['dateOfBirth'],
                ':emailAddress' => $data['emailAddress'],
                ':occupation' => $data['occupation'],
            ]);

            // Insert into Employees table
            $stmt2 = $this->_connection->prepare("
                INSERT INTO Employees (SSN, medicareNumber, role)
                VALUES (:SSN, :medicareNumber, :role);
            ");

            $stmt2->execute([
                ':SSN' => $data['SSN'],
                ':medicareNumber' => $data['medicareNumber'],
                ':role' => $data['role'],
            ]);

            // Handling Vaccinations data
            if (!empty($data['vaccinationType']) && !empty($data['doseNumber']) && !empty($data['vaccinationDate'])) {
                $stmt3 = $this->_connection->prepare("
                    INSERT INTO Vaccinations (SSN, doseNumber, type, date, address, postalCode)
                    VALUES (:SSN, :doseNumber, :type, :date, :address, :postalCode);
                ");

                $stmt3->execute([
                    ':SSN' => $data['SSN'],
                    ':doseNumber' => $data['doseNumber'],
                    ':type' => $data['vaccinationType'],
                    ':date' => $data['vaccinationDate'],
                    ':address' => $data['vaccinationAddress'], // Ensure this is provided or has a default
                    ':postalCode' => $data['vaccinationPostalCode'], // Ensure this is provided or has a default
                ]);
            }

            $this->_connection->commit();
        } catch (Exception $e) {
            $this->_connection->rollback();
            throw $e;
        }
    }
    /* -------------------- TO DO: PROPERLY INTEGRATE updateEmployee -------------------- */
    public function updateEmployee($SSN, $data)
    {
        $this->_connection->beginTransaction();
        try {
            // Update Persons table
            $stmt1 = $this->_connection->prepare("
            UPDATE Persons 
            SET firstName = :firstName, lastName = :lastName, cellNumber = :cellNumber, citizenship = :citizenship, 
                dateOfBirth = :dateOfBirth, emailAddress = :emailAddress, occupation = :occupation
            WHERE SSN = :SSN;
        ");

            $stmt1->execute([
                ':SSN' => $SSN,
                ':firstName' => $data['firstName'],
                ':lastName' => $data['lastName'],
                ':cellNumber' => $data['cellNumber'],
                ':citizenship' => $data['citizenship'],
                ':dateOfBirth' => $data['dateOfBirth'],
                ':emailAddress' => $data['emailAddress'],
                ':occupation' => $data['occupation'],
            ]);

            // Update Employees table
            $stmt2 = $this->_connection->prepare("
            UPDATE Employees 
            SET medicareNumber = :medicareNumber, role = :role
            WHERE SSN = :SSN;
        ");

            $stmt2->execute([
                ':SSN' => $SSN,
                ':medicareNumber' => $data['medicareNumber'],
                ':role' => $data['role'],
            ]);

            // Update Vaccinations data
            if (!empty($data['vaccinationType']) && !empty($data['doseNumber']) && !empty($data['vaccinationDate'])) {
                $stmt3 = $this->_connection->prepare("
                INSERT INTO Vaccinations (SSN, doseNumber, type, date, address, postalCode)
                VALUES (:SSN, :doseNumber, :type, :date, :address, :postalCode)
                ON DUPLICATE KEY UPDATE 
                type = :type, date = :date, address = :address, postalCode = :postalCode;
            ");

                $stmt3->execute([
                    ':SSN' => $SSN,
                    ':doseNumber' => $data['doseNumber'],
                    ':type' => $data['vaccinationType'],
                    ':date' => $data['vaccinationDate'],
                    ':address' => $data['vaccinationAddress'], 
                    ':postalCode' => $data['vaccinationPostalCode'], 
                ]);
            }

            $this->_connection->commit();
        } catch (Exception $e) {
            $this->_connection->rollback();
            throw $e;
        }
    }

    public function deleteEmployee($SSN)
    {
        // Assuming cascading deletes are not set up in the database schema,
        // you would need to manually delete related records in a transaction.
        $this->_connection->beginTransaction();
        try {
            $stmt1 = $this->_connection->prepare("DELETE FROM Vaccinations WHERE SSN = :SSN");
            $stmt1->execute([':SSN' => $SSN]);

            $stmt2 = $this->_connection->prepare("DELETE FROM Employees WHERE SSN = :SSN");
            $stmt2->execute([':SSN' => $SSN]);

            $stmt3 = $this->_connection->prepare("DELETE FROM Persons WHERE SSN = :SSN");
            $stmt3->execute([':SSN' => $SSN]);

            $this->_connection->commit();
            return true; // Indicate success
        } catch (Exception $e) {
            $this->_connection->rollback();
            error_log("Deletion failed: " . $e->getMessage()); // Log detailed error
            return false; // Indicate failure
        }
    }
}

?>