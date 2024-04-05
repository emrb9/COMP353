<?php include 'app/views/Common/header.php' ?>

    <link href="../../../css/MyProfile.css" rel="stylesheet" type="text/css"/>
    <link href="../../../css/edit.css" rel="stylesheet" type="text/css"/>

    <div class="content">
        <!--CONTENT START-->

        <h3 class="content-header">Add Facility</h3>
        <div class="container">
        <form class="form-format" method="post">
        <div class="form-group">
          <label for="name">Name:</label>
          <br>
          <input type="text" name="name" class="form-control" id="name" placeholder="Name" required/>
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
        <br>
        <div class="form-group">
          <label for="city">City:</label>
          <br>
          <input type="text" name="city" class="form-control" id="city" placeholder="City" required/>
        </div>
        <br>
        <div class="form-group">
          <label for="province">Province:</label>
          <br>
          <input type="text" name="province" class="form-control" id="province" placeholder="Province" required/>
        </div>
        <br>
        <div class="form-group">
          <label for="type">Type:</label>
          <br>
          <input type="text" name="type" class="form-control" id="type" placeholder="Type" required/>
        </div>
        <br>
        <div class="form-group">
          <label for="phoneNumber">Phone Number:</label>
          <br>
          <input type="tel" name="phoneNumber" class="form-control" id="phoneNumber" placeholder="Phone Number" required/>
        </div>
        <br>
        <div class="form-group">
          <label for="capacity">Capacity:</label>
          <br>
          <input type="number" name="capacity" class="form-control" id="capacity" placeholder="Capacity" required/>
        </div>
        <br>
        <div class="form-group">
          <label for="webAddress">Website:</label>
          <br>
          <input type="text" name="webAddress" class="form-control" id="webAddress" placeholder="Website" required/>
        </div>
        <br>
        <div class="form-group">
          <label for="managerSSN">Manager:</label>
          <br>
          <input type="text" name="managerSSN" class="form-control" id="managerSSN" placeholder="Manager ID" required/>
        </div>

        <button type="submit" name="action" class="create">Add Facility</button>
        <button class="cancel" onclick="window.location.href='/Facility'">Cancel</button>
    </form>
        </div>
        <!-- CONTENT END-->

<?php include 'app/views/Common/footer.php' ?>
