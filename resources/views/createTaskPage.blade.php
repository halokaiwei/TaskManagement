<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Task</title>
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
        <h2>Create Task</h2>
        <form action="/createTask" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="tools_used">Tools Used:</label>
                <input type="text" class="form-control" id="tools_used" name="tools_used">
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <select class="form-control" id="category" name="category" required>
                    <option value="">Select Category</option>
                    <option value="writing articles">Writing Articles</option>
                    <option value="assignment helping">Assignment Helping</option>
                    <option value="Data Entry">Data Entry</option>
                    <option value="Graphic Design">Graphic Design</option>
                    <option value="Web Development">Web Development</option>
                    <option value="Marketing">Marketing</option>
                    <option value="Research">Research</option>
                    <option value="Translation">Translation</option>
                    <option value="Content Editing">Content Editing</option>
                    <option value="Event Planning">Event Planning</option>
                    <option value="Video Editing">Video Editing</option>
                </select>
            </div>
            <div class="form-group">
                <label for="due_date">Due Date:</label>
                <input type="datetime-local" class="form-control" id="due_date" name="due_date" required>
            </div>
            <button onclick="history.back();" class="btn btn-primary">Back</button>
            <button type="submit" class="btn btn-primary" style="margin-left:570px;">Submit</button>
        </form>
    </div>
</body>
</html>
