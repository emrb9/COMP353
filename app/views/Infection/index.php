<?php include 'app/views/Common/header.php'; ?>

<link href="../../../css/HomePage.css" rel="stylesheet" type="text/css" />
<link href="../../../css/Connections.css" rel="stylesheet" type="text/css" />

<div class="content">
    <h3 class="content-header">Infections</h3>
    <div class="addPlacement">
        <button class="buttonMod"><a href="/Infection/Add">Add Infection</a></button>
    </div>
    
    <!-- Modified Table Format for Facilities using Employee Table Styles -->
    <div class="employee-list-container">
        <table class="employee-list-table">
            <thead>
                <tr>
                    <th>SSN</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (is_array($data)) {
                    foreach ($data as $infection) { ?>
                        <tr>
                            <td><?= htmlspecialchars($infection->SSN) ?></td>
                            <td><?= htmlspecialchars($infection->type) ?></td>
                            <td><?= htmlspecialchars($infection->date) ?></td>
                            <td>
                            <?php if ($this->amCreator($infection->id)) { ?>
                                <button type="button" class="buttonMod"><a href="/Infection/Edit/<?= $infection->id ?>">Edit</a></button>
                                <button type="button" class="buttonMod"><a href="/Infection/Delete/<?= $infection->id ?>">Delete</a></button>
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