<?php include 'app/views/Common/header.php'; ?>

<link href="../../../css/HomePage.css" rel="stylesheet" type="text/css" />
<link href="../../../css/Connections.css" rel="stylesheet" type="text/css" />

<div class="content">
    <h3 class="content-header">Persons</h3>
    <div class="addPlacement">
        <button class="buttonMod"><a href="/Person/Add">Add Person</a></button>
    </div>
    
    <!-- Modified Table Format for Facilities using Employee Table Styles -->
    <div class="employee-list-container">
        <table class="employee-list-table">
            <thead>
                <tr>
                    <th>SSN</th>
                    <th>Phone Number</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Citizenship</th>
                    <th>Date of Birth</th>
                    <th>Email Address</th>
                    <th>Occupation</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (is_array($data)) {
                    foreach ($data as $person) { ?>
                        <tr>
                            <td><?= htmlspecialchars($person->SSN) ?></td>
                            <td><?= htmlspecialchars($person->cellNumber) ?></td>
                            <td><?= htmlspecialchars($person->firstName) ?></td>
                            <td><?= htmlspecialchars($person->lastName) ?></td>
                            <td><?= htmlspecialchars($person->citizenship) ?></td>
                            <td><?= htmlspecialchars($person->dateOfBirth) ?></td>
                            <td><?= htmlspecialchars($person->emailAddress) ?></td>
                            <td><?= htmlspecialchars($person->occupation) ?></td>
                            <td>
                            <?php if ($this->amCreator($person->id)) { ?>
                                <button type="button" class="buttonMod"><a href="/Person/Edit/<?= $person->id ?>">Edit</a></button>
                                <button type="button" class="buttonMod"><a href="/Person/Delete/<?= $person->id ?>">Delete</a></button>
                            <?php } ?>
                        </td>
                    </tr>
            <?php   }
            } ?>
        </tbody>
    </table>
</div>
</div>
<!-- CONTENT END-->

<?php include 'app/views/Common/footer.php'; ?>