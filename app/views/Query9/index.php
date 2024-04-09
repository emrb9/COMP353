<?php include 'app/views/Common/header.php'; ?>

<link href="../../../css/HomePage.css" rel="stylesheet" type="text/css" />
<link href="../../../css/Connections.css" rel="stylesheet" type="text/css" />

<div class="content">
    <h3 class="content-header">Query 9</h3>
    </div>
<br>
<p>For facility: 56 Oak Grove Way</p>
    <!-- Modified Table Format for queries9 using Employee Table Styles -->
    <div class="employee-list-container">
        <table class="employee-list-table">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Start Date</th>
                    <th>Birth Date</th>
                    <th>Medicare</th>
                    <th>Phone Number</th>
                    <th>Primary Address</th>
                    <th>City</th>
                    <th>Province</th>
                    <th>Postal Code</th>
                    <th>Citizenship</th>
                    <th>Email Address</th>
                    <th>Secondary Residence Count</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($data)): ?>
                    <tr>
                        <td colspan="14" style="text-align: center;">No records found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($data as $query9): ?>
                        <tr>
                            <td><?= htmlspecialchars($query9->firstName) ?></td>
                            <td><?= htmlspecialchars($query9->lastName) ?></td>
                            <td><?= htmlspecialchars($query9->workStartDate) ?></td>
                            <td><?= htmlspecialchars($query9->dateOfBirth) ?></td>
                            <td><?= htmlspecialchars($query9->medicareNumber) ?></td>
                            <td><?= htmlspecialchars($query9->telephoneNumber) ?></td>
                            <td><?= htmlspecialchars($query9->primaryAddress) ?></td>
                            <td><?= htmlspecialchars($query9->city) ?></td>
                            <td><?= htmlspecialchars($query9->province) ?></td>
                            <td><?= htmlspecialchars($query9->primaryPostalCode) ?></td>
                            <td><?= htmlspecialchars($query9->citizenship) ?></td>
                            <td><?= htmlspecialchars($query9->emailAddress) ?></td>
                            <td><?= htmlspecialchars($query9->numSecondaryResidences) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- CONTENT END -->

<?php include 'app/views/Common/footer.php'; ?>
