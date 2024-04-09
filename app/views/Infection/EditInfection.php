<?php include 'app/views/Common/header.php'; ?>

<link href="../../../css/edit.css" rel="stylesheet" type="text/css" />

<div class="content">
    <h3 class="content-header">Edit Infection</h3>
    <div class="container">

        <?php
        // Extract infection data from the passed $data array
        $infection = $data['infection']; // Adjust this line based on how data is actually passed to your view
        ?>

        <form action="/Infection/EditAction" method="post" class="form-format">
            <input type="hidden" name="action" value="editinfection">
            <input type="text" name="SSN" value="<?= htmlspecialchars($infection->SSN) ?>" required>
            <input type="text" name="type" value="<?= htmlspecialchars($infection->type) ?>" required>
            <input type="text" name="date" value="<?= htmlspecialchars($infection->date) ?>" required>
            <br></br>
            <input class="buttonMod" type="submit" value="Save Changes">
            <button class="buttonMod" onclick="window.location.href='/Infection'">Cancel</button>
        </form>
    </div>
</div>

<?php include 'app/views/Common/footer.php'; ?>