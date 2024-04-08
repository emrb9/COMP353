<?php include 'app/views/Common/header.php'; ?>

<link href="../../../css/edit.css" rel="stylesheet" type="text/css" />

<div class="content">
    <h3 class="content-header">Edit Person</h3>
    <div class="container">

        <?php
        // Extract person data from the passed $data array
        $person = $data['person']; // Adjust this line based on how data is actually passed to your view
        ?>

        <form action="/Person/EditAction" method="post" class="form-format">
            <input type="hidden" name="action" value="editperson">

            <input type="text" name="SSN" value="<?= htmlspecialchars($person->SSN) ?>" required>
            <input type="text" name="cellNumber" value="<?= htmlspecialchars($person->cellNumber) ?>" required>
            <input type="text" name="firstName" value="<?= htmlspecialchars($person->firstName) ?>" required>
            <input type="text" name="lastName" value="<?= htmlspecialchars($person->lastName) ?>" required>
            <input type="text" name="citizenship" value="<?= htmlspecialchars($person->citizenship) ?>" required>
            <input type="text" name="dateOfBirth" value="<?= htmlspecialchars($person->dateOfBirth) ?>" required>
            <input type="text" name="emailAddress" value="<?= htmlspecialchars($person->emailAddress) ?>" required>
            <input type="text" name="occupation" value="<?= htmlspecialchars($person->occupation) ?>" required>
            <br></br>
            <input class="buttonMod" type="submit" value="Save Changes">
            <button class="buttonMod" onclick="window.location.href='/Person'">Cancel</button>
        </form>
    </div>
</div>

<?php include 'app/views/Common/footer.php'; ?>