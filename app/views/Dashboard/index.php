<?php include 'app/views/Common/header.php'; ?>
<link rel="stylesheet" href="/css/dashboard.css"> 
<div class="dashboard-container">
    <h1 class="dashboard-header">Dashboard Overview</h1>
    <div class="dashboard-content">
        <div class="dashboard-item">
            <h2>Active Employees</h2>
            <p class="dashboard-number">120</p> <!-- Dynamic data here -->
        </div>
        <div class="dashboard-item">
            <h2>Current Infection Cases</h2>
            <p class="dashboard-number">5</p> <!-- Dynamic data here -->
        </div>
        <div class="dashboard-item">
            <h2>Vaccination Status</h2>
            <div class="vaccination-status">
                <span>First Dose: 95%</span>
                <span>Second Dose: 90%</span>
            </div>
        </div>
        <div class="dashboard-item">
            <h2>Upcoming Schedules</h2>
            <p class="dashboard-number">8</p> <!-- Dynamic data here -->
        </div>
    </div>
</div>

<?php include 'app/views/Common/footer.php'; ?>