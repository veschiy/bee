<?php

class TaskModel extends BaseModel
{
    /**
     * @return array
     */
    public static function getAllTasks(){
        $db = parent::connect();
        $sql = 'SELECT * FROM `tasks` WHERE 1';
        $dbh = $db->query($sql);
        return $dbh->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param array $data
     * @return bool
     */
    public static function createTask(array $data){
        $db = parent::connect();
        $sql = 'INSERT INTO `tasks` SET user_name = :un, user_email=:ue, `text`=:tt';
        $dbh = $db->prepare($sql);
        $dbh->bindValue('un', $data['user_name'], \PDO::PARAM_STR);
        $dbh->bindValue('ue', $data['user_email'], \PDO::PARAM_STR);
        $dbh->bindValue('tt', $data['task_text'], \PDO::PARAM_STR);
        return $dbh->execute();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public static function getTaskInfoById(int $id){
        $db = self::connect();
        $sql = 'SELECT * FROM `tasks` WHERE id = :i LIMIT 1';
        $dbh = $db->prepare($sql);
        $dbh->bindValue('i', $id, \PDO::PARAM_INT);
        $dbh->execute();
        return $dbh->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public static function updateTaskInfo(int $id, array $data){
        $taskInfo = self::getTaskInfoById($id);
        $db = self::connect();
        $sql = 'UPDATE `tasks` SET `text`=:tt, completed=:cd, updated_at=:ua WHERE id=:i';
        $dbh = $db->prepare($sql);
        $dbh->bindValue('i', $data['task_id'], \PDO::PARAM_INT);
        $dbh->bindValue('cd', !empty($data['completed']) ? '1' : '0', \PDO::PARAM_STR);
        $dbh->bindValue('tt', $data['task_text'], \PDO::PARAM_STR);
        $dbh->bindValue('ua', ($data['task_text'] != $taskInfo['text']) ? date('Y-m-d H:i:s') :  $taskInfo['updated_at'], \PDO::PARAM_STR);
        return $dbh->execute();
    }
}