<?php include 'app/views/Common/header.php' ?>

<link href="../../../css/MyProfile.css" rel="stylesheet" type="text/css" />
<link href="../../../css/edit.css" rel="stylesheet" type="text/css" />

<div class="content">
  <!--CONTENT START-->

  <h3 class="content-header">Edit Profile</h3>
  <div class="container">
    <section>
      <form class="form-format" method="post">
        <div class="form-group">
          <label for="fname">First Name:</label>
          <br>
          <input type="text" id="fname" name="fname" required />
        </div>
        <div class="form-group">
          <label for="lname">Last Name:</label>
          <br>
          <input type="text" id="lname" name="lname" required />
        </div>
        <div class="form-group">
          <label for="email">Email Address:</label>
          <br>
          <input type="email" id="email" name="email" required />
        </div>
        <div class="form-group">
          <label for="job">Job title:</label>
          <br>
          <input type="text" id="job" name="job" required />
        </div>
        <div class="form-group">
          <label for="skills">Skills:</label>
          <br>
          <input type="text" id="skills" name="skills" required />
        </div>
        <div class="form-group">
          <label for="about">About Me:</label>
          <br>
          <input type="text" id="about" name="about" required />
        </div>
        <div class="form-group">
          <label for="location">Location:</label>
          <br>
          <input type="text" id="location" name="location" required />
        </div>
        <input type="submit" name="action" value="Update Profile" class="confirm" />
      </form>
    </section>
  </div>
  <!-- CONTENT END-->

  <?php include 'app/views/Common/footer.php' ?>