<?php

class Residence extends Model
{
    public $id;
    public $address;
    public $postalCode;
    public $city;
    public $province;
    public $type;
    public $phoneNumber;
    public $bedroomNumber;
    public $creator_uid;

    /**
     * Retrieves all the residence records from the DB.
     * 
     * @return array|false Array containing all the residences, or false if there are no residences.
     */
    public function getAllCompanies()
    {
        // prepare the SQL DML Statements
        $stmt = $this->_connection->prepare(
            "SELECT * 
               FROM Residences"
        );

        $stmt->execute(); // execute the query
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Residence"); // set the retrieval to match an object of type Residence
        return $stmt->fetchAll(); // returns all the residence records in residence objects as an array, or false
    }

    /**
     * Adds a residence to the DB based on the current object status.
     *
     * @return int Number of affected rows. Expected to be 1.
     */
    public function addresidence()
    {
        // prepare the SQL DML Statements
        $stmt = $this->_connection->prepare(
            "INSERT INTO Residences( address, postalCode, city, province, type, phoneNumber, bedroomNumber, creator_uid) 
                  VALUES (:address, :postalCode, :city, :province, :type, :phoneNumber, :bedroomNumber, :creator_uid)"
        );

        // supply the replacement parameters to the query
        $stmt->execute(['address' => $this->address, 'postalCode' => $this->postalCode, 'city' => $this->city, 'province' => $this->province, 'type' => $this->type, 'phoneNumber' => $this->phoneNumber, 'bedroomNumber' => $this->bedroomNumber,'creator_uid' => $this->creator_uid]);
        return $stmt->rowCount(); // return the number of affected rows (should be 1)
    }
    public function getresidenceById($id)
    {
        $stmt = $this->_connection->prepare("SELECT * FROM Residences WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_OBJ); // Fetches the residence
    }

    public function updateresidence()
    {
        $stmt = $this->_connection->prepare(
            "UPDATE Residences SET address=:address, postalCode=:postalCode, city=:city, province=:province, type=:type, phoneNumber=:phoneNumber, bedroomNumber=:bedroomNumber WHERE id=:id"
        );
        $stmt->execute([
            'address' => $this->address,
            'postalCode' => $this->postalCode,
            'city' => $this->city,
            'province' => $this->province,
            'type' => $this->type,
            'phoneNumber' => $this->phoneNumber,
            'bedroomNumber' => $this->bedroomNumber,
            'id' => $this->id
        ]);
        return $stmt->rowCount();
    }

    /**
     * Deletes a residence from the DB based on the current object status.
     *
     * @return int Number of affected rows. Expected to be 1.
     */
    public function deleteresidence()
    {
        // prepare the SQL DML Statements
        $stmt = $this->_connection->prepare(
            "DELETE FROM Residences WHERE id = :id AND creator_uid = :creator_uid"
        );

        // supply the replacement parameters to the query
        $stmt->execute(['id' => $this->id, 'creator_uid' => $this->creator_uid]);
        return $stmt->rowCount(); // return the number of affected rows (should be 1)
    }

    /**
     * Checks whether or not the residence matching the current object status was created by the current user.
     *
     * @return int|mixed If the current user created the residence, return the residence. Otherwise, return 0.
     */
    public function isCreator()
    {
        // prepare the SQL DML Statements
        $stmt = $this->_connection->prepare(
            "SELECT *
            FROM Residences
            WHERE id = :id AND creator_uid = :creator_uid"
        );

        try {
            // supply the replacement parameters to the query
            $stmt->execute(['id' => $this->id, 'creator_uid' => $this->creator_uid]);
            return $stmt->fetch(); // returns the residence record if it exists, false otherwise
        } catch (Exception $e) {
            return 0;
        }
    }

}

?>