<?php include 'app/views/Common/header.php'; ?>

<link href="../../../css/Connections.css" rel="stylesheet" type="text/css" />

<div class="content">
    <h3 class="content-header">Employees</h3>
    <div class="search-filter-sort">
        <input type="text" id="searchBox" onkeyup="searchFunction()" placeholder="Search employees...">
        <!-- Additional filters can be implemented as needed -->
    </div>
    <div class="employeeFormCenter">
        <button class="buttonMod" onclick="openForm()">Add Employee</button>
        <div id="employeeForm" style="display:none;">
            <form action="/Employee/save" method="post">
                <input type="hidden" name="SSN" id="employeeSSN">

                <div class="form-row">
                    <div class="form-group">
                        <label for="firstName">First Name:</label>
                        <input type="text" id="firstName" name="firstName" required>
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name:</label>
                        <input type="text" id="lastName" name="lastName" required>
                    </div>
                </div>

                <!-- Repeat for other fields -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="role">Role:</label>
                        <input type="text" id="role" name="role" required>
                    </div>
                    <div class="form-group">
                        <label for="vaccinationType">Vaccination Type:</label>
                        <input type="text" id="vaccinationType" name="vaccinationType">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="doseNumber">Dose Number:</label>
                        <input type="text" id="doseNumber" name="doseNumber">
                    </div>
                    <div class="form-group">
                        <label for="vaccinationDate">Vaccination Date:</label>
                        <input type="text" id="vaccinationDate" name="vaccinationDate">
                    </div>
                </div>

                <br></br>

                <button class="buttonMod" type="submit">Save Employee</button>
                <button class="buttonMod" type="button" onclick="closeForm()">Cancel</button>
            </form>
        </div>
    </div>

    <div class="employee-list-container">
        <?php if (is_array($data) && !empty($data)) { ?>
            <table class="employee-list-table">
                <thead>
                    <tr>
                        <th>Employee SSN</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Role</th>
                        <th>Vaccination Type</th>
                        <th>Dose Number</th>
                        <th>Vaccination Date</th>
                        <th> Manage </th>
                        <!-- Add other columns as needed -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $datum) { ?>
                        <tr>
                            <td>
                                <?= htmlspecialchars($datum->SSN) ?>
                            </td>
                            <td>
                                <?= htmlspecialchars($datum->firstName) ?>
                            </td>
                            <td>
                                <?= htmlspecialchars($datum->lastName) ?>
                            </td>
                            <td>
                                <?= htmlspecialchars($datum->role) ?>
                            </td>
                            <td>
                                <?= htmlspecialchars($datum->vaccinationType) ?>
                            </td>
                            <td>
                                <?= htmlspecialchars($datum->doseNumber) ?>
                            </td>
                            <td>
                                <?= htmlspecialchars($datum->vaccinationDate) ?>
                            </td>
                            <td>
                                <button class="buttonMod"
                                    onclick="openForm('<?= $datum->SSN ?>', '<?= htmlspecialchars($datum->firstName) ?>', '<?= htmlspecialchars($datum->lastName) ?>', '<?= htmlspecialchars($datum->role) ?>', '<?= htmlspecialchars($datum->vaccinationType) ?>', '<?= htmlspecialchars($datum->doseNumber) ?>', '<?= htmlspecialchars($datum->vaccinationDate) ?>')">Edit</button>
                                <button class="buttonMod" onclick="confirmDelete('<?= $datum->SSN ?>')">Delete</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>No employees found.</p>
        <?php } ?>
    </div>
</div>
<script>
    function searchFunction() {
        let input, filter, table, tr, td, i, j, txtValue, found;
        input = document.getElementById("searchBox");
        filter = input.value.toUpperCase();
        table = document.getElementsByClassName("employee-list-table")[0];
        tr = table.getElementsByTagName("tr");

        // Start loop from 1 to skip the header row
        for (i = 1; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td");
            found = false;
            // Loop through all columns of the current row
            for (j = 0; j < td.length; j++) {
                if (td[j]) {
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        found = true; // Mark this row as found
                        break; // Stop searching through more columns
                    }
                }
            }
            // Show or hide the row based on the search result
            if (found) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none"; // Hide rows that don't match
            }
        }
    }

    function openForm(SSN = '', firstName = '', lastName = '', role = '', vaccinationType = '', doseNumber = '', vaccinationDate = '') {
        document.getElementById('employeeForm').style.display = 'block';
        // Populate the form if details are provided (for editing)
        document.getElementById('employeeSSN').value = SSN;
        document.getElementById('firstName').value = firstName;
        document.getElementById('lastName').value = lastName;
        document.getElementById('role').value = role;
        document.getElementById('vaccinationType').value = vaccinationType;
        document.getElementById('doseNumber').value = doseNumber;
        document.getElementById('vaccinationDate').value = vaccinationDate;
    }

    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('employeeForm').querySelector('form');

        form.onsubmit = function (e) {
            e.preventDefault(); // Prevent the default form submission

            const formData = new FormData(form);

            fetch('/Employee/save', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Employee saved successfully');
                        closeForm();
                        // Optionally, refresh the employee list here
                    } else {
                        alert('Failed to save the employee');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error saving the employee.');
                });
        };
    });

    function closeForm() {
        document.getElementById('employeeForm').style.display = 'none';
        // Clear form fields or any additional actions on form close
    }

    function confirmDelete(SSN) {
        if (confirm('Are you sure you want to delete this employee?')) {
            fetch(`/Employee/delete/${SSN}`, {
                method: 'POST', // Assuming you've adjusted server-side to handle POST
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ SSN: SSN })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Assuming data.success is true when deletion is successful
                        alert('Employee deleted successfully');

                        // Example of removing the employee's row from the table
                        // This requires that each row in your table has an id attribute set to something like "employee-{SSN}"
                        var row = document.getElementById('employee-' + SSN);
                        if (row) {
                            row.parentNode.removeChild(row);
                        }

                        // Optionally, refresh the list or redirect if necessary
                        // location.reload(); // Be cautious with reloading; it might not offer the best user experience.
                    } else {
                        // Handle errors
                        alert('Failed to delete the employee. ' + (data.error || 'Unknown error occurred.'));
                    }
                })
                .catch(error => console.error('Error:', error));
        }

    }
</script>
<?php include 'app/views/Common/footer.php'; ?>