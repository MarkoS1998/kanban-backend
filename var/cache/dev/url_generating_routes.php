<?php

// This file has been auto-generated by the Symfony Routing Component.

return [
    'app_label_getlabels' => [[], ['_controller' => 'App\\Controller\\LabelController::getLabels'], [], [['text', '/api/v1/label/get-all']], [], [], []],
    'app_task_gettasks' => [[], ['_controller' => 'App\\Controller\\TaskController::getTasks'], [], [['text', '/api/v1/task/get-all']], [], [], []],
    'app_tasklist_gettasklists' => [[], ['_controller' => 'App\\Controller\\TaskListController::getTaskLists'], [], [['text', '/api/v1/task-list/get-all']], [], [], []],
    'app_tasklist_getactivetasklists' => [[], ['_controller' => 'App\\Controller\\TaskListController::getActiveTaskLists'], [], [['text', '/api/v1/task-list/get-all-active']], [], [], []],
    'app_user_getusers' => [[], ['_controller' => 'App\\Controller\\UserController::getUsers'], [], [['text', '/api/v1/user/get-all']], [], [], []],
    '_preview_error' => [['code', '_format'], ['_controller' => 'error_controller::preview', '_format' => 'html'], ['code' => '\\d+'], [['variable', '.', '[^/]++', '_format', true], ['variable', '/', '\\d+', 'code', true], ['text', '/_error']], [], [], []],
];