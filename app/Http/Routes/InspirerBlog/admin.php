<?php
/**
 * admin.php
 *
 * Creator:    chongyi
 * Created at: 2016/5/13 0013 10:11
 */
use Illuminate\Routing\Router;

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function (Router $router) {
    $router->post('login', ['uses' => 'GateController@login', 'as' => 'inspirer-blog.admin.login']);
    $router->get('login', ['uses' => 'GateController@gate', 'as' => 'inspirer-blog.admin.gate']);
    
    $router->group(['middleware' => 'admin-auth'], function (Router $router) {
        $router->get('home', ['uses' => 'IndexController@home', 'as' => 'inspirer-blog.admin.home']);
    });
});