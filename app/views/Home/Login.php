<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Sign In</title>

    <link href="../../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../../../css/Login.css" rel="stylesheet" type="text/css" />
</head>
<body class="text-center">
    <form class="form-signin" method="post">
        <a href="/Home" id="headerLink"><h1>HFESTS</h1></a>
        <br/>
        <h3 class="mb-3 font-weight-normal">Please Sign In</h3>

        <div class="form-label-group">
            <input type="text" id="inputUname" name="username" class="form-control" placeholder="Username" required autofocus>
            <label for="inputUname">Username</label>
        </div>

        <div class="form-label-group">
            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
            <label for="inputPassword">Password</label>
        </div>

        <br/>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="action" value="Sign In">Sign in</button>

        <br/>
        <p>No account? <a href="/Home/Register">Register</a></p>

        <p class="mt-5 mb-3 text-muted">&copy; HFESTS, Inc. 2024. Your health is our priority!</p>
    </form>
</body>
</html>

