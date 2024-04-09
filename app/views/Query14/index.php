<?php include 'app/views/Common/header.php'; ?>

<link href="../../../css/HomePage.css" rel="stylesheet" type="text/css" />
<link href="../../../css/Connections.css" rel="stylesheet" type="text/css" />

<div class="content">
    <h3 class="content-header">Query 14</h3>
    </div>
<br>
<p>For facility: CLSC Deevy. Employees who have at least three secondary residences and who have been on schedule to work in the last four weeks.</p>
    <!-- Modified Table Format for queries9 using Employee Table Styles -->
    <div class="employee-list-container">
        <table class="employee-list-table">
            <thead>
                <tr>
                    <th>SSN</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Role</th>
                    <th>Number Of Secondary Residences</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($data)): ?>
                    <tr>
                        <td colspan="14" style="text-align: center;">No records found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($data as $query14): ?>
                        <tr>
                            <td><?= htmlspecialchars($query14->SSN) ?></td>
                            <td><?= htmlspecialchars($query14->firstName) ?></td>
                            <td><?= htmlspecialchars($query14->lastName) ?></td>
                            <td><?= htmlspecialchars($query14->role) ?></td>
                            <td><?= htmlspecialchars($query14->numberOfSecondaryResidences) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- CONTENT END -->

<?php include 'app/views/Common/footer.php'; ?>
