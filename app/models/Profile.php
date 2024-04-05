<?php

class Profile extends Model {
    public $id;
    public $fname, $lname;
    public $email;
    public $job_title;
    public $location;
    public $img_src = "";
    public $skills;
    public $about;
    public $public = 1;

    /**
     * Creates a profile in the DB based on the current object status.
     *
     * @return int The number of affected rows. Expected to be 1.
     */
    public function create() {
        // prepare the SQL DML Statements
        $stmt = $this->_connection->prepare(
            "INSERT INTO profile(id, fname, lname, email, job_title,
                    location, img_src, skills, about) 
                  VALUES (:id, :fname, :lname, :email, :job_title,
                    :location, :img_src, :skills, :about)"
        );

        // supply the replacement parameters to the query
        $stmt->execute(['id'=>$this->id, 'fname'=>$this->fname, 'lname'=>$this->lname,
                        'email'=>$this->email, 'job_title'=>$this->job_title, 'location'=>$this->location,
                        'img_src'=>$this->img_src, 'skills'=>$this->skills, 'about'=>$this->about]);
        return $stmt->rowCount(); // return the number of affected rows (should be 1)
    }

    /**
     * Edits a profile in the DB based on the current object status.
     *
     * @return int The number of affected rows. Expected to be 1.
     */
    public function edit() {
        // prepare the SQL DML Statements
        $stmt = $this->_connection->prepare(
            "UPDATE profile
             SET fname=:fname, lname=:lname, email=:email, job_title=:job_title, 
                  location=:location, img_src=:img_src, skills=:skills, about=:about
             WHERE id=:id"
        );

        // supply the replacement parameters to the query
        $stmt->execute(['id'=>$this->id, 'fname'=>$this->fname, 'lname'=>$this->lname, 'email'=>$this->email,
                        'job_title'=>$this->job_title, 'location'=>$this->location, 'img_src'=>$this->img_src,
                        'skills'=>$this->skills, 'about'=>$this->about]);
        return $stmt->rowCount(); // return the number of affected rows (should be 1)
    }

    /**
     * Retrieves the profile of the user who matches the current object status.
     *
     * @return mixed The user's profile, or false.
     */
    public function getProfile() {
        // prepare the SQL DML Statements
        $stmt = $this->_connection->prepare(
            "SELECT *
             FROM profile
             WHERE id=:id"
        );

        // supply the replacement parameters to the query
        $stmt->execute(['id'=>$this->id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Profile"); // set the retrieval to match an object of type Profile
        return $stmt->fetch(); // return the profile record as an object or false
    }

    /**
     * Retrieves all the profiles in the system, except the profile of the current user.
     *
     * @return array|false Array of all the profiles in the system, or false.
     */
    public function getAllProfiles() {
        // prepare the SQL DML Statements
        $stmt = $this->_connection->prepare(
            "SELECT *
             FROM profile
             WHERE id != :id"
        );

        // supply the replacement parameters to the query
        $stmt->execute(['id'=>$_SESSION['user_id']]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Profile"); // set the retrieval to match an object of type Profile
        return $stmt->fetchAll(); // return the array of profiles, or false
    }

    /**
     * Toggles the profile visibility field based on the current object status.
     *
     * @return int The number of affected rows. Expected to be 1.
     */
    public function updateVisibility() {
        // prepare the SQL DML Statements
        $stmt = $this->_connection->prepare(
            "UPDATE profile
             SET public=:public
             WHERE id=:id"
        );

        // supply the replacement parameters to the query
        $stmt->execute(['id'=>$this->id, 'public'=>$this->public]);
        return $stmt->rowCount(); // return the number of affected rows (should be 1)
    }


    public function getFnameForUser($uid) {
        // prepare the SQL DML Statements
        $stmt = $this->_connection->prepare(
            "SELECT fname
             FROM profile
             WHERE id = :id"
        );

        // supply the replacement parameters to the query
        $stmt->execute(['id'=>$uid]);
        $result = $stmt->fetch(); // execute the query and intercept the result
        return $result['fname']; // return the user's first name, or false
    }
}

?>