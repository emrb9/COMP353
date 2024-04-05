<?php include 'app/views/Common/header.php' ?>

    <div class="content">

        <!--CONTENT START-->
        <h3 class="content-header">Settings</h3>
        <form>
            <fieldset>
                <legend>General Settings</legend>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name"><br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email"><br>
                <label for="timezone">Timezone:</label>
                <select id="timezone" name="timezone">
                    <option value="-08:00">(GMT -8:00) Pacific Time (US &amp; Canada)</option>
                    <option value="-07:00">(GMT -7:00) Mountain Time (US &amp; Canada)</option>
                    <option value="-06:00">(GMT -6:00) Central Time (US &amp; Canada), Mexico City</option>
                    <option value="-05:00">(GMT -5:00) Eastern Time (US &amp; Canada), Bogota, Lima</option>
                    <option value="-04:00">(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz</option>
                </select><br>
                <label for="private-account">Make Account Private:</label>
                <input type="checkbox" id="private-account" name="private-account"><br>
            </fieldset>
            <br>
            <fieldset>
                <legend>Security Settings</legend>
                <label for="current-password">Current Password:</label>
                <input type="password" id="current-password" name="current-password"><br>
                <label for="new-password">New Password:</label>
                <input type="password" id="new-password" name="new-password"><br>
                <label for="confirm-password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm-password"><br>
            </fieldset>
            <br>
            <fieldset>
                <legend>Notification Settings</legend>
                <label for="email-notifications">Receive Email Notifications:</label>
                <input type="checkbox" id="email-notifications" name="email-notifications"><br>
                <label for="push-notifications">Receive Push Notifications:</label>
                <input type="checkbox" id="push-notifications" name="push-notifications"><br>
            </fieldset>
            <br>
            <input type="submit" value="Save Settings">
        </form>
    <!-- CONTENT END-->


<?php include 'app/views/Common/footer.php' ?>
