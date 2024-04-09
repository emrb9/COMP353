<?php include 'app/views/Common/header.php'; ?>

<link href="../../../css/HomePage.css" rel="stylesheet" type="text/css" />
<link href="../../../css/Connections.css" rel="stylesheet" type="text/css" />

<div class="content">
    <h3 class="content-header">Query 12</h3>
    </div>
<br>
<p>For doctors who have been infected by COVID-19 in the past two weeks.</p>
    <!-- Modified Table Format for queries9 using Employee Table Styles -->
    <div class="employee-list-container">
        <table class="employee-list-table">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Infection Date</th>
                    <th>Facility Name</th>
                    <th>Secondary Residence Count</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($data)): ?>
                    <tr>
                        <td colspan="14" style="text-align: center;">No records found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($data as $query12): ?>
                        <tr>
                            <td><?= htmlspecialchars($query12->firstName) ?></td>
                            <td><?= htmlspecialchars($query12->lastName) ?></td>
                            <td><?= htmlspecialchars($query12->infectionDate) ?></td>
                            <td><?= htmlspecialchars($query12->facilityName) ?></td>
                            <td><?= htmlspecialchars($query12->numberOfSecondaryResidences) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- CONTENT END -->

<?php include 'app/views/Common/footer.php'; ?>
