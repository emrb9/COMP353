<?php include 'app/views/Common/header.php' ?>

<link href="../../../css/ReviewMod.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<!--CONTENT START-->
<div class="content">
    <h3 class="content-header">Viewing DM History as Moderator</h3>
</div>

<div class="container">
    <div class="contact-list">
        <h1>List Of User DMs</h1>

        <div class="Searchbox">
            <form>
                <input type="text" class="input[type=text]" placeholder="Search for User dms..." />
                <button class="button3" type="submit">Search</button>
            </form>
        </div>
        <div>
            <ul>

                <?php

                if (is_array($data) && is_array($data['user_list'])) {
                    foreach ($data['user_list'] as $user) {

                        $temp = '';
                        
                        if (isset($data['chat_history'])) {
                            ($data['chat_history'][0]->sid == $user->id) ? $temp = 'selected' : $temp = '';
                        }

                        echo '
                        <a href="/Admin/History/' . $user->id . '">
                            <li class="friend '. $temp .'">
                                <img src="https://i.imgur.com/nkN3Mv0.jpg" />
                                <div class="name">
                                    ' . $user->uname . '
                                </div>
                                <div class="status">
                                    Online
                                </div>
                            </li>
                        </a>
                        ';
                    }
                }

                ?>

            </ul>
        </div>
    </div>

    <div class="chat-container">
        <div class="chat-tile">
            <h1>Chat History</h1>
        </div>

        <div class="chat">

            <?php

            if (is_array($data) && isset($data['chat_history'])) {
                foreach ($data['chat_history'] as $chat) {
                    echo '
                    <p>Timestamp: '. $chat->timestamp .' | Message: ' . $chat->content . '</p>
                    ';
                }
            }

            ?>

        </div>

    </div>
</div>
<!-- CONTENT END-->

<?php include 'app/views/Common/footer.php' ?>