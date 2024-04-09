<?php include 'app/views/Common/header.php'; ?>

<link href="../../../css/HomePage.css" rel="stylesheet" type="text/css" />
<link href="../../../css/Connections.css" rel="stylesheet" type="text/css" />

<div class="content">
    <h3 class="content-header">Query 11</h3>
    </div>
<br>
<p>For employee: 127185305</p>
    <!-- Modified Table Format for queries9 using Employee Table Styles -->
    <div class="employee-list-container">
        <table class="employee-list-table">
            <thead>
                <tr>
                    <th>Address</th>
                    <th>Postal Code</th>
                    <th>Type</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Occupation</th>
                    <th>Relationship</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($data)): ?>
                    <tr>
                        <td colspan="14" style="text-align: center;">No records found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($data as $query11): ?>
                        <tr>
                            <td><?= htmlspecialchars($query11->address) ?></td>
                            <td><?= htmlspecialchars($query11->postalCode) ?></td>
                            <td><?= htmlspecialchars($query11->type) ?></td>
                            <td><?= htmlspecialchars($query11->firstName) ?></td>
                            <td><?= htmlspecialchars($query11->lastName) ?></td>
                            <td><?= htmlspecialchars($query11->occupation) ?></td>
                            <td><?= htmlspecialchars($query11->relationship) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- CONTENT END -->

<?php include 'app/views/Common/footer.php'; ?>
