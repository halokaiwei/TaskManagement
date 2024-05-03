<!DOCTYPE html>
<html>
<head>
    <title>Modify Task</title>
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
        <h2>Modify Task</h2>
        <form action="/updateTask/{{ $task->id }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $task->title }}" required>
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea class="form-control" id="content" name="content" rows="5" required>{{ $task->content }}</textarea>
            </div>
            <div class="form-group">
                <label for="tools_used">Tools Used:</label>
                <input type="text" class="form-control" id="tools_used" name="tools_used" value="{{ $task->tools_used }}">
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <select class="form-control" id="category" name="category" required>
                    <option value="">Select Category</option>
                    <option value="writing articles" {{ $task->category == 'writing articles' ? 'selected' : '' }}>Writing Articles</option>
                </select>
            </div>
            <div class="form-group">
                <label for="due_date">Due Date:</label>
                <input type="datetime-local" class="form-control" id="due_date" name="due_date" value="{{ date('Y-m-d\TH:i', strtotime($task->due_date)) }}" required>
            </div>
            <button onclick="history.back();" class="btn btn-primary">Cancel</button>
            <button type="submit" class="btn btn-primary" style="margin-left:550px;">Update</button>
        </form>
    </div>
</body>
</html>
