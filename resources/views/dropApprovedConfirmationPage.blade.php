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
                <h4 class="alert-heading">Drop Approval Confirmation</h4>
                <p>Do you sure to approve the drop of the task?</p>
                <h2>Approve dropping of task</h2>
                <ul>
                <ul>
                    <li><strong>ID:</strong> {{ $dropRequest->task_id }}</li>
                    <li><strong>Title:</strong> {{ $dropRequest->task->title }}</li>
                    <li><strong>Content:</strong> {{ $dropRequest->task->content }}</li>
                    <li><strong>Picked up by:</strong> {{ $dropRequest->task->pickedUpBy->name }}</li>
                </ul>

                </ul>
                <a href="/dropApproved/{{ $dropRequest->id }}" class="btn btn-danger">Approve</a>
                <button onclick="history.back();" class="btn btn-secondary">Back</button>
            </div>
        </div>
</body>
</html>


