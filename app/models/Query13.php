<?php

class Query13 extends Model
{
    public function getAllQuery13()
    {
        try {
            $sql = "SELECT
            Logs.sender,
            Logs.receiver,
            DATE_FORMAT(Logs.date, '%Y-%m-%d') AS date
     FROM Logs
              JOIN Employees E
                   ON E.SSN = (SELECT P.SSN FROM Persons P WHERE P.emailAddress = Logs.receiver)
              JOIN Persons P ON E.SSN = P.SSN
     WHERE Logs.sender = 'CLSC Addison'
       AND Logs.subject = 'Assignment Cancellation'
       AND Logs.date BETWEEN '2019-01-01' AND '2024-01-01'
     ORDER BY Logs.date DESC";

            $stmt = $this->_connection->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, "Query13");
            return $stmt->fetchAll();
        } catch (Exception $e) {
            // Log error or handle it as required
            error_log('Error fetching queries11: ' . $e->getMessage());
            return false; // Or any other error handling mechanism
        }
    }
}

?>