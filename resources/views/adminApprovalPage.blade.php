<!-- adminApprovalPage.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Document</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: "Roboto", sans-serif;
        }
        .navbar {
            background-color: #28a745;
        }
        .navbar-brand {
            color: #fff;
        }
        .navbar-nav .nav-link {
            color: #fff;
        }
        .container {
            margin-top: 50px;
        }
        .table th,
        .table td {
            vertical-align: middle;
        }
        </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    @if(auth()->user() && auth()->user()->role === 'admin')
                    <li class="nav-item">
                        <a class="nav-link" href="/createTaskPage">Create Task</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/adminApprovalPage">Admin Approval</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="/viewTasksPage">View Tasks</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/myProfilePage">My Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">####</a>
                    </li>
                </ul>
              </div>
          </div>
     </nav>

    <div class="container">
        <h1>Admin Approval Page</h1>
        @if ($users->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <form action="{{ route('admin.approve', $user->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Approve</button>
                                </form>
                                <form action="{{ route('admin.deny', $user->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-fail">Deny</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No admin users awaiting approval.</p>
        @endif
    </div>
</body>
</html>

