<?php

/**
 * Routes file
 */

Route::get('/', function () {
    TaskController::showTasks();
});

Route::get('create-task', function () {
    TaskController::showTaskCreate();
});

Route::post('create-task', function () {
    TaskController::createTask();
});

Route::get('edit-task', function () {
    TaskController::showTaskEdit();
});

Route::post('edit-task', function () {
    TaskController::updateTask();
});

Route::get('login', function () {
    AuthController::showLoginForm();
});

Route::post('login', function () {
    AuthController::login();
});

Route::get('logout', function () {
    AuthController::logout();
});

BaseController::createView('404');

