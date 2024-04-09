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
                            <td>
                                <?= htmlspecialchars($infection->SSN) ?>
                            </td>
                            <td>
                                <?= htmlspecialchars($infection->type) ?>
                            </td>
                            <td>
                                <?= htmlspecialchars($infection->date) ?>
                            </td>
                            <td>
                                <form action="/Infection/Edit" method="post" style="display: inline;">
                                    <input type="hidden" name="SSN" value="<?= htmlspecialchars($infection->SSN) ?>">
                                    <input type="hidden" name="type" value="<?= htmlspecialchars($infection->type) ?>">
                                    <input type="hidden" name="date" value="<?= htmlspecialchars($infection->date) ?>">
                                    <button type="submit" class="buttonMod">Edit</button>
                                </form>
                                <form action="/Infection/Delete" method="post" style="display: inline;"
                                    onsubmit="return confirm('Are you sure you want to delete this infection?');">
                                    <input type="hidden" name="SSN" value="<?= htmlspecialchars($infection->SSN) ?>">
                                    <input type="hidden" name="type" value="<?= htmlspecialchars($infection->type) ?>">
                                    <input type="hidden" name="date" value="<?= htmlspecialchars($infection->date) ?>">
                                    <button type="submit" class="buttonMod">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php }
                } ?>
            </tbody>
        </table>
    </div>
</div>
<!-- CONTENT END-->

<?php include 'app/views/Common/footer.php'; ?>