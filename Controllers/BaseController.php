<?php

/**
 * Class BaseController
 */
class BaseController
{
    /**
     * @var PDO
     */
    public $db;

    /**
     * BaseController constructor.
     */
    public function __construct()
    {
        $this->db = parent::connect();
    }

    /**
     * @param $viewName
     * @param array $data
     */
    public static function createView($viewName, $data = []){
        require_once ("./Views/$viewName.php");
        $_SESSION['flash'] = [];
        exit;
    }

    /**
     * @param $url
     * @param int $statusCode
     */
    public static function redirect($url, $statusCode = 303)
    {
        header('Location: ' . $url, true, $statusCode);
        exit;
    }

}