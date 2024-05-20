<!DOCTYPE html>
<html>
<head>
    <title>Submit Progress</title>
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
        <h2>Submit Progress for Task: {{ $task->title }}</h2>
        <form action="/submitTaskProgress/{{ $task->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="files">Upload Files:</label>
                <input type="file" class="form-control-file" id="files" name="files[]" multiple>
            </div>
            <button type="submit" class="btn btn-primary">Submit Task Progress</button>
            <a href="/viewTasksPage" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
