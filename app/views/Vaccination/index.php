<?php include 'app/views/Common/header.php'; ?>

<link href="../../../css/HomePage.css" rel="stylesheet" type="text/css" />
<link href="../../../css/Connections.css" rel="stylesheet" type="text/css" />

<div class="content">
    <h3 class="content-header">Vaccinations</h3>
    <div class="addPlacement">
        <button class="buttonMod"><a href="/Vaccination/Add">Add Vaccination</a></button>
    </div>
    
    <!-- Modified Table Format for Facilities using Employee Table Styles -->
    <div class="employee-list-container">
        <table class="employee-list-table">
            <thead>
                <tr>
                    <th>SSN</th>
                    <th>Dose Number</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Address</th>
                    <th>Postal Code</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (is_array($data)) {
                    foreach ($data as $vaccination) { ?>
                        <tr>
                            <td><?= htmlspecialchars($vaccination->SSN) ?></td>
                            <td><?= htmlspecialchars($vaccination->doseNumber) ?></td>
                            <td><?= htmlspecialchars($vaccination->type) ?></td>
                            <td><?= htmlspecialchars($vaccination->date) ?></td>
                            <td><?= htmlspecialchars($vaccination->address) ?></td>
                            <td><?= htmlspecialchars($vaccination->postalCode) ?></td>
                            <td>
                            <?php if ($this->amCreator($vaccination->id)) { ?>
                                <button type="button" class="buttonMod"><a href="/Vaccination/Edit/<?= $vaccination->id ?>">Edit</a></button>
                                <button type="button" class="buttonMod"><a href="/Vaccination/Delete/<?= $vaccination->id ?>">Delete</a></button>
                            <?php } ?>
                        </td>
                    </tr>
            <?php   }
            } ?>
        </tbody>
    </table>
</div>
</div>
<!-- CONTENT END-->

<?php include 'app/views/Common/footer.php'; ?>