<?php

class Notification extends Model {
    // Constant declared to reference the content type of a notification record
    CONST _TYPES = ['MESSAGE'=>0, 'JOB'=>1];

    public $id; // ID of the notification record
    public $type; // type of the notification record
    public $content; // content of the notification record
    public $uid; // ID of the user to target for the notification


    public function create() {
        // prepare the SQL DML Statements
        $stmt = $this->_connection->prepare(
            "INSERT INTO notification(type, content, uid) 
                  VALUES (:type, :content, :uid)"
        );

        // supply the replacement parameters to the query
        $stmt->execute(['type'=>$this->type, 'content'=>$this->content, 'uid'=>$this->uid]);
        return $stmt->rowCount(); // execute the query and return the number of affected rows (should be 1)
    }

    public function destroy() {
        // prepare the SQL DML Statements
        $stmt = $this->_connection->prepare(
            "DELETE FROM notification 
             WHERE id=:id"
        );

        // supply the replacement parameters to the query
        $stmt->execute(['id'=>$this->id]);
        return $stmt->rowCount(); // execute the query and return the number of affected rows (should be 1)
    }

    public function getAllNotificationsForUserID() {
        // prepare the SQL DML Statements
        $stmt = $this->_connection->prepare(
            "SELECT *
             FROM notification
             WHERE uid=:uid"
        );

        $stmt->execute(['uid'=>$this->uid]); // supply the replacement parameters to the query
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Notification"); // set the retrieval to match an object of type Notification
        return $stmt->fetchAll(); // execute the query and return the result
    }

    public function destroyAllNotificationsForUserID() {
        // prepare the SQL DML Statements
        $stmt = $this->_connection->prepare(
            "DELETE FROM notification 
             WHERE uid=:uid"
        );

        // supply the replacement parameters to the query
        $stmt->execute(['uid'=>$this->uid]);
        return $stmt->rowCount(); // execute the query and return the number of affected rows (should be 1)
    }

    public function getAllTypeNotificationsForUserID($type) {
        // prepare the SQL DML Statements
        $stmt = $this->_connection->prepare(
            "SELECT *
             FROM notification
             WHERE uid=:uid AND type=:type"
        );

        $stmt->execute(['uid'=>$this->uid, 'type'=>$this::_TYPES[$type]]); // supply the replacement parameters to the query
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Notification"); // set the retrieval to match an object of type Notification
        return $stmt->fetchAll(); // execute the query and return the result
    }

    public function destroyAllTypeNotificationsForUserID($type) {
        // prepare the SQL DML Statements
        $stmt = $this->_connection->prepare(
            "DELETE FROM notification 
             WHERE uid=:uid AND type=:type"
        );

        // supply the replacement parameters to the query
        $stmt->execute(['uid'=>$this->uid, 'type'=>$this::_TYPES[$type]]);
        return $stmt->rowCount(); // execute the query and return the number of affected rows (should be 1)
    }

}

?>