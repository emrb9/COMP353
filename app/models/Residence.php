<?php

class Residence extends Model
{
    public $address;
    public $postalCode;
    public $city;
    public $province;
    public $type;
    public $phoneNumber;
    public $bedroomNumber;

    public function getAllResidences()
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
    
    public function addresidence()
    {
        try {
            $stmt = $this->_connection->prepare(
                "INSERT INTO Residences( address, postalCode, city, province, type, phoneNumber, bedroomNumber) 
                  VALUES (:address, :postalCode, :city, :province, :type, :phoneNumber, :bedroomNumber)"
            );

            $stmt->execute([ 
                'address' => $this->address, 
                'postalCode' => $this->postalCode, 
                'city' => $this->city, 
                'province' => $this->province, 
                'type' => $this->type, 
                'phoneNumber' => $this->phoneNumber, 
                'bedroomNumber' => $this->bedroomNumber, 
            ]);

            return $stmt->rowCount();
        } catch (Exception $e) {
            error_log('Error adding residence: ' . $e->getMessage());
            return false;
        }
    }

    public function getresidenceById($address, $postalCode)
    {
        try {
            $stmt = $this->_connection->prepare("SELECT * FROM Residences WHERE address = :address AND postalCode = :postalCode");
            $stmt->execute(['address' => $address, 'postalCode' => $postalCode]);
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            error_log('Error fetching residence by ID: ' . $e->getMessage());
            return false;
        }
    }

    public function updateresidence($address, $postalCode, $city, $province, $type, $phoneNumber, $bedroomNumber) {
        try {
            $stmt = $this->_connection->prepare(
                "UPDATE Residences SET 
                    address = :address, 
                    postalCode = :postalCode, 
                    city = :city, 
                    province = :province, 
                    type = :type, 
                    phoneNumber = :phoneNumber, 
                    bedroomNumber = :bedroomNumber 
                WHERE address = :address AND postalCode = :postalCode"
            );
    
            $stmt->execute([
                'address' => $address,
                'postalCode' => $postalCode,
                'city' => $city,
                'province' => $province,
                'type' => $type,
                'phoneNumber' => $phoneNumber,
                'bedroomNumber' => $bedroomNumber,
            ]);
    
            return $stmt->rowCount();
        } catch (Exception $e) {
            error_log('Error updating residence: ' . $e->getMessage());
            return false;
        }
    }
    

    public function deleteresidence()
    {
        $this->_connection->beginTransaction();
        
        try {
            $stmtPrimaryResidences = $this->_connection->prepare(
                "DELETE FROM PrimaryResidences WHERE address = :address AND postalCode = :postalCode"
            );
            $stmtPrimaryResidences->execute(['address' => $this->address, 'postalCode' => $this->postalCode]);

            $stmtSecondaryResidences = $this->_connection->prepare(
                "DELETE FROM SecondaryResidences WHERE address = :address AND postalCode = :postalCode"
            );
            $stmtSecondaryResidences->execute(['address' => $this->address, 'postalCode' => $this->postalCode]);

            $stmtResidences = $this->_connection->prepare(
                "DELETE FROM Residences WHERE address = :address AND postalCode = :postalCode"
            );
            $stmtResidences->execute(['address' => $this->address, 'postalCode' => $this->postalCode]);

            $this->_connection->commit();
            return $stmtResidences->rowCount();
        } catch (Exception $e) {
            $this->_connection->rollBack();
            error_log('Error deleting residence: ' . $e->getMessage());
            return false;
        }
    }
}

?>