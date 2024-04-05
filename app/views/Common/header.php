<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HFESTS</title>
    <link href="../../../css/HeaderAndFooter.css" rel="stylesheet" type="text/css" />
    <link href="../../../css/HomePage.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../../../css/font-awesome.min.css">
</head>

<body>
    <header>
        <a href="/Home/"><img class="logo" src="../../../assets/logo.png" alt="HFESTS Logo" width="100px" height="100px" style="float:left"></a>
        <input type="checkbox" id="nav-toggle" class="nav-toggle">
        <nav>
            <ul>
                <li><a href="/Home/">HOME</a></li>
                <li><a href="/Management/">MANAGEMENT▾</a>
                    <div class="dropdown">
                        <ul>
                            <li><a href="/Person/">Persons</a></li>
                            <li><a href="/Employee/">Employees</a></li>
                            <li><a href="/Facility/">Facilities</a></li>
                            <li><a href="/Residence/">Residences</a></li>
                        </ul>
                    </div>
                </li>
                <li><a href="/Records/">RECORDS▾</a>
                    <div class="dropdown">
                        <ul>
                            <li><a href="/Vaccination/">Vaccinations</a></li>
                            <li><a href="/Infection/">Infections</a></li>
                        </ul>
                    </div>
                </li>
                <li><a href="/Scheduling/">SCHEDULING▾</a>
                    <div class="dropdown">
                        <ul>
                            <li><a href="/Job/">Schedule</a></li>
                            <li><a href="/Notification/">Notification</a></li>
                        </ul>
                    </div>
                </li>
                <li> <a href="/Chat/">REPORTS</a></li>
                <li> <a href="/Profile/">USER▾</a>
                    <div class="dropdown">
                        <ul>
                            <li><a href="/Setting/">Settings</a></li>
                            <?php if (isset($_SESSION['user_id'])) echo '<li><a href="/Home/Logout">Sign Out</a></li>' ?>
                        </ul>
                    </div>
                </li>
                <?php
                if (isset($_SESSION['user_id'])) {
                    if ($_SESSION['u_type'] == 3) {
                        echo '
                            <li><a href="/Admin/">ADMIN</a></li>
                            ';
                    }
                }
                ?>
            </ul>
        </nav>
        <label for="nav-toggle" class="nav-toggle-label">
            <span></span>
        </label>
    </header>