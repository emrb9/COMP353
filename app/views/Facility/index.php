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
                <?php if (empty($data)): ?>
                    <tr>
                        <td colspan="14" style="text-align: center;">No facilities found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($data as $facility): ?>
                        <tr>
                            <td><?= htmlspecialchars($facility->facilityName) ?></td>
                            <td><?= htmlspecialchars($facility->address) ?></td>
                            <td><?= htmlspecialchars($facility->postalCode) ?></td>
                            <td><?= htmlspecialchars($facility->city) ?></td>
                            <td><?= htmlspecialchars($facility->province) ?></td>
                            <td><?= htmlspecialchars($facility->phoneNumber) ?></td>
                            <td><?= htmlspecialchars($facility->webAddress) ?></td>
                            <td><?= htmlspecialchars($facility->type) ?></td>
                            <td><?= htmlspecialchars($facility->capacity) ?></td>
                            <td><?= htmlspecialchars($facility->generalManagerName) ?></td>
                            <td><?= htmlspecialchars($facility->numberOfEmployees) ?></td>
                            <td><?= htmlspecialchars($facility->numberOfDoctors) ?></td>
                            <td><?= htmlspecialchars($facility->numberOfNurses) ?></td>
                            <td>
                                <form action="/Facility/Edit" method="post" style="display: inline;">
                                    <input type="hidden" name="address" value="<?= htmlspecialchars($facility->address) ?>">
                                    <input type="hidden" name="postalCode" value="<?= htmlspecialchars($facility->postalCode) ?>">
                                    <button type="submit" class="buttonMod">Edit</button>
                                </form>
                                <form action="/Facility/Delete" method="post" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this facility?');">
                                    <input type="hidden" name="address" value="<?= htmlspecialchars($facility->address) ?>">
                                    <input type="hidden" name="postalCode" value="<?= htmlspecialchars($facility->postalCode) ?>">
                                    <button type="submit" class="buttonMod">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- CONTENT END -->

<?php include 'app/views/Common/footer.php'; ?>
