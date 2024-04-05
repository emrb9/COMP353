<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Register</title>

    <link href="../../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../../../css/Login.css" rel="stylesheet" type="text/css" />
</head>

<body class="text-center">
    <form class="form-signin" method="post">
        <a href="/Home" id="headerLink">
            <h1>HFESTS</h1>
        </a>
        <br />
        <h3 class="mb-3 font-weight-normal">Register</h3>

        <div class="form-label-group">
            <input type="text" id="uname" name="username" class="form-control" placeholder="Username" required autofocus>
            <label for="uname">Username</label>
        </div>

        <div class="form-label-group">
            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
            <label for="password">Password</label>
        </div>

        <div class="form-label-group">
            <input type="password" id="password_c" name="password_confirm" class="form-control" placeholder="Confirm Password" required>
            <label for="password_c">Confirm Password</label>
        </div>

        <div class="form-label-group">
            <select class="form-control" name="u_type" id="u_type" placeholder="User Type" required>
                <?php 
                    foreach ($data as $datum) {
                        if ($datum["type"] != "Admin") {
                            echo "<option value=".$datum["id"].">". $datum["type"] ."</option>";
                        }
                    }
                ?>
            </select>
        </div>

        <br />
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="action" value="Register">Register</button>

        <br />
        <p>Have an account? <a href="/Home/Login">Login</a></p>

        <p class="mt-5 mb-3 text-muted">&copy; HFESTS, Inc. 2024. Your health is our priority!</p>
    </form>
</body>

</html>