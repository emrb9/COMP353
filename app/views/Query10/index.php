<?php include 'app/views/Common/header.php'; ?>

<link href="../../../css/HomePage.css" rel="stylesheet" type="text/css" />
<link href="../../../css/Connections.css" rel="stylesheet" type="text/css" />

<div class="content">
    <h3 class="content-header">Query 10</h3>
    </div>
<br>
<p>For employee: 456024090 during period 2016-04-01 - 2023-04-30</p>
    <!-- Modified Table Format for queries9 using Employee Table Styles -->
    <div class="employee-list-container">
        <table class="employee-list-table">
            <thead>
                <tr>
                    <th>SSN</th>
                    <th>Full Name</th>
                    <th>Facility Name</th>
                    <th>Day of the Year</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($data)): ?>
                    <tr>
                        <td colspan="14" style="text-align: center;">No records found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($data as $query10): ?>
                        <tr>
                            <td><?= htmlspecialchars($query10->employeeSSN) ?></td>
                            <td><?= htmlspecialchars($query10->employeeFullName) ?></td>
                            <td><?= htmlspecialchars($query10->facilityName) ?></td>
                            <td><?= htmlspecialchars($query10->dayOfYear) ?></td>
                            <td><?= htmlspecialchars($query10->startTime) ?></td>
                            <td><?= htmlspecialchars($query10->endTime) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- CONTENT END -->

<?php include 'app/views/Common/footer.php'; ?>
