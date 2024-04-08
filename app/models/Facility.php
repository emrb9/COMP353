<?php

class Facility extends Model
{
    public $name;
    public $address;
    public $postalCode;
    public $city;
    public $province;
    public $type;
    public $phoneNumber;
    public $capacity;
    public $webAddress;
    public $managerSSN;
    public function getAllFacilities()
    {
        try {
            $sql = "SELECT 
                        f.name AS facilityName,
                        f.address,
                        f.city,
                        f.province,
                        f.postalCode,
                        f.phoneNumber,
                        f.webAddress,
                        f.type,
                        f.capacity,
                        CONCAT(p.firstName, ' ', p.lastName) AS generalManagerName,
                        COUNT(DISTINCT e.SSN) AS numberOfEmployees,
                        SUM(CASE WHEN e.role = 'Doctor' THEN 1 ELSE 0 END) AS numberOfDoctors,
                        SUM(CASE WHEN e.role = 'Nurse' THEN 1 ELSE 0 END) AS numberOfNurses
                    FROM 
                        Facilities f
                    LEFT JOIN 
                        Employees e ON f.managerSSN = e.SSN
                    LEFT JOIN 
                        Persons p ON e.SSN = p.SSN
                    LEFT JOIN 
                        WorksAt wa ON f.address = wa.address AND f.postalCode = wa.postalCode
                    GROUP BY 
                        f.address, f.postalCode
                    ORDER BY 
                        f.province ASC, 
                        f.city ASC, 
                        f.type ASC, 
                        numberOfDoctors ASC";

            $stmt = $this->_connection->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, "Facility");
            return $stmt->fetchAll();
        } catch (Exception $e) {
            // Log error or handle it as required
            error_log('Error fetching facilities: ' . $e->getMessage());
            return false; // Or any other error handling mechanism
        }
    }
    
    public function addfacility()
    {
        try {
            $stmt = $this->_connection->prepare(
                "INSERT INTO Facilities(name, address, postalCode, city, province, type, phoneNumber, capacity, webAddress ,managerSSN) 
                VALUES (:name, :address, :postalCode, :city, :province, :type, :phoneNumber, :capacity, :webAddress ,:managerSSN)"
            );

            $stmt->execute([
                'name' => $this->name, 
                'address' => $this->address, 
                'postalCode' => $this->postalCode, 
                'city' => $this->city, 
                'province' => $this->province, 
                'type' => $this->type, 
                'phoneNumber' => $this->phoneNumber, 
                'capacity' => $this->capacity, 
                'webAddress' => $this->webAddress, 
                'managerSSN' => $this->managerSSN
            ]);

            return $stmt->rowCount();
        } catch (Exception $e) {
            error_log('Error adding facility: ' . $e->getMessage());
            return false;
        }
    }

    public function getfacilityById($address, $postalCode)
    {


        try {
            $stmt = $this->_connection->prepare("SELECT * FROM Facilities WHERE address = :address AND postalCode = :postalCode");
            $stmt->execute(['address' => $address, 'postalCode' => $postalCode]);
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            error_log('Error fetching facility by ID: ' . $e->getMessage());
            return false;
        }
    }

    public function updatefacility($originalAddress, $originalPostalCode, $name, $address, $postalCode, $city, $province, $type, $phoneNumber, $capacity, $webAddress, $managerSSN) {
        try {
            $stmt = $this->_connection->prepare(
                "UPDATE Facilities SET 
                    name = :name, 
                    address = :newAddress, 
                    postalCode = :newPostalCode, 
                    city = :city, 
                    province = :province, 
                    type = :type, 
                    phoneNumber = :phoneNumber, 
                    capacity = :capacity, 
                    webAddress = :webAddress, 
                    managerSSN = :managerSSN 
                WHERE address = :originalAddress AND postalCode = :originalPostalCode"
            );
    
            $stmt->execute([
                'name' => $name,
                'newAddress' => $address,
                'newPostalCode' => $postalCode,
                'city' => $city,
                'province' => $province,
                'type' => $type,
                'phoneNumber' => $phoneNumber,
                'capacity' => $capacity,
                'webAddress' => $webAddress,
                'managerSSN' => $managerSSN,
                'originalAddress' => $originalAddress,
                'originalPostalCode' => $originalPostalCode,
            ]);
    
            return $stmt->rowCount();
        } catch (Exception $e) {
            error_log('Error updating facility: ' . $e->getMessage());
            return false;
        }
    }    
    

    public function deletefacility()
    {
        $this->_connection->beginTransaction();
        
        try {
            $stmtWorksAt = $this->_connection->prepare(
                "DELETE FROM WorksAt WHERE address = :address AND postalCode = :postalCode"
            );
            $stmtWorksAt->execute(['address' => $this->address, 'postalCode' => $this->postalCode]);

            $stmtSchedules = $this->_connection->prepare(
                "DELETE FROM Schedules WHERE address = :address AND postalCode = :postalCode"
            );
            $stmtSchedules->execute(['address' => $this->address, 'postalCode' => $this->postalCode]);
            
            $stmtFacility = $this->_connection->prepare(
                "DELETE FROM Facilities WHERE address = :address AND postalCode = :postalCode"
            );
            $stmtFacility->execute(['address' => $this->address, 'postalCode' => $this->postalCode]);

            $this->_connection->commit();
            return $stmtFacility->rowCount();
        } catch (Exception $e) {
            $this->_connection->rollBack();
            error_log('Error deleting facility: ' . $e->getMessage());
            return false;
        }
    }
}

?>