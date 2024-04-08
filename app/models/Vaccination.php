<?php

class Vaccination extends Model
{    public $SSN;
    public $doseNumber;
    public $type;
    public $date;
    public $address;
    public $postalCode;

    public function getAllVaccinations()
    {
        // prepare the SQL DML Statements
        $stmt = $this->_connection->prepare(
            "SELECT * 
               FROM Vaccinations"
        );

        $stmt->execute(); // execute the query
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Vaccination"); // set the retrieval to match an object of type Vaccination
        return $stmt->fetchAll(); // returns all the vaccination records in vaccination objects as an array, or false
    }
    
    public function addvaccination()
    {
        try {
            $stmt = $this->_connection->prepare(
                "INSERT INTO Vaccinations( SSN, doseNumber, type, date, address, postalCode) 
                VALUES (:SSN, :doseNumber, :type, :date, :address, :postalCode)"
            );

            $stmt->execute([ 
                'SSN' => $this->SSN, 
                'doseNumber' => $this->doseNumber, 
                'type' => $this->type, 
                'date' => $this->date, 
                'address' => $this->address, 
                'postalCode' => $this->postalCode,
            ]);

            return $stmt->rowCount();
        } catch (Exception $e) {
            error_log('Error adding vaccination: ' . $e->getMessage());
            return false;
        }
    }

    public function getvaccinationById($SSN, $doseNumber, $type)
    {
        try {
            $stmt = $this->_connection->prepare("SELECT * FROM Vaccinations WHERE SSN = :SSN AND doseNumber = :doseNumber AND type = :type");
            $stmt->execute(['SSN' => $SSN, 'doseNumber' => $doseNumber, 'type' => $type]);
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            error_log('Error fetching vaccination by ID: ' . $e->getMessage());
            return false;
        }
    }

    public function updatevaccination($SSN, $doseNumber, $type, $date, $address, $postalCode) {
        try {
            $stmt = $this->_connection->prepare(
                "UPDATE Vaccinations SET 
                    SSN = :SSN, 
                    doseNumber = :doseNumber, 
                    type = :type, 
                    date = :date, 
                    address = :address, 
                    postalCode = :postalCode
                WHERE SSN = :SSN AND doseNumber = :doseNumber AND type = :type"
            );
    
            $stmt->execute([
                'SSN' => $SSN,
                'doseNumber' => $doseNumber,
                'type' => $type,
                'date' => $date,
                'address' => $address,
                'postalCode' => $postalCode,
            ]);
    
            return $stmt->rowCount();
        } catch (Exception $e) {
            error_log('Error updating vaccination: ' . $e->getMessage());
            return false;
        }
    }
    
    public function deletevaccination()
    {
        $this->_connection->beginTransaction();
        
        try {

            $stmtVaccinations = $this->_connection->prepare(
                "DELETE FROM Vaccinations WHERE SSN = :SSN AND doseNumber = :doseNumber AND type = :type"
            );
            $stmtVaccinations->execute(['SSN' => $this->SSN, 'doseNumber' => $this->doseNumber, 'type' => $this->type]);

            $this->_connection->commit();
            return $stmtVaccinations->rowCount();
        } catch (Exception $e) {
            $this->_connection->rollBack();
            error_log('Error deleting vaccination: ' . $e->getMessage());
            return false;
        }
    }
}

?>