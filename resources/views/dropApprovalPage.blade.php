<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drop Approval</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: "Roboto", sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        .table th,
        .table td {
            vertical-align: middle;
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
                    @can('isAdmin')
                    <li class="nav-item">
                        <a class="nav-link" href="/createTaskPage">Create Task</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/adminApprovalPage">Admin Approval</a>
                    </li>
                    @endcan
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
        <h2>Drop Approval</h2>
        @if ($dropRequests->count() > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>User</th>
                    <th>Requested At</th>
                    <th>Action</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dropRequests as $request)
                <tr>
                    <td>{{ $request->task->title }}</td>
                    <td>{{ $request->user->name }}</td>
                    <td>{{ $request->created_at }}</td>
                    <td>{{ $request->status }}</td>
                    <td>
                        <a href="/dropApprovedConfirmationPage/{{ $request->id }}" class="btn btn-success"> Approve </a>
                        <a href="/dropRejectedConfirmationPage/{{ $request->id }}" class="btn btn-success"> Reject </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>No drop requests awaiting approval.</p>
        @endif
    </div>
</body>
</html>
