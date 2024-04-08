<?php

class Person extends Model
{
    public $SSN;
    public $cellNumber;
    public $firstName;
    public $lastName;
    public $citizenship;
    public $dateOfBirth;
    public $emailAddress;
    public $occupation;

    public function getAllPersons()
    {
        // prepare the SQL DML Statements
        $stmt = $this->_connection->prepare(
            "SELECT * 
               FROM Persons"
        );

        $stmt->execute(); // execute the query
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Person"); // set the retrieval to match an object of type Person
        return $stmt->fetchAll(); // returns all the person records in person objects as an array, or false
    }
    
    public function addperson()
    {
        try {
            $stmt = $this->_connection->prepare(
                "INSERT INTO Persons( SSN, cellNumber, firstName, lastName, citizenship, dateOfBirth, emailAddress, occupation) 
                VALUES (:SSN, :cellNumber, :firstName, :lastName, :citizenship, :dateOfBirth, :emailAddress, :occupation)"
            );

            $stmt->execute([ 
                'SSN' => $this->SSN, 
                'cellNumber' => $this->cellNumber, 
                'firstName' => $this->firstName, 
                'lastName' => $this->lastName, 
                'citizenship' => $this->citizenship, 
                'dateOfBirth' => $this->dateOfBirth, 
                'emailAddress' => $this->emailAddress, 
                'occupation' => $this->occupation
            ]);
            return $stmt->rowCount();
        } catch (Exception $e) {
            error_log('Error adding person: ' . $e->getMessage());
            return false;
        }
    }

    public function getpersonById($SSN)
    {
        try {
            $stmt = $this->_connection->prepare("SELECT * FROM Persons WHERE SSN = :SSN");
            $stmt->execute(['SSN' => $SSN]);
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            error_log('Error fetching person by ID: ' . $e->getMessage());
            return false;
        }
    }

    public function updateperson($SSN, $cellNumber, $firstName, $lastName, $citizenship, $dateOfBirth, $emailAddress, $occupation) {
        try {
            $stmt = $this->_connection->prepare(
                "UPDATE Persons SET 
                    SSN = :SSN, 
                    cellNumber = :cellNumber, 
                    firstName = :firstName, 
                    lastName = :lastName, 
                    citizenship = :citizenship, 
                    dateOfBirth = :dateOfBirth, 
                    emailAddress = :emailAddress,
                    occupation = :occupation 
                WHERE SSN = :SSN"
            );
    
            $stmt->execute([
                'SSN' => $SSN,
                'cellNumber' => $cellNumber,
                'firstName' => $firstName,
                'lastName' => $lastName,
                'citizenship' => $citizenship,
                'dateOfBirth' => $dateOfBirth,
                'emailAddress' => $emailAddress,
                'occupation' => $occupation,
            ]);
    
            return $stmt->rowCount();
        } catch (Exception $e) {
            error_log('Error updating person: ' . $e->getMessage());
            return false;
        }
    }
    
    public function deleteperson()
    {
        $this->_connection->beginTransaction();
        
        try {
            $stmtLivesWith = $this->_connection->prepare("DELETE FROM LivesWith WHERE personSSN = :SSN ");
            $stmtLivesWith->execute(['SSN' => $this->SSN]);
            
            $stmtPrimaryResidences = $this->_connection->prepare("DELETE FROM PrimaryResidences WHERE SSN = :SSN ");
            $stmtPrimaryResidences->execute(['SSN' => $this->SSN]);
            
            $stmtVaccinations = $this->_connection->prepare("DELETE FROM Vaccinations WHERE SSN = :SSN ");
            $stmtVaccinations->execute(['SSN' => $this->SSN]);

            $stmtInfections = $this->_connection->prepare("DELETE FROM Infections WHERE SSN = :SSN ");
            $stmtInfections->execute(['SSN' => $this->SSN]);

            $stmtSecondaryResidences = $this->_connection->prepare("DELETE FROM SecondaryResidences WHERE SSN = :SSN ");
            $stmtSecondaryResidences->execute(['SSN' => $this->SSN]);

            $stmtPersons = $this->_connection->prepare("DELETE FROM Persons WHERE SSN = :SSN ");
            $stmtPersons->execute(['SSN' => $this->SSN]);

            $this->_connection->commit();
            return $stmtPersons->rowCount();
        } catch (Exception $e) {
            $this->_connection->rollBack();
            error_log('Error deleting person: ' . $e->getMessage());
            return false;
        }
    }
}

?>