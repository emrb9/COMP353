<?php

class Vaccination extends Model
{
    public $id;
    public $SSN;
    public $doseNumber;
    public $type;
    public $date;
    public $address;
    public $postalCode;
    public $creator_uid;

    /**
     * Retrieves all the vaccination records from the DB.
     * 
     * @return array|false Array containing all the vaccinations, or false if there are no vaccinations.
     */
    public function getAllCompanies()
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

    /**
     * Adds a vaccination to the DB based on the current object status.
     *
     * @return int Number of affected rows. Expected to be 1.
     */
    public function addvaccination()
    {
        // prepare the SQL DML Statements
        $stmt = $this->_connection->prepare(
            "INSERT INTO Vaccinations( SSN, doseNumber, type, date, address, postalCode, creator_uid) 
                  VALUES (:SSN, :doseNumber, :type, :date, :address, :postalCode, :creator_uid)"
        );

        // supply the replacement parameters to the query
        $stmt->execute(['SSN' => $this->SSN, 'doseNumber' => $this->doseNumber, 'type' => $this->type, 'date' => $this->date, 'address' => $this->address, 'postalCode' => $this->postalCode,'creator_uid' => $this->creator_uid]);
        return $stmt->rowCount(); // return the number of affected rows (should be 1)
    }
    public function getvaccinationById($id)
    {
        $stmt = $this->_connection->prepare("SELECT * FROM Vaccinations WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_OBJ); // Fetches the vaccination
    }

    public function updatevaccination()
    {
        $stmt = $this->_connection->prepare(
            "UPDATE Vaccinations SET SSN=:SSN, doseNumber=:doseNumber, type=:type, date=:date, address=:address, postalCode=:postalCode WHERE id=:id"
        );
        $stmt->execute([
            'SSN' => $this->SSN,
            'doseNumber' => $this->doseNumber,
            'type' => $this->type,
            'date' => $this->date,
            'address' => $this->address,
            'postalCode' => $this->postalCode,
            'id' => $this->id,
        ]);
        return $stmt->rowCount();
    }

    /**
     * Deletes a vaccination from the DB based on the current object status.
     *
     * @return int Number of affected rows. Expected to be 1.
     */
    public function deletevaccination()
    {
        // prepare the SQL DML Statements
        $stmt = $this->_connection->prepare(
            "DELETE FROM Vaccinations WHERE id = :id AND creator_uid = :creator_uid"
        );

        // supply the replacement parameters to the query
        $stmt->execute(['id' => $this->id, 'creator_uid' => $this->creator_uid]);
        return $stmt->rowCount(); // return the number of affected rows (should be 1)
    }

    /**
     * Checks whether or not the vaccination matching the current object status was created by the current user.
     *
     * @return int|mixed If the current user created the vaccination, return the vaccination. Otherwise, return 0.
     */
    public function isCreator()
    {
        // prepare the SQL DML Statements
        $stmt = $this->_connection->prepare(
            "SELECT *
            FROM Vaccinations
            WHERE id = :id AND creator_uid = :creator_uid"
        );

        try {
            // supply the replacement parameters to the query
            $stmt->execute(['id' => $this->id, 'creator_uid' => $this->creator_uid]);
            return $stmt->fetch(); // returns the vaccination record if it exists, false otherwise
        } catch (Exception $e) {
            return 0;
        }
    }

}

?>