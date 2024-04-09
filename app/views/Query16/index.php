<?php include 'app/views/Common/header.php'; ?>

<link href="../../../css/HomePage.css" rel="stylesheet" type="text/css" />
<link href="../../../css/Connections.css" rel="stylesheet" type="text/css" />

<div class="content">
    <h3 class="content-header">Query 16</h3>
    </div>
<br>
<p>Total number of employees currently infected by COVID-19.</p>
    <!-- Modified Table Format for queries9 using Employee Table Styles -->
    <div class="employee-list-container">
        <table class="employee-list-table">
            <thead>
                <tr>
                    <th>Role</th>
                    <th>Total Employees</th>
                    <th>Total Current Infections</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($data)): ?>
                    <tr>
                        <td colspan="14" style="text-align: center;">No records found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($data as $query16): ?>
                        <tr>
                            <td><?= htmlspecialchars($query16->role) ?></td>
                            <td><?= htmlspecialchars($query16->totalEmployees) ?></td>
                            <td><?= htmlspecialchars($query16->totalCurrentInfections) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- CONTENT END -->

<?php include 'app/views/Common/footer.php'; ?>
