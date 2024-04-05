<?php include 'app/views/Common/header.php'; ?>

<link href="../../../css/edit.css" rel="stylesheet" type="text/css" />

<div class="content">
    <h3 class="content-header">Edit Vaccination</h3>
    <div class="container">

        <?php
        // Extract vaccination data from the passed $data array
        $vaccination = $data['vaccination']; // Adjust this line based on how data is actually passed to your view
        ?>

        <form action="/Vaccination/EditAction/<?= $vaccination->id ?>" method="post" class="form-format">
            <input type="hidden" name="action" value="editvaccination">
            <input type="text" name="SSN" value="<?= htmlspecialchars($vaccination->SSN) ?>" required>
            <input type="text" name="doseNumber" value="<?= htmlspecialchars($vaccination->doseNumber) ?>" required>
            <input type="text" name="type" value="<?= htmlspecialchars($vaccination->type) ?>" required>
            <input type="text" name="date" value="<?= htmlspecialchars($vaccination->date) ?>" required>
            <input type="text" name="address" value="<?= htmlspecialchars($vaccination->address) ?>" required>
            <input type="text" name="postalCode" value="<?= htmlspecialchars($vaccination->postalCode) ?>" required>
            <br></br>
            <input class="buttonMod" type="submit" value="Save Changes">
            <button class="buttonMod" onclick="window.location.href='/Vaccination'">Cancel</button>
        </form>
    </div>
</div>

<?php include 'app/views/Common/footer.php'; ?>