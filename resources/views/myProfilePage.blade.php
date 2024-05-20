<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
                    @can('isAdmin')
                    <li class="nav-item">
                        <a class="nav-link" href="/createTaskPage">Create Task</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/adminApprovalPage">Admin Approval</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dropApprovalPage">Drop Approval</a>
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
        <h2>My Profile</h2>
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Role:</strong> {{ $user->role }}</p>

        @can('isUser')
        <h3>Tasks Picked Up</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Tools Used</th>
                    <th>Category</th>
                    <th>Due Date</th>
                    <th>Posted By</th>
                    <th>Action</th>
                    <th>Status</th>
                </tr>
            </thead>
                <tbody>
                @forelse ($tasksPickedUp as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->content }}</td>
                        <td>{{ $task->tools_used }}</td>
                        <td>{{ $task->category }}</td>
                        <td>{{ $task->due_date }}</td>
                        <td>{{ $task->postedBy->name }}</td>
                        <td>{{ $task->status }}</td>
                    @if(!($task->status === 'Drop Pending' || $task->status === 'Drop Approved'))
                    <td>
                        <a href="/submitProgressPage/{{ $task->id }}" class="btn btn-info btn-sm">Submit Progress</a>
                        <a href="/dropTaskPage/{{ $task->id }}" class="btn btn-danger btn-sm">Drop Task</a>
                    </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="2">No tasks picked up</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        @endcan

        @can('isAdmin')
        <h3>Tasks Created</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Tools Used</th>
                    <th>Category</th>
                    <th>Due Date</th>
                    <th>Posted By</th>
                    <th>Action</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tasksCreated as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->content }}</td>
                        <td>{{ $task->tools_used }}</td>
                        <td>{{ $task->category }}</td>
                        <td>{{ $task->due_date }}</td>
                        <td>{{ $task->postedBy->name }}</td>
                        @if ($task->status === 'Drop Approved')
                        <td>Pending</td>
                        @else
                        <td>{{ $task->status }}</td>
                        @endif
                    <td>
                        <a href="/deleteTask/{{ $task->id }}" class="btn btn-danger btn-sm">Delete Task</a>
                        <a href="/modifyTask/{{ $task->id }}" class="btn btn-primary btn-sm">Modify Task</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="2">No tasks created</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        @endcan
    </div>
</body>
</html>
