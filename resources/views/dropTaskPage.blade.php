<!DOCTYPE html>
<html>
<head>
    <title>Drop Task</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #76b852;
            font-family: "Roboto", sans-serif;
        }
        .container {
            width: 50%;
            margin: auto;
            margin-top: 50px;
        }
        .form-group {
            margin-bottom: 20px;
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
    <div class="container">
        <h2>Drop Task</h2>
        <p>Are you sure you want to drop the following task?</p>
        <ul>
            <li><strong>Title:</strong> {{ $task->title }}</li>
            <li><strong>Content:</strong> {{ $task->content }}</li>
            <li><strong>Tools Used:</strong> {{ $task->tools_used }}</li>
            <li><strong>Category:</strong> {{ $task->category }}</li>
            <li><strong>Due Date:</strong> {{ $task->due_date }}</li>
            <li><strong>Status</strong> {{ $task->status }}</li>
        </ul>
        <a href="/dropTask/{{ $task->id }}" class="btn btn-danger">Drop</a>
        <a href="/myProfilePage" class="btn btn-secondary">Cancel</a>
    </div>
</body>
</html>
