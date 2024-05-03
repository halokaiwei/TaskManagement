<!-- Add Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Your HTML code -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USER REGISTRATION</title>
    <style> 
    @import url(https://fonts.googleapis.com/css?family=Roboto:300);

    body {
        background-color: #76b852; /* Green background color */
        font-family: "Roboto", sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale; 
    }

    .login-page {
        width: 100%;
        padding: 8% 0 0;
        margin: auto;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .form {
        background: #FFFFFF;
        max-width: 360px;
        padding: 45px;
        text-align: center;
        box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
        width: 100%;
    }

    .form input {
        font-family: "Roboto", sans-serif;
        outline: 0;
        background: #f2f2f2;
        width: 100%;
        border: 0;
        margin: 0 0 15px;
        padding: 15px;
        box-sizing: border-box;
        font-size: 14px;
    }

    .form button {
        font-family: "Roboto", sans-serif;
        text-transform: uppercase;
        outline: 0;
        background: #4CAF50;
        width: 100%;
        border: 0;
        padding: 15px;
        color: #FFFFFF;
        font-size: 14px;
        -webkit-transition: all 0.3 ease;
        transition: all 0.3 ease;
        cursor: pointer;
    }

    .form button:hover,.form button:active,.form button:focus {
        background: #43A047;
    }

    .form .message {
        margin: 15px 0 0;
        color: #b3b3b3;
        font-size: 12px;
    }

    .form .message a {
        color: #4CAF50;
        text-decoration: none;
    }

    .container {
        position: relative;
        z-index: 1;
        max-width: 300px;
        margin: 0 auto;
    }

    .container:before, .container:after {
        content: "";
        display: block;
        clear: both;
    }

    .container .info {
        margin: 50px auto;
        text-align: center;
    }

    .container .info h1 {
        margin: 0 0 15px;
        padding: 0;
        font-size: 36px;
        font-weight: 300;
        color: #1a1a1a;
    }

    .container .info span {
        color: #4d4d4d;
        font-size: 12px;
    }

    .container .info span a {
        color: #000000;
        text-decoration: none;
    }

    .container .info span .fa {
        color: #EF3B3A;
    }

    b {
        font-weight: bold;
    }

    font[Attributes Style] {
        font-size: xx-large;
    }
    </style>
</head>
<body>
    <div class="login-page">
        <div class="form">
            <font size="6">
                <b>REGISTER
                <br>
                </b> 
            </font>
            <br><br>
            <form class="login-form" method="POST" action="/userRegister"> 
                @csrf
                <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" required autofocus class="form-control" />
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            
                <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required class="form-control" />
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            
                <input type="password" name="password" placeholder="Password" required class="form-control" />
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            
                <input type="password" name="password_confirmation" placeholder="Confirm Password" required class="form-control" />
                @error('password_confirmation')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <label for="select_role">Select Role</label>
                <select id="select_role" name="select_role" class="form-control" required>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
                <br>
                <button type="submit" name="register_btn" class="btn btn-lg btn-primary btn-block">Create Account</button>
                <p class="message">Already registered? <a href="/userLogin">Log In</a></p>
            </form>
        </div>
    </div>

    <!-- Add Bootstrap JS (Optional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
