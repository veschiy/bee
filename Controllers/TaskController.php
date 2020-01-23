<?php

/**
 * Class TaskController
 */
class TaskController extends BaseController
{
    /**
     * showTasks
     */
    public static function showTasks()
    {
        $data['tasks'] = TaskModel::getAllTasks();
        return parent::createView('Tasks', $data);
    }

    /**
     * showTaskCreate
     */
    public static function showTaskCreate()
    {
        return parent::createView('CreateTask');
    }

    /**
     * createTask
     */
    public static function createTask()
    {
        if (!empty($_REQUEST['user_name']) && !empty($_REQUEST['user_email']) && !empty($_REQUEST['task_text'])) {
            TaskModel::createTask($_REQUEST);
            $_SESSION['flash']['success'][] = 'The task was created successfully!';
            parent::redirect('/');
        } else {
            if (empty($_REQUEST['user_name'])) {
                $_SESSION['flash']['errors'][] = 'The user name is empty!';
            }
            if (empty($_REQUEST['user_email'])) {
                $_SESSION['flash']['errors'][] = 'The user email is empty!';
            }
            if (!filter_var($_REQUEST['user_email'], FILTER_VALIDATE_EMAIL)) {
                $_SESSION['flash']['errors'][] = 'The user email is invalid!';
            }
            if (empty($_REQUEST['task_text'])) {
                $_SESSION['flash']['errors'][] = 'The task text is empty!';
            }
            parent::redirect('/create-task');
        }
    }

    /**
     * showTaskEdit
     */
    public static function showTaskEdit()
    {
        if (empty($_SESSION['user'])) {
            parent::redirect('/login');
        } else {
            $segments = explode('/', $_SERVER['REQUEST_URI']);

            if (!empty($segments) && !empty($segments[2]) && is_numeric($segments[2])) {
                $data['task'] = TaskModel::getTaskInfoById((int)$segments[2]);
                if (empty($data['task'])) {
                    return parent::createView('404');
                }
                return parent::createView('EditTask', $data);
            } else {
                return parent::createView('404');
            }
        }
    }

    /**
     * updateTask
     */
    public static function updateTask()
    {
        if (empty($_SESSION['user'])) {
            parent::redirect('/login');
        } else {
            if (!empty($_REQUEST['task_id']) && is_numeric($_REQUEST['task_id']) && !empty($_REQUEST['task_text'])) {
                TaskModel::updateTaskInfo((int)$_REQUEST['task_id'], $_REQUEST);
                $_SESSION['flash']['success'][] = 'The task was updated successfully!';
                parent::redirect('/');
            } else {
                if (empty($_REQUEST['task_id']) || !is_numeric($_REQUEST['task_id'])) {
                    $_SESSION['flash']['errors'][] = 'Task not found!';
                }
                if (empty($_REQUEST['task_text'])) {
                    $_SESSION['flash']['errors'][] = 'The task text is empty!';
                }
                parent::redirect('/create-task');
            }
        }
    }


}
