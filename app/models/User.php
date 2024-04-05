<?php

class User extends Model {
    public $id;
    public $uname;
    public $password_hash;
    public $u_type;

    /**
     * Retrieves a user record from the DB having the username similar to the passed parameter.
     *
     * @param $uname string The partial username fragment to search for.
     *
     * @return mixed The user object if there exists a matching record, false otherwise.
     */
    public function getUserByUname($uname) {
        // prepare the SQL DML Statements
        $stmt = $this->_connection->prepare(
            "SELECT * 
               FROM User 
              WHERE uname = :uname");

        // supply the replacement parameters to the query
        $stmt->execute(['uname'=>$uname]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "User"); // set the retrieval to match an object of type User
        return $stmt->fetch(); // retrieve the User record and return it as a User object, or false
    }

    /**
     * Retrieves a set of user records from the DB having the username similar to the passed parameter.
     *
     * @param $uname string The partial username fragment to search for.
     * @param $limit int The optional maximum number of results to include.
     *
     * @return array|false The user object(s) if there exists at least one matching record, false otherwise.
     */
    public function getUsersByUname($uname, $limit = null) {
        // prepare the SQL DML Statements
        $stmt = "SELECT * 
                   FROM user 
                  WHERE uname LIKE :uname";
        // if there is a specified limit, append it to the SQL DML statement string
        if (isset($limit)) $stmt .= " LIMIT :cnt";

        // parse the SQL DML statement
        $stmt = $this->_connection->prepare($stmt);

        // if there is a specified limit, bind the replacement parameters to the query
        if (isset($limit)) $stmt->bindParam('cnt', $limit, PDO::PARAM_INT);

        // bind the replacement parameters to the query
        $stmt->bindValue('uname', "%$uname%");

        $stmt->execute(); // execute the query
        $stmt->setFetchMode(PDO::FETCH_CLASS, "User"); // set the retrieval to match an object of type User
        return $stmt->fetchAll(); // return all the matching User objects, or false
    }

    /**
     * Retrieves a user object from the DB having the passed user ID.
     *
     * @param $id int The user ID for the targeted user.
     *
     * @return mixed The User object, or false if there are no matching records.
     */
    public function getUserById($id) {
        // prepare the SQL DML Statements
        $stmt = $this->_connection->prepare(
            "SELECT * 
               FROM User 
              WHERE id = :id");

        // supply the replacement parameters to the query
        $stmt->execute(['id'=>$id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "User"); // set the retrieval to match an object of type User
        return $stmt->fetch(); // return the matching User object, or false
    }

    /**
     * Retrieves the username of a user having the passed user ID.
     *
     * @param $id int The user ID of the targeted user.
     *
     * @return mixed The username of the user, or false if the user does not exist.
     */
    public function getUsernameById($id) {
        // prepare the SQL DML Statements
        $stmt = $this->_connection->prepare(
            "SELECT uname
               FROM user
              WHERE id = :id ");

        // supply the replacement parameters to the query
        $stmt->execute(['id'=>$id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "User"); // set the retrieval to match an object of type User
        $result = $stmt->fetch(); // retrieve the matching User object
        return $result->uname; // return the username stored in the resulting User object
    }

    /**
     * Inserts a new user to the DB based on the current object status.
     *
     * @return int The number of rows affected. Expected to be 1.
     */
    public function insert() {
        // prepare the SQL DML Statements
        $stmt = $this->_connection->prepare("INSERT INTO User(uname, password_hash, u_type) VALUES(:uname, :password_hash, :u_type)");

        // supply the replacement parameters to the query
        $stmt->execute(['uname'=>$this->uname, 'password_hash'=>$this->password_hash, 'u_type'=>$this->u_type]);
        return $stmt->rowCount(); // return the number of affected rows (should be 1)
    }

    /**
     * Deletes a user from the DB based on the current object status.
     *
     * @return int The number of rows affected. Expected to be 1.
     */
    public function deleteByUname() {
        // prepare the SQL DML Statements
        $stmt = $this->_connection->prepare("DELETE FROM user WHERE uname = :uname");
        // supply the replacement parameters to the query
        $stmt->execute(['uname'=>$this->uname]);

        // prepare the SQL DML Statements
        $stmt = $this->_connection->prepare("SELECT * FROM user WHERE uname = :uname");
        // supply the replacement parameters to the query
        $stmt->execute(['uname'=>$this->uname]);

        return $stmt->rowCount(); // return the number of affected rows (should be 1)
    }

    /**
     * Fetches all available user types from the database.
     *
     * @return  mixed everything that is in the 'u_types' table.
     */
    public function getAllUserTypes() {
        $stmt = $this->_connection->prepare("SELECT * FROM u_types");
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retrieves all seeker users from the DB.
     *
     * @return mixed The user object lists.
     */
    public function getAllSeekers() {
        // prepare the SQL DML Statements
        $stmt = $this->_connection->prepare(
            "SELECT id
             FROM user
             WHERE u_type = (SELECT id 
                             FROM u_types
                             WHERE type=:type)"
        );

        // supply the replacement parameters to the query
        $stmt->execute(['type'=>"Seeker"]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "User"); // set the retrieval to match an object of type User
        return $stmt->fetchAll(); // execute the query and intercept the result
    }

    /**
     * Retrieves all users record from the DB.
     *
     * @return mixed User object list.
     */
    public function getAllUsers() {
        // prepare the SQL DML Statements
        $stmt = $this->_connection->prepare(
            "SELECT * FROM user WHERE u_type != 3;");

        // supply the replacement parameters to the query
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "User");
        return $stmt->fetchAll();
    }
}
