<?php include 'app/views/Common/header.php' ?>
<link href="../css/Notifications.css" rel="stylesheet" type="text/css"/>
    <div class="content">

        <!--CONTENT START-->
        <h3 class="content-header">Notifications</h3>
        <div class="container">
            <div class="notification success">
                <h2>Invitation Request</h2>
                <?php if (is_array($data['connection'])) { ?>
                    <div class="grid-container">
                        <?php foreach ($data['connection'] as $datum) { ?>
                            <div class="box"><a href="#"><h4 class="item"><?=$datum->fname, ' ', $datum->lname?></h4></a>
                                <p class="description-item"><?=$datum->job_title?></p>
                                <button type="button" id="accept" class="btn btn-lg btn-success"><a href="/Invitation/Accept/<?=$datum->id?>">Accept</a></button>
                                <button type="button" id="reject" class="btn btn-lg btn-success"><a href="/Invitation/Reject/<?=$datum->id?>">Reject</a></button>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
            <div class="notification info">
                <h2>Messages</h2>
            <?php if (is_array($data['messages']) && sizeof($data['messages']) > 0) { ?>
                <?php foreach($data['messages'] as $datum) { ?>
                <p><?=$datum->content?></p>
                <?php } ?>
                <button><a href="/Chat/">Go to chat</a></button>
                <button><a href="/Notification/clearAllChatMessages/">Clear all message notifications</a></button>
            <?php } else { ?>
                <p>All caught up!</p>
            <?php } ?>
            </div>
            <div class="notification warning">
                <h2>New Job Posting</h2>
            <?php if (is_array($data['jobs']) && sizeof($data['jobs']) > 0) { ?>
                <?php foreach($data['jobs'] as $datum) { ?>
                <p><?=$datum->content?></p>
                <?php } ?>
                <button><a href="/Job/JobManage/">Go to jobs</a></button>
                <button><a href="/Notification/clearAllJobMessages/">Clear all job notifications</a></button>
            <?php } else { ?>
                <p>All caught up!</p>
            <?php } ?>
            </div>
            <div class="notification error">
                <h2>Updates</h2>
                <p>We will be releasing v2.2.</p>
                <button>More Information</button>
            </div>
        </div>
    </div>


    <!-- CONTENT END-->

<?php include 'app/views/Common/footer.php' ?>
