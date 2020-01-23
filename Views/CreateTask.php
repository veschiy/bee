<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create task</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>
<body>
<div class="row justify-content-center">
    <div class="w-75">
        <h1>Create Task</h1>

        <div class="float-left  pt-4">
            <div class="text-danger text-left">
                <?php
                if (!empty($_SESSION['flash']['errors'])) {
                    echo implode('<br>', $_SESSION['flash']['errors']);
                }
                ?>
            </div>
        </div>

        <form action="/create-task" method="post">
            <div class="form-group">
                <label for="userName">User name</label>
                <input type="text" required class="form-control" id="" name="user_name" placeholder="User name">
            </div>
            <div class="form-group">
                <label for="userEmail">User email</label>
                <input type="email" class="form-control" id="userEmail" name="user_email"
                       placeholder="name@example.com">
            </div>
            <div class="form-group">
                <label for="taskText">Task text</label>
                <textarea name="task_text" required class="form-control" id="taskText" rows="3"></textarea>
            </div>
            <div class="float-right p-4">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
</body>