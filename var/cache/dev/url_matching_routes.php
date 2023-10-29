<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/api/v1/label/get-all' => [[['_route' => 'app_label_getlabels', '_controller' => 'App\\Controller\\LabelController::getLabels'], null, ['GET' => 1], null, false, false, null]],
        '/api/v1/task/create' => [[['_route' => 'app_task_createtask', '_controller' => 'App\\Controller\\TaskController::createTask'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/api/v1/task/get-all' => [[['_route' => 'app_task_gettasks', '_controller' => 'App\\Controller\\TaskController::getTasks'], null, ['GET' => 1], null, false, false, null]],
        '/api/v1/task/update-position' => [[['_route' => 'app_task_updatetaskposition', '_controller' => 'App\\Controller\\TaskController::updateTaskPosition'], null, ['GET' => 0, 'PUT' => 1], null, false, false, null]],
        '/api/v1/task/complete' => [[['_route' => 'app_task_completetask', '_controller' => 'App\\Controller\\TaskController::completeTask'], null, ['GET' => 0, 'PUT' => 1], null, false, false, null]],
        '/api/v1/task/reopen' => [[['_route' => 'app_task_reopentask', '_controller' => 'App\\Controller\\TaskController::reopenTask'], null, ['GET' => 0, 'PUT' => 1], null, false, false, null]],
        '/api/v1/task/add-member' => [[['_route' => 'app_task_addmember', '_controller' => 'App\\Controller\\TaskController::addMember'], null, ['GET' => 0, 'PUT' => 1], null, false, false, null]],
        '/api/v1/task/remove-member' => [[['_route' => 'app_task_removemember', '_controller' => 'App\\Controller\\TaskController::removeMember'], null, ['GET' => 0, 'PUT' => 1], null, false, false, null]],
        '/api/v1/task/add-label' => [[['_route' => 'app_task_addlabel', '_controller' => 'App\\Controller\\TaskController::addLabel'], null, ['GET' => 0, 'PUT' => 1], null, false, false, null]],
        '/api/v1/task/remove-label' => [[['_route' => 'app_task_removelabel', '_controller' => 'App\\Controller\\TaskController::removeLabel'], null, ['GET' => 0, 'PUT' => 1], null, false, false, null]],
        '/api/v1/task/edit-name' => [[['_route' => 'app_task_edittaskname', '_controller' => 'App\\Controller\\TaskController::editTaskName'], null, ['GET' => 0, 'PUT' => 1], null, false, false, null]],
        '/api/v1/task-list/create' => [[['_route' => 'app_tasklist_createtasklist', '_controller' => 'App\\Controller\\TaskListController::createTaskList'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/api/v1/task-list/get-all' => [[['_route' => 'app_tasklist_gettasklists', '_controller' => 'App\\Controller\\TaskListController::getTaskLists'], null, ['GET' => 1], null, false, false, null]],
        '/api/v1/task-list/get-all-active' => [[['_route' => 'app_tasklist_getactivetasklists', '_controller' => 'App\\Controller\\TaskListController::getActiveTaskLists'], null, ['GET' => 1], null, false, false, null]],
        '/api/v1/task-list/complete' => [[['_route' => 'app_tasklist_completetasklist', '_controller' => 'App\\Controller\\TaskListController::completeTaskList'], null, ['GET' => 0, 'PUT' => 1], null, false, false, null]],
        '/api/v1/user/get-all' => [[['_route' => 'app_user_getusers', '_controller' => 'App\\Controller\\UserController::getUsers'], null, ['GET' => 1], null, false, false, null]],
        '/api/v1/user/login' => [[['_route' => 'app_user_login', '_controller' => 'App\\Controller\\UserController::login'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/api/v1/(?'
                    .'|task\\-list/delete/([^/]++)(*:44)'
                    .'|user/get/([^/]++)(*:68)'
                .')'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:104)'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        44 => [[['_route' => 'app_tasklist_deletetasklist', '_controller' => 'App\\Controller\\TaskListController::deleteTaskList'], ['id'], ['GET' => 0, 'DELETE' => 1], null, false, true, null]],
        68 => [[['_route' => 'app_user_getbyid', '_controller' => 'App\\Controller\\UserController::getById'], ['id'], ['GET' => 1], null, false, true, null]],
        104 => [
            [['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
