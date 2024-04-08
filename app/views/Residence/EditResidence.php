<?php include 'app/views/Common/header.php'; ?>

<link href="../../../css/edit.css" rel="stylesheet" type="text/css" />

<div class="content">
    <h3 class="content-header">Edit Residence</h3>
    <div class="container">

        <?php
        // Extract residence data from the passed $data array
        $residence = $data['residence']; // Adjust this line based on how data is actually passed to your view
        ?>

        <<form action="/Facility/EditAction" method="post" class="form-format">
            <input type="hidden" name="action" value="editresidence">
            <input type="text" name="address" value="<?= htmlspecialchars($residence->address) ?>" required>
            <input type="text" name="postalCode" value="<?= htmlspecialchars($residence->postalCode) ?>" required>
            <input type="text" name="city" value="<?= htmlspecialchars($residence->city) ?>" required>
            <input type="text" name="province" value="<?= htmlspecialchars($residence->province) ?>" required>
            <input type="text" name="type" value="<?= htmlspecialchars($residence->type) ?>" required>
            <input type="text" name="phoneNumber" value="<?= htmlspecialchars($residence->phoneNumber) ?>" required>
            <input type="text" name="bedroomNumber" value="<?= htmlspecialchars($residence->bedroomNumber) ?>" required>
            <br></br>
            <input class="buttonMod" type="submit" value="Save Changes">
            <button class="buttonMod" onclick="window.location.href='/Residence'">Cancel</button>
        </form>
    </div>
</div>

<?php include 'app/views/Common/footer.php'; ?>