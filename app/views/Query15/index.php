<?php include 'app/views/Common/header.php'; ?>

<link href="../../../css/HomePage.css" rel="stylesheet" type="text/css" />
<link href="../../../css/Connections.css" rel="stylesheet" type="text/css" />

<div class="content">
    <h3 class="content-header">Query 15</h3>
    </div>
<br>
<p>Nurses who are currently working at two or more different facilities and have been infected by COVID-19 in the last two weeks.</p>
    <!-- Modified Table Format for queries9 using Employee Table Styles -->
    <div class="employee-list-container">
        <table class="employee-list-table">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>First Day</th>
                    <th>Birth Date</th>
                    <th>Email</th>
                    <th>Total Covid Infections</th>
                    <th>Total Vaccines</th>
                    <th>Total Hours Scheduled</th>
                    <th>Total Secondary Residences</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($data)): ?>
                    <tr>
                        <td colspan="14" style="text-align: center;">No records found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($data as $query15): ?>
                        <tr>
                            <td><?= htmlspecialchars($query15->firstName) ?></td>
                            <td><?= htmlspecialchars($query15->lastName) ?></td>
                            <td><?= htmlspecialchars($query15->firstDayOfWork) ?></td>
                            <td><?= htmlspecialchars($query15->dateOfBirth) ?></td>
                            <td><?= htmlspecialchars($query15->emailAddress) ?></td>
                            <td><?= htmlspecialchars($query15->totalCovidInfections) ?></td>
                            <td><?= htmlspecialchars($query15->totalVaccines) ?></td>
                            <td><?= htmlspecialchars($query15->totalHoursScheduled) ?></td>
                            <td><?= htmlspecialchars($query15->totalSecondaryResidences) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- CONTENT END -->

<?php include 'app/views/Common/footer.php'; ?>
