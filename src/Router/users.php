<?php

use Slim\App;
use App\Controllers\UserController;
use App\Middlewares\Authentication;
use Slim\Routing\RouteCollectorProxy;


return function (App $app) {

    $settings = $app->getContainer()
                    ->get('settings');
    
    $app->group($settings['basePath'] . 'users', function(RouteCollectorProxy $group)  {

        $group->get('', UserController::class . ':getAll')->add(new Authentication);
        
        $group->get('/{id}',  UserController::class . ':get');
        
        $group->post('', UserController::class . ':create');
        
        $group->put('/{id}', UserController::class . ':update');
        
        $group->delete('/{id}', UserController::class . ':delete');
    });
};
