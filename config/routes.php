<?php

use App\Controller\Admin\Users\CreateUser;
use App\Controller\Admin\Users\DeleteUser;
use App\Controller\LoginController;
use App\View\Admin\IndexAdmin;
use App\View\Admin\Users\UsersPage;
use App\View\Home;
use App\View\Login;

return [

    '' => Home::class,
    '/home' => Home::class,

    // SECTION LOGIN
    '/login' => Login::class,
    '/login/controller' => LoginController::class,

    // SECTION ADMIN
    '/admin' => IndexAdmin::class,
    
    '/admin/users' => UsersPage::class,
    '/admin/users/create' => CreateUser::class,
    '/admin/users/delete' => DeleteUser::class

];
