<?php include 'app/views/Common/header.php'; ?>

<link href="../../../css/edit.css" rel="stylesheet" type="text/css" />

<div class="content">
    <h3 class="content-header">Edit Schedule</h3>
    <div class="container">

        <?php
        // Extract schedule data from the passed $data array
        $schedule = $data['schedule']; // Adjust this line based on how data is actually passed to your view
        ?>

        <form action="/Schedule/EditAction" method="post" class="form-format">
            <input type="hidden" name="action" value="editschedule">
            <input type="text" name="SSN" value="<?= htmlspecialchars($schedule->SSN) ?>" required>
            <input type="text" name="address" value="<?= htmlspecialchars($schedule->address) ?>" required>
            <input type="text" name="postalCode" value="<?= htmlspecialchars($schedule->postalCode) ?>" required>
            <input type="text" name="startTime" value="<?= htmlspecialchars($schedule->startTime) ?>" required>
            <input type="text" name="endTime" value="<?= htmlspecialchars($schedule->endTime) ?>" required>
            <input type="text" name="date" value="<?= htmlspecialchars($schedule->date) ?>" required>
            <br></br>
            <input class="buttonMod" type="submit" value="Save Changes">
            <button class="buttonMod" onclick="window.location.href='/Schedule'">Cancel</button>
        </form>
    </div>
</div>

<?php include 'app/views/Common/footer.php'; ?>