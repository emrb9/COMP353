<?php include 'app/views/Common/header.php'; ?>

<link href="../../../css/HomePage.css" rel="stylesheet" type="text/css" />
<link href="../../../css/Connections.css" rel="stylesheet" type="text/css" />

<div class="content">
    <h3 class="content-header">Schedules</h3>
    <div class="addPlacement">
        <button class="buttonMod"><a href="/Schedule/Add">Add Schedule</a></button>
    </div>

    <!-- Modified Table Format for Facilities using Employee Table Styles -->
    <div class="employee-list-container">
        <table class="employee-list-table">
            <thead>
                <tr>
                    <th>SSN</th>
                    <th>Address</th>
                    <th>Postal Code</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (is_array($data)) {
                    foreach ($data as $schedule) { ?>
                        <tr>
                            <td>
                                <?= htmlspecialchars($schedule->SSN) ?>
                            </td>
                            <td>
                                <?= htmlspecialchars($schedule->address) ?>
                            </td>
                            <td>
                                <?= htmlspecialchars($schedule->postalCode) ?>
                            </td>
                            <td>
                                <?= htmlspecialchars($schedule->startTime) ?>
                            </td>
                            <td>
                                <?= htmlspecialchars($schedule->endTime) ?>
                            </td>
                            <td>
                                <?= htmlspecialchars($schedule->date) ?>
                            </td>
                            <td>
                                <form action="/Schedule/Edit" method="post" style="display: inline;">
                                    <input type="hidden" name="SSN" value="<?= htmlspecialchars($schedule->SSN) ?>">
                                    <input type="hidden" name="address" value="<?= htmlspecialchars($schedule->address) ?>">
                                    <input type="hidden" name="postalCode" value="<?= htmlspecialchars($schedule->postalCode) ?>">
                                    <input type="hidden" name="startTime" value="<?= htmlspecialchars($schedule->startTime) ?>">
                                    <input type="hidden" name="date" value="<?= htmlspecialchars($schedule->date) ?>">
                                    <button type="submit" class="buttonMod">Edit</button>
                                </form>
                                <form action="/Schedule/Delete" method="post" style="display: inline;"
                                    onsubmit="return confirm('Are you sure you want to delete this schedule?');">
                                    <input type="hidden" name="SSN" value="<?= htmlspecialchars($schedule->SSN) ?>">
                                    <input type="hidden" name="address" value="<?= htmlspecialchars($schedule->address) ?>">
                                    <input type="hidden" name="postalCode" value="<?= htmlspecialchars($schedule->postalCode) ?>">
                                    <input type="hidden" name="startTime" value="<?= htmlspecialchars($schedule->startTime) ?>">
                                    <input type="hidden" name="date" value="<?= htmlspecialchars($schedule->date) ?>">
                                    <button type="submit" class="buttonMod">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php }
                } ?>
            </tbody>
        </table>
    </div>
</div>
<!-- CONTENT END-->

<?php include 'app/views/Common/footer.php'; ?>