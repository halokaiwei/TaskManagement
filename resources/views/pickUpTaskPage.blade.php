<!DOCTYPE html>
<html>
<head>
    <title>Pick Up Task</title>
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Pick Up Task</h2>
        <p>Are you sure you want to pick up the following task?</p>
        <ul>
            <li><strong>Title:</strong> {{ $task->title }}</li>
            <li><strong>Content:</strong> {{ $task->content }}</li>
            <li><strong>Tools Used:</strong> {{ $task->tools_used }}</li>
            <li><strong>Category:</strong> {{ $task->category }}</li>
            <li><strong>Due Date:</strong> {{ $task->due_date }}</li>
        </ul>
        <form action="/pickUpTask/{{ $task->id }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-secondary">Pick Up</button>
            <a href="/viewTasksPage" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
