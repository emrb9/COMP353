<?php

class Employee extends Model
{
    public $master; // me
    public $slave; // users connected to me

    /**
     * Fetches all the profiles from the DB. For profiles who are connected to the current user,
     * the system adds a boolean field to the appropriate profile element.
     *
     * @return array Array of all the profiles in the system, including connection status to the current user.
     */
    public function getAllEmployeeDetails()
    {
        // Fetch employee details - adjust on actual DB structure
        $stmt = $this->_connection->prepare("
        SELECT e.SSN, p.firstName, p.lastName, e.role, e.medicareNumber, v.type AS vaccinationType, v.doseNumber, v.date AS vaccinationDate
        FROM Employees e
        JOIN Persons p ON e.SSN = p.SSN
        LEFT JOIN Vaccinations v ON e.SSN = v.SSN
        ORDER BY p.lastName, p.firstName, v.date DESC
        
        ");

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ); // Fetching as objects for easier access in PHP
    }
    /* -------------------- TO DO: PROPERLY INTEGRATE addEmployee -------------------- */
    public function addEmployee($data)
{
    // Start the transaction
    $this->_connection->beginTransaction();
    try {
        // Check if the person exists in the Persons table
        $stmtCheck = $this->_connection->prepare("SELECT COUNT(*) FROM Persons WHERE SSN = :SSN");
        $stmtCheck->execute([':SSN' => $data['SSN']]);
        $exists = $stmtCheck->fetchColumn();

        // Log for debugging
        error_log("Person check for SSN {$data['SSN']} exists: " . ($exists ? "Yes" : "No"));

        if ($exists == 0) {
            // If the person does not exist, throw an exception
            throw new Exception("Person with SSN {$data['SSN']} does not exist.");
        }

        // Insert into Employees table
        $stmt = $this->_connection->prepare("
            INSERT INTO Employees (SSN, medicareNumber, role)
            VALUES (:SSN, :medicareNumber, :role);
        ");

        // Execute the statement and check if the insert was successful
        $success = $stmt->execute([
            ':SSN' => $data['SSN'],
            ':medicareNumber' => $data['medicareNumber'],
            ':role' => $data['role'],
        ]);

        // Check the number of affected rows
        $affectedRows = $stmt->rowCount();

        // Log for debugging
        error_log("Insert operation success: " . ($success ? "Yes" : "No") . ". Affected rows: " . $affectedRows);

        // If no rows were affected, the insert did not happen, throw an exception
        if ($affectedRows == 0) {
            throw new Exception("Failed to insert employee with SSN {$data['SSN']}");
        }

        // Commit the transaction
        $this->_connection->commit();
        return true; // Indicate success
    } catch (Exception $e) {
        // If an exception was caught, roll back the transaction and log the error
        $this->_connection->rollback();
        error_log("Failed to add employee: " . $e->getMessage());
        throw $e;
    }
}

    /* -------------------- TO DO: PROPERLY INTEGRATE updateEmployee -------------------- */
    public function checkEmployeeExists($SSN)
{
    $stmt = $this->_connection->prepare("SELECT COUNT(*) FROM Employees WHERE SSN = :SSN");
    $stmt->execute([':SSN' => $SSN]);
    $count = $stmt->fetchColumn();
    return $count > 0;
}
public function updateEmployee($SSN, $data)
    {
        $this->_connection->beginTransaction();
        try {
            // Check if the person exists in the Persons table
            $stmtCheck = $this->_connection->prepare("SELECT COUNT(*) FROM Persons WHERE SSN = :SSN");
            $stmtCheck->execute([':SSN' => $SSN]);
            $exists = $stmtCheck->fetchColumn();
    
            if ($exists == 0) {
                throw new Exception("Person with SSN {$SSN} does not exist.");
            }
    
            // Update Employees table
            $stmt = $this->_connection->prepare("
                UPDATE Employees 
                SET medicareNumber = :medicareNumber, role = :role
                WHERE SSN = :SSN;
            ");
    
            $stmt->execute([
                ':SSN' => $SSN,
                ':medicareNumber' => $data['medicareNumber'],
                ':role' => $data['role'],
            ]);
    
            $this->_connection->commit();
            return true; // Indicate success
        } catch (Exception $e) {
            $this->_connection->rollback();
            throw $e;
        }
    }    

    public function deleteEmployee($SSN)
{
    $this->_connection->beginTransaction();
    try {
        // Step 1: Delete related records in LivesWith
        $stmt1 = $this->_connection->prepare("DELETE FROM LivesWith WHERE employeeSSN = :SSN");
        $stmt1->execute([':SSN' => $SSN]);

        // Step 2: Delete the employee from Employees
        $stmt2 = $this->_connection->prepare("DELETE FROM Schedules WHERE SSN = :SSN");
        $stmt2->execute([':SSN' => $SSN]);

        // Step 3: Delete the employee from Employees
        $stmt3 = $this->_connection->prepare("DELETE FROM WorksAt WHERE SSN = :SSN");
        $stmt3->execute([':SSN' => $SSN]);
        
        // Step 4: Delete the employee from Employees
        $stmt4 = $this->_connection->prepare("DELETE FROM Employees WHERE SSN = :SSN");
        $stmt4->execute([':SSN' => $SSN]);

        // If both steps are successful, commit the transaction
        $this->_connection->commit();
        return true; // Indicate success
    } catch (Exception $e) {
        // If there is any error, rollback the transaction
        $this->_connection->rollback();
        error_log("Deletion failed: " . $e->getMessage()); // Log detailed error for debugging
        return false; // Indicate failure
    }
}


}

?>