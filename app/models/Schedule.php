<?php

class Schedule extends Model
{
    public $SSN;
    public $address;
    public $postalCode;
    public $startTime;
    public $endTime;
    public $date;

    public function getAllSchedules()
    {
        // prepare the SQL DML Statements
        $stmt = $this->_connection->prepare(
            "SELECT * 
               FROM Schedules"
        );

        $stmt->execute(); // execute the query
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Schedule"); // set the retrieval to match an object of type Schedule
        return $stmt->fetchAll(); // returns all the schedule records in schedule objects as an array, or false
    }
    
    public function addschedule()
    {
        try {
            $stmt = $this->_connection->prepare(
                "INSERT INTO Schedules( SSN, address, postalCode, startTime, endTime, date) 
                  VALUES (:SSN, :address, :postalCode, :startTime, :endTime, :date)"
            );

            $stmt->execute([ 
                'SSN' => $this->SSN, 
                'address' => $this->address, 
                'postalCode' => $this->postalCode, 
                'startTime' => $this->startTime, 
                'endTime' => $this->endTime, 
                'date' => $this->date, 
            ]);

            return $stmt->rowCount();
        } catch (Exception $e) {
            error_log('Error adding schedule: ' . $e->getMessage());
            return false;
        }
    }

    public function getscheduleById($SSN, $address, $postalCode, $startTime, $date)
    {
        try {
            $stmt = $this->_connection->prepare("SELECT * FROM Schedules WHERE SSN = :SSN AND address = :address AND postalCode = :postalCode AND startTime = :startTime AND date = :date");
            $stmt->execute(['SSN' => $SSN, 'address' => $address, 'postalCode' => $postalCode,'startTime' => $startTime, 'date' => $date] );
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            error_log('Error fetching schedule by ID: ' . $e->getMessage());
            return false;
        }
    }

    public function updateschedule($SSN, $address, $postalCode, $startTime, $endTime, $date) {
        try {
            $stmt = $this->_connection->prepare(
                "UPDATE Schedules SET 
                    SSN = :SSN,
                    address = :address, 
                    postalCode = :postalCode, 
                    startTime = :startTime, 
                    endTime = :endTime, 
                    date = :date
                WHERE SSN = :SSN AND address = :address AND postalCode = :postalCode AND startTime = :startTime AND date = :date"
            );
    
            $stmt->execute([
                'SSN' => $SSN,
                'address'=> $address,
                'postalCode' => $postalCode,
                'startTime' => $startTime,
                'endTime' => $endTime,
                'date' => $date,
            ]);
    
            return $stmt->rowCount();
        } catch (Exception $e) {
            error_log('Error updating schedule: ' . $e->getMessage());
            return false;
        }
    }
    

    public function deleteschedule()
    {
        $this->_connection->beginTransaction();
        
        try {
            $stmtSchedules = $this->_connection->prepare(
                "DELETE FROM Schedules WHERE SSN = :SSN AND address = :address AND postalCode = :postalCode AND startTime = :startTime AND date = :date"
            );
            $stmtSchedules->execute(['SSN' => $this->SSN,'address' => $this->address, 'postalCode' => $this->postalCode,'startTime' => $this->startTime, 'date'=> $this->date]);

            $this->_connection->commit();
            return $stmtSchedules->rowCount();
        } catch (Exception $e) {
            $this->_connection->rollBack();
            error_log('Error deleting schedule: ' . $e->getMessage());
            return false;
        }
    }
}

?>