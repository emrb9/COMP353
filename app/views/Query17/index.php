<?php include 'app/views/Common/header.php'; ?>

<link href="../../../css/HomePage.css" rel="stylesheet" type="text/css" />
<link href="../../../css/Connections.css" rel="stylesheet" type="text/css" />

<div class="content">
    <h3 class="content-header">Query 17</h3>
    </div>
<br>
<p>Total number of employees currently working in the facilities, and the total number of employees who have never been infected by COVID-19.</p>
    <!-- Modified Table Format for queries9 using Employee Table Styles -->
    <div class="employee-list-container">
        <table class="employee-list-table">
            <thead>
                <tr>
                    <th>Role</th>
                    <th>Total Currently Working</th>
                    <th>Total Never Infected </th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($data)): ?>
                    <tr>
                        <td colspan="14" style="text-align: center;">No records found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($data as $query17): ?>
                        <tr>
                            <td><?= htmlspecialchars($query17->role) ?></td>
                            <td><?= htmlspecialchars($query17->totalCurrentlyWorking) ?></td>
                            <td><?= htmlspecialchars($query17->totalNeverInfected) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- CONTENT END -->

<?php include 'app/views/Common/footer.php'; ?>
