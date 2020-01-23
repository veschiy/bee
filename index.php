<?php

try {

    if (!isset($_SESSION)) {
        !isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] = null : null;
        session_name(md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR'] . "frontend"));
        session_start();
    }

    spl_autoload_register(function ($className) {
        if (file_exists('./Classes/' . $className . '.php')) {
            require_once './Classes/' . $className . '.php';
        } elseif (file_exists('./Controllers/' . $className . '.php')) {
            require_once './Controllers/' . $className . '.php';
        } elseif (file_exists('./Models/' . $className . '.php')) {
            require_once './Models/' . $className . '.php';
        }
    });

    require_once('Routes.php');

} catch (Exception $e) {
    echo $e->getMessage();
}