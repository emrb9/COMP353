<?php include 'app/views/Common/header.php' ?>

    <link href="../../../css/MyProfile.css" rel="stylesheet" type="text/css"/>
    <link href="../../../css/edit.css" rel="stylesheet" type="text/css"/>

    <div class="content">
        <!--CONTENT START-->

        <h3 class="content-header">Add Person</h3>
        <div class="container">
        <form class="form-format" method="post">
        <div class="form-group">
          <label for="SSN">SSN:</label>
          <br>
          <input type="text" name=" SSN" class="form-control" id=" SSN" placeholder="SSN" required/>
        </div>
        <br>
        <div class="form-group">
          <label for="cellNumber">Phone Number:</label>
          <br>
          <input type="tel" name="cellNumber" class="form-control" id="cellNumber" placeholder="Phone Number" required/>
        </div>
        <br>
        <div class="form-group">
          <label for="firstName">First Name:</label>
          <br>
          <input type="text" name="firstName" class="form-control" id="firstName" placeholder="First Name" required/>
        </div>
        <br>
        <div class="form-group">
          <label for="lastName">Last Name:</label>
          <br>
          <input type="text" name="lastName" class="form-control" id="lastName" placeholder="Last Name" required/>
        </div>
        <br>
        <div class="form-group">
          <label for="citizenship">Citizenship:</label>
          <br>
          <input type="text" name="citizenship" class="form-control" id="citizenship" placeholder="Citizenship" required/>
        </div>
        <br>
        <div class="form-group">
          <label for="dateOfBirth">Date of Birth:</label>
          <br>
          <input type="text" name="dateOfBirth" class="form-control" id="dateOfBirth" placeholder="YYYY-MM-DD" required/>
        </div>
        <br>
        <div class="form-group">
          <label for="emailAddress">Email Address:</label>
          <br>
          <input type="text" name="emailAddress" class="form-control" id="emailAddress" placeholder="Email Address" required/>
        </div>
        <br>
        <div class="form-group">
          <label for="occupation">Occupation:</label>
          <br>
          <input type="text" name="occupation" class="form-control" id="occupation" placeholder="Occupation" required/>
        </div>

        <button type="submit" name="action" class="create">Add Person</button>
        <button class="cancel" onclick="window.location.href='/Person'">Cancel</button>
    </form>
        </div>
        <!-- CONTENT END-->

<?php include 'app/views/Common/footer.php' ?>
