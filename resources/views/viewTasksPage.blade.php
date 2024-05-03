<!DOCTYPE html>
<html>
<head>
    <title>View Tasks</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #76b852;
            font-family: "Roboto", sans-serif;
        }
        .navbar {
            background-color: #28a745;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
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
                        <a class="nav-link" href="/myProfilePage">My Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">####</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1>View Tasks</h1>
        <table class="table table-bordered table-hover">
            <thead class="bg-success text-white">
                <tr>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Tools Used</th>
                    <th>Category</th>
                    <th>Due Date</th>
                    <th>Posted By</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->content }}</td>
                        <td>{{ $task->tools_used }}</td>
                        <td>{{ $task->category }}</td>
                        <td>{{ $task->due_date }}</td>
                        <td>{{ $task->postedBy->name }}</td>
                        @if(auth()->user() && auth()->user()->role === 'user')
                        <td>
                             <a href="/pickUpTaskPage/{{ $task->id }}" class="btn btn-primary btn-sm">Pick Up Task</a>
                        </td>
                        @endif
                        @if(auth()->user() && auth()->user()->id === $task->posted_by)
                        <td>
                            <a href="/modifyTask/{{ $task->id }}" class="btn btn-primary btn-sm">Modify</a>
                            <a href="/deleteTask/{{ $task->id }}" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
