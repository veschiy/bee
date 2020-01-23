<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit task</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>

<body>

<div class="row justify-content-center">
    <div class="w-75">
        <h1>Edit Task</h1>

        <div class="float-left  pt-4">
            <div class="text-danger text-left">
                <?php
                if (!empty($_SESSION['flash']['errors'])) {
                    echo implode('<br>', $_SESSION['flash']['errors']);
                }
                ?>
            </div>
        </div>

        <form action="/edit-task" method="post">
            <div class="form-group">
                <label for="userName">User name</label>
                <input type="text" disabled class="form-control" id="" name="user_name" placeholder="User name"
                       value="<?php echo $data['task']['user_name'] ?>">
            </div>
            <div class="form-group">
                <label for="userEmail">User email</label>
                <input disabled type="email" class="form-control" id="userEmail" name="user_email"
                       value="<?php echo $data['task']['user_email'] ?>"
                       placeholder="name@example.com">
            </div>
            <div class="form-group">
                <label for="taskText">Task text</label>
                <textarea name="task_text" required class="form-control" id="taskText"
                          rows="3"><?php echo $data['task']['text'] ?></textarea>
            </div>
            <div class="form-check">
                <input class="form-check-input" <?php echo($data['task']['completed'] === '1' ? 'checked' : ''); ?>
                       name="completed" type="checkbox" id="taskCompleted">
                <label class="form-check-label" for="taskCompleted">
                    Completed
                </label>
            </div>
            <input type="hidden" name="task_id" value="<?php echo $data['task']['id'] ?>">
            <div class="float-right p-4">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>

</body>