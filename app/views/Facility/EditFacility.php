<?php include 'app/views/Common/header.php'; ?>

<link href="../../../css/edit.css" rel="stylesheet" type="text/css" />

<div class="content">
    <h3 class="content-header">Edit Facility</h3>
    <div class="container">

        <?php
        // Extract facility data from the passed $data array
        $facility = $data['facility']; // Adjust this line based on how data is actually passed to your view
        ?>

        <form action="/Facility/EditAction/<?= $facility->id ?>" method="post" class="form-format">
            <input type="hidden" name="action" value="editfacility">
            <input type="text" name="name" value="<?= htmlspecialchars($facility->name) ?>" required>
            <input type="text" name="address" value="<?= htmlspecialchars($facility->address) ?>" required>
            <input type="text" name="postalCode" value="<?= htmlspecialchars($facility->postalCode) ?>" required>
            <input type="text" name="city" value="<?= htmlspecialchars($facility->city) ?>" required>
            <input type="text" name="province" value="<?= htmlspecialchars($facility->province) ?>" required>
            <input type="text" name="type" value="<?= htmlspecialchars($facility->type) ?>" required>
            <input type="text" name="phoneNumber" value="<?= htmlspecialchars($facility->phoneNumber) ?>" required>
            <input type="text" name="capacity" value="<?= htmlspecialchars($facility->capacity) ?>" required>
            <input type="text" name="webAddress" value="<?= htmlspecialchars($facility->webAddress) ?>" required>
            <input type="text" name="managerSSN" value="<?= htmlspecialchars($facility->managerSSN) ?>" required>
            <br></br>
            <input class="buttonMod" type="submit" value="Save Changes">
            <button class="buttonMod" onclick="window.location.href='/Facility'">Cancel</button>
        </form>
    </div>
</div>

<?php include 'app/views/Common/footer.php'; ?>