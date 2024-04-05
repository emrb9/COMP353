<?php

class Infection extends Model
{
    public $id;
    public $SSN;
    public $type;
    public $date;
    public $creator_uid;

    /**
     * Retrieves all the infection records from the DB.
     * 
     * @return array|false Array containing all the infections, or false if there are no infections.
     */
    public function getAllCompanies()
    {
        // prepare the SQL DML Statements
        $stmt = $this->_connection->prepare(
            "SELECT * 
               FROM Infections"
        );

        $stmt->execute(); // execute the query
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Infection"); // set the retrieval to match an object of type Infection
        return $stmt->fetchAll(); // returns all the infection records in infection objects as an array, or false
    }

    /**
     * Adds a infection to the DB based on the current object status.
     *
     * @return int Number of affected rows. Expected to be 1.
     */
    public function addinfection()
    {
        // prepare the SQL DML Statements
        $stmt = $this->_connection->prepare(
            "INSERT INTO Infections( SSN, type, date, creator_uid) 
                  VALUES (:SSN, :type, :date, :creator_uid)"
        );

        // supply the replacement parameters to the query
        $stmt->execute(['SSN' => $this->SSN, 'type' => $this->type, 'date' => $this->date,'creator_uid' => $this->creator_uid]);
        return $stmt->rowCount(); // return the number of affected rows (should be 1)
    }
    public function getinfectionById($id)
    {
        $stmt = $this->_connection->prepare("SELECT * FROM Infections WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_OBJ); // Fetches the infection
    }

    public function updateinfection()
    {
        $stmt = $this->_connection->prepare(
            "UPDATE Infections SET SSN=:SSN, type=:type, date=:date WHERE id=:id"
        );
        $stmt->execute([
            'SSN' => $this->SSN,
            'type' => $this->type,
            'date' => $this->date,
            'id' => $this->id,
        ]);
        return $stmt->rowCount();
    }

    /**
     * Deletes a infection from the DB based on the current object status.
     *
     * @return int Number of affected rows. Expected to be 1.
     */
    public function deleteinfection()
    {
        // prepare the SQL DML Statements
        $stmt = $this->_connection->prepare(
            "DELETE FROM Infections WHERE id = :id AND creator_uid = :creator_uid"
        );

        // supply the replacement parameters to the query
        $stmt->execute(['id' => $this->id, 'creator_uid' => $this->creator_uid]);
        return $stmt->rowCount(); // return the number of affected rows (should be 1)
    }

    /**
     * Checks whether or not the infection matching the current object status was created by the current user.
     *
     * @return int|mixed If the current user created the infection, return the infection. Otherwise, return 0.
     */
    public function isCreator()
    {
        // prepare the SQL DML Statements
        $stmt = $this->_connection->prepare(
            "SELECT *
            FROM Infections
            WHERE id = :id AND creator_uid = :creator_uid"
        );

        try {
            // supply the replacement parameters to the query
            $stmt->execute(['id' => $this->id, 'creator_uid' => $this->creator_uid]);
            return $stmt->fetch(); // returns the infection record if it exists, false otherwise
        } catch (Exception $e) {
            return 0;
        }
    }

}

?>