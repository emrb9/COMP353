<?php include 'app/views/Common/header.php'; ?>

<link href="../../../css/HomePage.css" rel="stylesheet" type="text/css" />
<link href="../../../css/Connections.css" rel="stylesheet" type="text/css" />

<div class="content">
    <h3 class="content-header">Facilities</h3>
    <div class="addPlacement">
        <button class="buttonMod"><a href="/Facility/Add">Add Facility</a></button>
    </div>
    
    <!-- Modified Table Format for Facilities using Employee Table Styles -->
    <div class="employee-list-container">
        <table class="employee-list-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Postal Code</th>
                    <th>City</th>
                    <th>Province</th>
                    <th>Phone Number</th>
                    <th>Website</th>
                    <th>Type</th>
                    <th>Capacity</th>
                    <th>Manager</th>
                    <th>Employee Count</th>
                    <th>Doctor Count</th>
                    <th>Nurse Count</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (is_array($data)) {
                    foreach ($data as $facility) { ?>
                        <tr>
                            <td><?= htmlspecialchars($facility->facilityName) ?></td>
                            <td><?= htmlspecialchars($facility->address) ?></td>
                            <td><?= htmlspecialchars($facility->postalCode) ?></td>
                            <td><?= htmlspecialchars($facility->city) ?></td>
                            <td><?= htmlspecialchars($facility->province) ?></td>
                            <td><?= htmlspecialchars($facility->phoneNumber) ?></td>
                            <td><?= htmlspecialchars($facility->$webAddress) ?></td>
                            <td><?= htmlspecialchars($facility->type) ?></td>
                            <td><?= htmlspecialchars($facility->capacity) ?></td>
                            <td><?= htmlspecialchars($facility->generalManagerName) ?></td>
                            <td><?= htmlspecialchars($facility->numberOfEmployees) ?></td>
                            <td><?= htmlspecialchars($facility->numberOfDoctors) ?></td>
                            <td><?= htmlspecialchars($facility->numberOfNurses) ?></td>
                            <td>
                            <?php if (!$this->amFollowing($facility->id)) { ?>
                                <button type="button" class="buttonMod"><a href="/Facility/Follow/<?= $facility->id ?>">Follow</a></button>
                            <?php } else { ?>
                                <button type="button" class="buttonMod"><a href="/Facility/Unfollow/<?= $facility->id ?>">Unfollow</a></button>
                            <?php } ?>
                            <?php if ($this->amCreator($facility->id)) { ?>
                                <button type="button" class="buttonMod"><a href="/Facility/Edit/<?= $facility->id ?>">Edit</a></button>
                                <button type="button" class="buttonMod"><a href="/Facility/Delete/<?= $facility->id ?>">Delete</a></button>
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