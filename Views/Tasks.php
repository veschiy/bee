<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tasks</title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" language="javascript"
            src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
</head>
<body>
<div class="row justify-content-center">
    <div class="w-75">

        <div class="float-right p-4">
            <a class="btn btn-primary" href="/create-task" role="button">Create Task</a>
            <?php if (empty($_SESSION['user'])) { ?>
                <a class="btn btn-primary" href="/login" role="button">Login</a>
            <?php } else { ?>
                <a class="btn btn-primary" href="/logout" role="button">Logout</a>
            <?php } ?>
        </div>

        <div class="float-left  pt-4">
            <div class="text-danger text-left">
                <?php
                if (!empty($_SESSION['flash']['errors'])) {
                    echo implode('<br>', $_SESSION['flash']['errors']);
                }
                ?>
            </div>

            <div class="text-success text-left">
                <?php
                if (!empty($_SESSION['flash']['success'])) {
                    echo implode('<br>', $_SESSION['flash']['success']);
                }
                ?>
            </div>
        </div>

        <table id="tasksTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>
                <th>User name</th>
                <th>Email</th>
                <th>Text</th>
                <th>Is completed</th>
                <th>Is edited</th>
                <?php if(!empty($_SESSION['user'])) { ?>
                    <th>Actions</th>
                <?php } ?>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($data['tasks']) && is_array($data['tasks'])) { ?>
                <?php foreach ($data['tasks'] As $task) { ?>
                    <tr>
                        <td><?php echo $task['user_name'] ?></td>
                        <td><?php echo $task['user_email'] ?></td>
                        <td><?php echo $task['text'] ?></td>
                        <td><?php echo ($task['completed'] === '1') ? 'Yes' : 'No'; ?></td>
                        <td><?php echo ($task['updated_at'] === $task['created_at']) ? 'No' : 'Yes'; ?></td>
                        <?php if(!empty($_SESSION['user'])) { ?>
                            <td><a class="btn btn-link" href="/edit-task/<?php echo $task['id'] ?>" role="button">Edit</a></td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    window.onload = function () {
        $('#tasksTable').DataTable({
            <?php if(!empty($_SESSION['user'])) { ?>
            "columns": [
                null,
                null,
                null,
                null,
                null,
                { "orderable": false }
            ],
            <?php } ?>
            "lengthChange": false,
            "searching": false,
            "pageLength": 3
        });
    };
</script>
</body>
