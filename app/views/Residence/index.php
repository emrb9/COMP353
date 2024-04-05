<?php include 'app/views/Common/header.php'; ?>

<link href="../../../css/HomePage.css" rel="stylesheet" type="text/css" />
<link href="../../../css/Connections.css" rel="stylesheet" type="text/css" />

<div class="content">
    <h3 class="content-header">Residences</h3>
    <div class="addPlacement">
        <button class="buttonMod"><a href="/Residence/Add">Add Residence</a></button>
    </div>
    
    <!-- Modified Table Format for Facilities using Employee Table Styles -->
    <div class="employee-list-container">
        <table class="employee-list-table">
            <thead>
                <tr>
                    <th>Address</th>
                    <th>Postal Code</th>
                    <th>City</th>
                    <th>Province</th>
                    <th>Type</th>
                    <th>Phone Number</th>
                    <th>Bedrooms</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (is_array($data)) {
                    foreach ($data as $residence) { ?>
                        <tr>
                            <td><?= htmlspecialchars($residence->address) ?></td>
                            <td><?= htmlspecialchars($residence->postalCode) ?></td>
                            <td><?= htmlspecialchars($residence->city) ?></td>
                            <td><?= htmlspecialchars($residence->province) ?></td>
                            <td><?= htmlspecialchars($residence->type) ?></td>
                            <td><?= htmlspecialchars($residence->phoneNumber) ?></td>
                            <td><?= htmlspecialchars($residence->bedroomNumber) ?></td>
                            <td>
                            <?php if ($this->amCreator($residence->id)) { ?>
                                <button type="button" class="buttonMod"><a href="/Residence/Edit/<?= $residence->id ?>">Edit</a></button>
                                <button type="button" class="buttonMod"><a href="/Residence/Delete/<?= $residence->id ?>">Delete</a></button>
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