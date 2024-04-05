<?php include 'app/views/Common/header.php' ?>

    <link href="../../../css/MyProfile.css" rel="stylesheet" type="text/css"/>
    <link href="../../../css/edit.css" rel="stylesheet" type="text/css"/>

    <div class="content">
        <!--CONTENT START-->

        <h3 class="content-header">Add Vaccination</h3>
        <div class="container">
        <form class="form-format" method="post">
        <div class="form-group">
          <label for="SSN">SSN:</label>
          <br>
          <input type="text" name="SSN" class="form-control" id="SSN" placeholder="SSN" required/>
        </div>
        <br>
        <div class="form-group">
          <label for="doseNumber">Dose Number:</label>
          <br>
          <input type="text" name="doseNumber" class="form-control" id="doseNumber" placeholder="Dose Number" required/>
        </div>
        <br>
        <div class="form-group">
          <label for="type">Type:</label>
          <br>
          <input type="text" name="type" class="form-control" id="type" placeholder="Type" required/>
        </div>
        <br>
        <div class="form-group">
          <label for="date">Date:</label>
          <br>
          <input type="tel" name="date" class="form-control" id="date" placeholder="Date" required/>
        </div>
        <br>
        <div class="form-group">
          <label for="address">Address:</label>
          <br>
          <input type="text" name=" address" class="form-control" id=" address" placeholder="Address" required/>
        </div>
        <br>
        <div class="form-group">
          <label for="postalCode">Postal Code:</label>
          <br>
          <input type="text" name="postalCode" class="form-control" id="postalCode" placeholder="Postal Code" required/>
        </div>

        <button type="submit" name="action" class="create">Add Vaccination</button>
        <button class="cancel" onclick="window.location.href='/Vaccination'">Cancel</button>
    </form>
        </div>
        <!-- CONTENT END-->

<?php include 'app/views/Common/footer.php' ?>
