<?php include 'app/views/Common/header.php' ?>

<link href="../../../css/MyProfile.css" rel="stylesheet" type="text/css" />

<div class="content">
    <!--CONTENT START-->

    <h3 class="content-header">My Profile</h3>
    <section>
        <div class="row">
            <div class="col-sm-3">

                <div class="profile">
                    <img src="../../../assets/Connections/user-01.jpg" alt="Profile Picture">
                    <div class="buttons">
                        <a href="/Profile/Edit/"><button class="edit">Edit</button></a>
                        <?php if ($data->public == 0) { // my profile is private   ?>
                            <a href="/Profile/UpdateVisibility/1"><button type="button" id="makePublic"
                                    class="btn btn-lg btn-success">Make Public</button></a>
                        <?php } else { ?>
                            <a href="/Profile/UpdateVisibility/0"><button type="button" id="makePrivate"
                                    class="btn btn-lg btn-danger">Make Private</button></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-9 profile-details">
                <h1>
                    <?= $data->fname, ' ', $data->lname ?>
                </h1>
                <h3 class="subject">
                    <?= $data->job_title ?>
                </h3>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 skills">
                <h2>Location</h2>
                <p>
                    <?= $data->location ?>
                </p>
                <h2>Skills</h2>
                <ul>
                    <li>
                        <?= $data->skills ?>
                    </li>
                </ul>
            </div>

            <h2>About Me</h2>
            <p>
                <?= $data->about ?>
            </p>
        </div>
    </section>
    <!-- CONTENT END-->

    <?php include 'app/views/Common/footer.php' ?>