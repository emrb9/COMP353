<?php

class Infection extends Model
{
    public $SSN;
    public $type;
    public $date;

    public function getAllInfections()
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
    
    public function addinfection()
    {
        try {
            $stmt = $this->_connection->prepare(
                "INSERT INTO Infections( SSN, type, date) 
                VALUES (:SSN, :type, :date)"
            );

            $stmt->execute([ 
                'SSN' => $this->SSN, 
                'type' => $this->type, 
                'date' => $this->date,
            ]);

            return $stmt->rowCount();
        } catch (Exception $e) {
            error_log('Error adding infection: ' . $e->getMessage());
            return false;
        }
    }

    public function getinfectionById($SSN, $type, $date)
    {
        try {
            $stmt = $this->_connection->prepare("SELECT * FROM Infections WHERE SSN = :SSN AND type = :type AND date = :date");
            $stmt->execute(['SSN' => $SSN, 'type' => $type, 'date'=> $date]);
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            error_log('Error fetching infection by ID: ' . $e->getMessage());
            return false;
        }
    }

    public function updateinfection($SSN, $type, $date) {
        try {
            $stmt = $this->_connection->prepare(
                "UPDATE Infections SET 
                    SSN = :SSN, 
                    type = :type, 
                    date = :date
                WHERE SSN = :SSN AND type = :type AND date = :date"
            );
    
            $stmt->execute([
                'SSN' => $SSN,
                'type' => $type,
                'date' => $date,
            ]);
    
            return $stmt->rowCount();
        } catch (Exception $e) {
            error_log('Error updating infection: ' . $e->getMessage());
            return false;
        }
    }
    
    

    public function deleteinfection()
    {
        $this->_connection->beginTransaction();
        
        try {
            
            $stmtInfections = $this->_connection->prepare(
                "DELETE FROM Infections WHERE SSN = :SSN AND type = :type AND date = :date"
            );
            $stmtInfections->execute(['SSN' => $this->SSN, 'type' => $this->type,'date' => $this->date]);

            $this->_connection->commit();
            return $stmtInfections->rowCount();
        } catch (Exception $e) {
            $this->_connection->rollBack();
            error_log('Error deleting infection: ' . $e->getMessage());
            return false;
        }
    }
}

?>