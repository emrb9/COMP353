<?php

class Facility extends Model
{
    public $id;
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
    public $creator_uid;

    /**
     * Retrieves all the facility records from the DB.
     * 
     * @return array|false Array containing all the facilitys, or false if there are no facilitys.
     */

    public function getAllFacilities()
    {
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
                    f.id,
                    CONCAT(p.firstName, ' ', p.lastName) AS generalManagerName,
                    COUNT(DISTINCT e.SSN) AS numberOfEmployees,
                    SUM(CASE WHEN e.role = 'Doctor' THEN 1 ELSE 0 END) AS numberOfDoctors,
                    SUM(CASE WHEN e.role = 'Nurse' THEN 1 ELSE 0 END) AS numberOfNurses
                FROM 
                    facility f
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
    }
    
    /**
     * Adds a facility to the DB based on the current object status.
     *
     * @return int Number of affected rows. Expected to be 1.
     */
    public function addfacility()
    {
        // prepare the SQL DML Statements
        $stmt = $this->_connection->prepare(
            "INSERT INTO facility(name, address, postalCode, city, province, type, phoneNumber, capacity, webAddress ,managerSSN, creator_uid) 
                  VALUES (:name, :address, :postalCode, :city, :province, :type, :phoneNumber, :capacity, :webAddress ,:managerSSN, :creator_uid)"
        );

        // supply the replacement parameters to the query
        $stmt->execute(['name' => $this->name, 'address' => $this->address, 'postalCode' => $this->postalCode, 'city' => $this->city, 'province' => $this->province, 'type' => $this->type, 'phoneNumber' => $this->phoneNumber, 'capacity' => $this->capacity, 'webAddress' => $this->webAddress, 'managerSSN' => $this->managerSSN, 'creator_uid' => $this->creator_uid]);
        return $stmt->rowCount(); // return the number of affected rows (should be 1)
    }
    public function getfacilityById($id)
    {
        $stmt = $this->_connection->prepare("SELECT * FROM facility WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_OBJ); // Fetches the facility
    }

    public function updatefacility()
    {
        $stmt = $this->_connection->prepare(
            "UPDATE facility SET name=:name, address=:address, postalCode=:postalCode, city=:city, province=:province, type=:type, phoneNumber=:phoneNumber, capacity=:capacity, webAddress=:webAddress ,managerSSN=:managerSSN WHERE id=:id"
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
            'managerSSN' => $this->managerSSN,
            'id' => $this->id
        ]);
        return $stmt->rowCount();
    }


    /**
     * Deletes a facility from the DB based on the current object status.
     *
     * @return int Number of affected rows. Expected to be 1.
     */
    public function deletefacility()
    {
        // prepare the SQL DML Statements
        $stmt = $this->_connection->prepare(
            "DELETE FROM facility WHERE id = :id AND creator_uid = :creator_uid"
        );

        // supply the replacement parameters to the query
        $stmt->execute(['id' => $this->id, 'creator_uid' => $this->creator_uid]);
        return $stmt->rowCount(); // return the number of affected rows (should be 1)
    }

    /**
     * Checks whether or not a follow record matching the current object status exists in the DB.
     *
     * @return int|mixed If the user is following the facility, return the record. Otherwise return 0.
     */
    public function isFollowing()
    {
        // prepare the SQL DML Statements
        $stmt = $this->_connection->prepare(
            "SELECT *
            FROM facility_follower
            WHERE cid = :cid AND uid = :uid"
        );

        try {
            // supply the replacement parameters to the query
            $stmt->execute(['cid' => $this->id, 'uid' => $_SESSION['user_id']]);
            return $stmt->fetch(); // returns the subscription record if it exists, false otherwise
        } catch (Exception $e) {
            return 0;
        }
    }

    /**
     * Checks whether or not the facility matching the current object status was created by the current user.
     *
     * @return int|mixed If the current user created the facility, return the facility. Otherwise, return 0.
     */
    public function isCreator()
    {
        // prepare the SQL DML Statements
        $stmt = $this->_connection->prepare(
            "SELECT *
            FROM facility
            WHERE id = :id AND creator_uid = :creator_uid"
        );

        try {
            // supply the replacement parameters to the query
            $stmt->execute(['id' => $this->id, 'creator_uid' => $this->creator_uid]);
            return $stmt->fetch(); // returns the facility record if it exists, false otherwise
        } catch (Exception $e) {
            return 0;
        }
    }

    /**
     * Creates a record in the DB for the current user following a facility matching the current object status.
     *
     * @return int The number of affected rows. Expected to be 1.
     */
    public function followfacility()
    {
        // prepare the SQL DML Statements
        $stmt = $this->_connection->prepare(
            "INSERT INTO facility_follower(cid, uid) 
                  VALUES (:cid, :uid)"
        );

        // supply the replacement parameters to the query
        $stmt->execute(['cid' => $this->id, 'uid' => $_SESSION['user_id']]);
        return $stmt->rowCount(); // return the number of affected rows (should be 1)
    }

    /**
     * Destroys the record in the DB for the current member who is following a facility matching the object status.
     *
     * @return int The number of affected rows. Expected to be 1.
     */
    public function unfollowfacility()
    {
        // prepare the SQL DML Statements
        $stmt = $this->_connection->prepare(
            "DELETE FROM facility_follower
                  WHERE (cid = :cid AND uid = :uid)"
        );

        // supply the replacement parameters to the query
        $stmt->execute(['cid' => $this->id, 'uid' => $_SESSION['user_id']]);
        return $stmt->rowCount(); // return the number of affected rows (should be 1)
    }


}

?>