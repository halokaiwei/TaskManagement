<!-- registration-success.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @section('content')
        <div class="container">
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Registration Successful!</h4>
                <p>Your account has been registered successfully. However, your account is pending approval by an admin.</p>
                <hr>
                <a href="/userLoginPage"> Log in </a>
            </div>
        </div>
    @endsection
</body>
</html>


