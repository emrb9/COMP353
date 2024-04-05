<?php

class Person extends Model
{
    public $id;
    public $SSN;
    public $cellNumber;
    public $firstName;
    public $lastName;
    public $citizenship;
    public $dateOfBirth;
    public $emailAddress;
    public $occupation;
    public $creator_uid;

    /**
     * Retrieves all the person records from the DB.
     * 
     * @return array|false Array containing all the persons, or false if there are no persons.
     */
    public function getAllCompanies()
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

    /**
     * Adds a person to the DB based on the current object status.
     *
     * @return int Number of affected rows. Expected to be 1.
     */
    public function addperson()
    {
        // prepare the SQL DML Statements
        $stmt = $this->_connection->prepare(
            "INSERT INTO Persons( SSN, cellNumber, firstName, lastName, citizenship, dateOfBirth, emailAddress, occupation, creator_uid) 
                  VALUES (:SSN, :cellNumber, :firstName, :lastName, :citizenship, :dateOfBirth, :emailAddress, :occupation, :creator_uid)"
        );

        // supply the replacement parameters to the query
        $stmt->execute(['SSN' => $this->SSN, 'cellNumber' => $this->cellNumber, 'firstName' => $this->firstName, 'lastName' => $this->lastName, 'citizenship' => $this->citizenship, 'dateOfBirth' => $this->dateOfBirth, 'emailAddress' => $this->emailAddress,'occupation' => $this->occupation,'creator_uid' => $this->creator_uid]);
        return $stmt->rowCount(); // return the number of affected rows (should be 1)
    }
    public function getpersonById($id)
    {
        $stmt = $this->_connection->prepare("SELECT * FROM Persons WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_OBJ); // Fetches the person
    }

    public function updateperson()
    {
        $stmt = $this->_connection->prepare(
            "UPDATE Persons SET SSN=:SSN, cellNumber=:cellNumber, firstName=:firstName,lastName=:lastName, citizenship=:citizenship, dateOfBirth=:dateOfBirth, emailAddress=:emailAddress, occupation=:occupation WHERE id=:id"
        );
        $stmt->execute([
            'SSN' => $this->SSN,
            'cellNumber' => $this->cellNumber,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'citizenship' => $this->citizenship,
            'dateOfBirth' => $this->dateOfBirth,
            'emailAddress' => $this->emailAddress,
            'occupation' => $this->occupation,
            'id' => $this->id
        ]);
        return $stmt->rowCount();
    }

    

    /**
     * Deletes a person from the DB based on the current object status.
     *
     * @return int Number of affected rows. Expected to be 1.
     */
    public function deleteperson()
    {
        // prepare the SQL DML Statements
        $stmt = $this->_connection->prepare(
            "DELETE FROM Persons WHERE id = :id AND creator_uid = :creator_uid"
        );

        // supply the replacement parameters to the query
        $stmt->execute(['id' => $this->id, 'creator_uid' => $this->creator_uid]);
        return $stmt->rowCount(); // return the number of affected rows (should be 1)
    }

    /**
     * Checks whether or not the person matching the current object status was created by the current user.
     *
     * @return int|mixed If the current user created the person, return the person. Otherwise, return 0.
     */
    public function isCreator()
    {
        // prepare the SQL DML Statements
        $stmt = $this->_connection->prepare(
            "SELECT *
            FROM Persons
            WHERE id = :id AND creator_uid = :creator_uid"
        );

        try {
            // supply the replacement parameters to the query
            $stmt->execute(['id' => $this->id, 'creator_uid' => $this->creator_uid]);
            return $stmt->fetch(); // returns the person record if it exists, false otherwise
        } catch (Exception $e) {
            return 0;
        }
    }

}

?>