<!-- registration-success.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
        <div class="container">
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Admin Approval Confirmation</h4>
                <p>Do you sure to approve the admin registration?</p>
                <h2>Approve admin registration</h2>
                <ul>
                    <li><strong>Name:</strong> {{ $user->name }}</li>
                    <li><strong>Email:</strong> {{ $user->email }}</li>
                </ul>
                <a href="/adminApproved/{{ $user->id }}" class="btn btn-danger">Approve</a>
                <button onclick="history.back();" class="btn btn-secondary">Back</button>
            </div>
        </div>
</body>
</html>


