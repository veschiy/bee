<?php

/**
 * Class UserModel
 */
class UserModel extends BaseModel
{
    /**
     * @param string $login
     * @param string $pass
     * @return mixed
     */
    public static function getUserByLoginAndPass(string $login, string $pass){
        $db = parent::connect();
        $sql = 'SELECT * FROM `users` WHERE login = :l AND password = :p LIMIT 1';
        $dbh = $db->prepare($sql);
        $dbh->bindValue('l', $login, \PDO::PARAM_STR);
        $dbh->bindValue('p', $pass, \PDO::PARAM_STR);
        $dbh->execute();
        return $dbh->fetch(\PDO::FETCH_ASSOC);
    }
}