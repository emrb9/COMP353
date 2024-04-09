<?php include 'app/views/Common/header.php'; ?>

<link href="../../../css/HomePage.css" rel="stylesheet" type="text/css" />
<link href="../../../css/Connections.css" rel="stylesheet" type="text/css" />

<div class="content">
    <h3 class="content-header">Query 18</h3>
    </div>
<br>
<p>For all provinces, give the total number of facilities, the total number of employees currently working.</p>
    <!-- Modified Table Format for queries9 using Employee Table Styles -->
    <div class="employee-list-container">
        <table class="employee-list-table">
            <thead>
                <tr>
                    <th>Province</th>
                    <th>Facility</th>
                    <th>Working Employees</th>
                    <th>Working Infected</th>
                    <th>Total Capacity</th>
                    <th>Total Hours</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($data)): ?>
                    <tr>
                        <td colspan="14" style="text-align: center;">No records found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($data as $query18): ?>
                        <tr>
                            <td><?= htmlspecialchars($query18->province) ?></td>
                            <td><?= htmlspecialchars($query18->facilities) ?></td>
                            <td><?= htmlspecialchars($query18->workingEmployees) ?></td>
                            <td><?= htmlspecialchars($query18->workingInfected) ?></td>
                            <td><?= htmlspecialchars($query18->totalCapacity) ?></td>
                            <td><?= htmlspecialchars($query18->totalHours) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- CONTENT END -->

<?php include 'app/views/Common/footer.php'; ?>
